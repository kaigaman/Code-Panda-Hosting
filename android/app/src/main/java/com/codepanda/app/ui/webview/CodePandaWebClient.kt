package com.codepanda.app.ui.webview

import android.graphics.Bitmap
import android.view.View
import android.webkit.WebResourceRequest
import android.webkit.WebView
import android.webkit.WebViewClient
import androidx.core.content.ContextCompat
import com.codepanda.app.R

class CodePandaWebClient(
    private val onProgressChanged: (Int) -> Unit = {},
    private val onPageStarted: () -> Unit = {},
    private val onPageFinished: (String?) -> Unit = {},
) : WebViewClient() {

    override fun onPageStarted(view: WebView?, url: String?, favicon: Bitmap?) {
        super.onPageStarted(view, url, favicon)
        onPageStarted()
    }

    override fun onPageFinished(view: WebView?, url: String?) {
        super.onPageFinished(view, url)
        onPageFinished(url)
    }

    override fun shouldOverrideUrlLoading(view: WebView?, request: WebResourceRequest?): Boolean {
        return false
    }

    override fun onReceivedError(
        view: WebView?,
        errorCode: Int,
        description: String?,
        failingUrl: String?
    ) {
        super.onReceivedError(view, errorCode, description, failingUrl)
        if (errorCode == ERROR_HOST_LOOKUP || errorCode == ERROR_CONNECT) {
            view?.visibility = View.GONE
        }
    }
}
