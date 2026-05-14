package com.codepanda.app.ui.whatsapp

import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import com.codepanda.app.R
import com.codepanda.app.databinding.FragmentWhatsappBinding
import com.codepanda.app.util.Constants
import java.net.URLEncoder

class WhatsAppFragment : Fragment() {
    private var _binding: FragmentWhatsappBinding? = null
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        _binding = FragmentWhatsappBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        binding.btnOpenWhatsapp.setOnClickListener {
            openWhatsApp()
        }
    }

    private fun openWhatsApp() {
        val message = binding.inputMessage.text.toString().trim()
            .ifEmpty { getString(R.string.whatsapp_message) }

        val encoded = URLEncoder.encode(message, "UTF-8")
        val uri = Uri.parse("https://wa.me/${Constants.WHATSAPP_NUMBER}?text=$encoded")

        try {
            startActivity(Intent(Intent.ACTION_VIEW, uri))
        } catch (e: Exception) {
            // WhatsApp not installed - open in browser
            startActivity(Intent(Intent.ACTION_VIEW, Uri.parse(uri.toString().replace("wa.me", "web.whatsapp.com/send?phone=${Constants.WHATSAPP_NUMBER}&text=$encoded"))))
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
