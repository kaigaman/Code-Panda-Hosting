package com.codepanda.app.ui.whatsapp

import android.content.ActivityNotFoundException
import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
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

        try {
            val uri = Uri.parse("https://wa.me/${Constants.WHATSAPP_NUMBER}?text=$encoded")
            startActivity(Intent(Intent.ACTION_VIEW, uri))
        } catch (e: ActivityNotFoundException) {
            try {
                val webUri = Uri.parse("https://web.whatsapp.com/send?phone=${Constants.WHATSAPP_NUMBER}&text=$encoded")
                startActivity(Intent(Intent.ACTION_VIEW, webUri))
            } catch (e2: ActivityNotFoundException) {
                if (isAdded) {
                    Toast.makeText(context, R.string.error_occurred, Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
