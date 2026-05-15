package com.codepanda.app.ui.account

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.codepanda.app.ui.webview.WebViewFragment

class AccountFragment : WebViewFragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        arguments = Bundle().apply {
            putString("url", "https://core.code-panda.online/login")
        }
        return super.onCreateView(inflater, container, savedInstanceState)
    }
}
