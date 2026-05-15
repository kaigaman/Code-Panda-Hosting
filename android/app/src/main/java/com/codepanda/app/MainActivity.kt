package com.codepanda.app

import android.os.Bundle
import android.webkit.CookieManager
import android.webkit.WebStorage
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.navigation.fragment.NavHostFragment
import androidx.navigation.ui.setupWithNavController
import com.codepanda.app.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        val navHostFragment = supportFragmentManager
            .findFragmentById(R.id.nav_host_fragment) as? NavHostFragment
            ?: return
        val navController = navHostFragment.navController

        binding.bottomNav.setupWithNavController(navController)

        setSupportActionBar(binding.toolbar)

        binding.toolbar.setOnMenuItemClickListener { item ->
            when (item.itemId) {
                R.id.action_share -> {
                    shareCurrentPage()
                    true
                }
                R.id.action_clear_cache -> {
                    clearWebViewCache()
                    true
                }
                else -> false
            }
        }

        navController.addOnDestinationChangedListener { _, dest, _ ->
            binding.toolbar.title = dest.label
            invalidateOptionsMenu()
        }
    }

    private fun shareCurrentPage() {
        val webViewFragment = supportFragmentManager.fragments.firstOrNull { it is com.codepanda.app.ui.webview.WebViewFragment }
        val url = (webViewFragment as? com.codepanda.app.ui.webview.WebViewFragment)?.currentUrl
            ?: "https://code-panda.online"
        val intent = android.content.Intent(android.content.Intent.ACTION_SEND).apply {
            type = "text/plain"
            putExtra(android.content.Intent.EXTRA_TEXT, "Check out Code Panda Computers: $url")
        }
        startActivity(android.content.Intent.createChooser(intent, "Share"))
    }

    private fun clearWebViewCache() {
        CookieManager.getInstance().removeAllCookies(null)
        WebStorage.getInstance().deleteAllData()
        Toast.makeText(this, R.string.cache_cleared, Toast.LENGTH_SHORT).show()
    }
}
