package com.codepanda.app.service

import android.app.PendingIntent
import android.content.Context
import android.content.Intent
import android.util.Log
import androidx.core.app.NotificationCompat
import androidx.core.app.NotificationManagerCompat
import com.codepanda.app.CodePandaApp
import com.codepanda.app.MainActivity
import com.codepanda.app.R
import com.codepanda.app.network.models.FcmTokenRequest
import com.codepanda.app.util.Constants
import com.google.firebase.messaging.FirebaseMessagingService
import com.google.firebase.messaging.RemoteMessage
import com.google.gson.Gson
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import java.net.HttpURLConnection
import java.net.URL

class CodePandaFCMService : FirebaseMessagingService() {

    private val notificationIdCounter = java.util.concurrent.atomic.AtomicInteger(0)

    override fun onNewToken(token: String) {
        super.onNewToken(token)
        Log.d(TAG, "New FCM token: $token")
        registerTokenOnServer(token)
    }

    override fun onMessageReceived(message: RemoteMessage) {
        super.onMessageReceived(message)

        val title = message.notification?.title ?: message.data["title"] ?: getString(R.string.app_name)
        val body = message.notification?.body ?: message.data["body"] ?: ""

        showNotification(title, body, message.data)
    }

    private fun showNotification(title: String, body: String, data: Map<String, String>) {
        val intent = Intent(this, MainActivity::class.java).apply {
            flags = Intent.FLAG_ACTIVITY_NEW_TASK or Intent.FLAG_ACTIVITY_CLEAR_TOP
            data["click_action"]?.let { action ->
                putExtra("url", action)
            }
        }

        val pendingIntent = PendingIntent.getActivity(
            this, 0, intent,
            PendingIntent.FLAG_ONE_SHOT or PendingIntent.FLAG_IMMUTABLE
        )

        val notification = NotificationCompat.Builder(this, CodePandaApp.NOTIFICATION_CHANNEL_ID)
            .setSmallIcon(R.drawable.ic_notification)
            .setContentTitle(title)
            .setContentText(body)
            .setAutoCancel(true)
            .setPriority(NotificationCompat.PRIORITY_HIGH)
            .setContentIntent(pendingIntent)
            .build()

        try {
            val notificationId = notificationIdCounter.incrementAndGet()
            NotificationManagerCompat.from(this).notify(notificationId, notification)
        } catch (e: SecurityException) {
            Log.w(TAG, "Notification permission not granted")
        }
    }

    private fun registerTokenOnServer(token: String) {
        CoroutineScope(Dispatchers.IO).launch {
            val prefs = this@CodePandaFCMService.getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE)
            val deviceId = prefs.getString(PREF_DEVICE_ID, null) ?: run {
                val newId = java.util.UUID.randomUUID().toString()
                prefs.edit().putString(PREF_DEVICE_ID, newId).apply()
                newId
            }
            var conn: HttpURLConnection? = null
            try {
                val request = FcmTokenRequest(token, deviceId)
                val json = Gson().toJson(request)

                val url = URL(Constants.API_REGISTER_TOKEN)
                conn = url.openConnection() as HttpURLConnection
                conn.apply {
                    requestMethod = "POST"
                    setRequestProperty("Content-Type", "application/json")
                    doOutput = true
                    connectTimeout = 10000
                    readTimeout = 10000
                }

                conn.outputStream.write(json.toByteArray())
                val responseCode = conn.responseCode
                Log.d(TAG, "Token registered: HTTP $responseCode")
            } catch (e: Exception) {
                Log.e(TAG, "Failed to register token", e)
            } finally {
                conn?.disconnect()
            }
        }
    }

    companion object {
        private const val TAG = "CodePandaFCM"
        private const val PREFS_NAME = "codepanda_fcm"
        private const val PREF_DEVICE_ID = "device_id"
    }
}
