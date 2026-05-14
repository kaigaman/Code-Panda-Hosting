package com.codepanda.app.ui.account

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.codepanda.app.R
import com.codepanda.app.ui.webview.WebViewFragment

class AccountFragment : WebViewFragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        val args = Bundle().apply {
            putString("url", "https://core.code-panda.online/login")
        }
        arguments = args
        return super.onCreateView(inflater, container, savedInstanceState)
    }
}
