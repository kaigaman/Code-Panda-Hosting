package com.codepanda.app.ui.webview

import android.graphics.Bitmap
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.webkit.WebChromeClient
import android.webkit.WebView
import android.webkit.WebViewClient
import androidx.fragment.app.Fragment
import androidx.navigation.fragment.navArgs
import com.codepanda.app.databinding.FragmentWebviewBinding
import com.codepanda.app.util.NetworkUtils

open class WebViewFragment : Fragment() {
    private var _binding: FragmentWebviewBinding? = null
    private val binding get() = _binding!!
    private val args: WebViewFragmentArgs by navArgs()
    var currentUrl: String? = null
        private set

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        _binding = FragmentWebviewBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        setupWebView()
        setupSwipeRefresh()
        setupRetryButton()

        if (savedInstanceState == null) {
            loadUrl(args.url)
        } else {
            savedInstanceState.getString(KEY_URL)?.let { loadUrl(it) }
        }
    }

    override fun onSaveInstanceState(outState: Bundle) {
        super.onSaveInstanceState(outState)
        outState.putString(KEY_URL, currentUrl)
    }

    private fun setupWebView() {
        binding.webview.apply {
            settings.apply {
                javaScriptEnabled = true
                domStorageEnabled = true
                allowFileAccess = false
                allowContentAccess = false
                setSupportZoom(true)
                builtInZoomControls = true
                displayZoomControls = false
                useWideViewPort = true
                loadWithOverviewMode = true
                cacheMode = android.webkit.WebSettings.LOAD_DEFAULT
                userAgentString = settings.userAgentString + " CodePandaAndroid/1.0"
            }

            webChromeClient = object : WebChromeClient() {
                override fun onProgressChanged(view: WebView?, newProgress: Int) {
                    if (newProgress < 100) {
                        binding.progressBar.visibility = View.VISIBLE
                        binding.progressBar.progress = newProgress
                    } else {
                        binding.progressBar.visibility = View.GONE
                    }
                }
            }

            webViewClient = object : WebViewClient() {
                override fun onPageStarted(view: WebView?, url: String?, favicon: Bitmap?) {
                    super.onPageStarted(view, url, favicon)
                    currentUrl = url
                    binding.offlineView.visibility = View.GONE
                    binding.webview.visibility = View.VISIBLE
                }

                override fun onPageFinished(view: WebView?, url: String?) {
                    super.onPageFinished(view, url)
                    binding.swipeRefresh.isRefreshing = false
                }

                override fun onReceivedError(
                    view: WebView?, errorCode: Int,
                    description: String?, failingUrl: String?
                ) {
                    super.onReceivedError(view, errorCode, description, failingUrl)
                    binding.swipeRefresh.isRefreshing = false
                    if (isAdded && !NetworkUtils.isOnline(requireContext())) {
                        showOffline()
                    }
                }
            }
        }
    }

    private fun setupSwipeRefresh() {
        binding.swipeRefresh.setOnRefreshListener {
            binding.webview.reload()
        }
    }

    private fun setupRetryButton() {
        binding.btnRetry.setOnClickListener {
            if (!isAdded) return@setOnClickListener
            if (NetworkUtils.isOnline(requireContext())) {
                binding.offlineView.visibility = View.GONE
                binding.webview.visibility = View.VISIBLE
                binding.webview.reload()
            }
        }
    }

    private fun showOffline() {
        binding.webview.visibility = View.GONE
        binding.offlineView.visibility = View.VISIBLE
    }

    fun loadUrl(url: String) {
        currentUrl = url
        if (!isAdded) return
        if (NetworkUtils.isOnline(requireContext())) {
            binding.offlineView.visibility = View.GONE
            binding.webview.visibility = View.VISIBLE
            binding.webview.loadUrl(url)
        } else {
            showOffline()
        }
    }

    fun canGoBack(): Boolean = binding.webview.canGoBack()

    fun goBack(): Boolean {
        return if (binding.webview.canGoBack()) {
            binding.webview.goBack()
            true
        } else false
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }

    companion object {
        private const val KEY_URL = "webview_url"
    }
}
