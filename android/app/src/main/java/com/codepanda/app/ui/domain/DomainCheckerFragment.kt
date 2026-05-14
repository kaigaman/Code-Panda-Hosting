package com.codepanda.app.ui.domain

import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.view.inputmethod.EditorInfo
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import com.codepanda.app.R
import com.codepanda.app.databinding.FragmentDomainCheckerBinding
import com.codepanda.app.network.RetrofitClient
import com.codepanda.app.network.models.Suggestion
import com.codepanda.app.util.NetworkUtils
import kotlinx.coroutines.launch

class DomainCheckerFragment : Fragment() {
    private var _binding: FragmentDomainCheckerBinding? = null
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        _binding = FragmentDomainCheckerBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        binding.btnSearch.setOnClickListener { searchDomain() }
        binding.btnWhois.setOnClickListener { whoisLookup() }

        binding.inputDomain.setOnEditorActionListener { _, actionId, _ ->
            if (actionId == EditorInfo.IME_ACTION_SEARCH) { searchDomain(); true } else false
        }
        binding.inputWhois.setOnEditorActionListener { _, actionId, _ ->
            if (actionId == EditorInfo.IME_ACTION_SEARCH) { whoisLookup(); true } else false
        }
    }

    private fun searchDomain() {
        val domain = binding.inputDomain.text.toString().trim()
        if (domain.isEmpty()) {
            binding.inputDomainLayout.error = "Please enter a domain"
            return
        }
        binding.inputDomainLayout.error = null

        if (!NetworkUtils.isOnline(requireContext())) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show()
            return
        }

        binding.loadingSpinner.visibility = View.VISIBLE
        binding.domainResults.visibility = View.GONE

        lifecycleScope.launch {
            try {
                val response = RetrofitClient.apiService.checkDomain(domain)
                binding.loadingSpinner.visibility = View.GONE

                when (response.status) {
                    "available" -> {
                        val msg = "${response.domain} is ${getString(R.string.available)} " +
                                if (response.price != null) "at ${response.price}" else ""
                        showDomainResult(msg, response.order_url)
                    }
                    "unavailable" -> {
                        showDomainResult(
                            "${response.domain} is ${getString(R.string.unavailable)}",
                            null,
                            response.suggestions
                        )
                    }
                    else -> {
                        Toast.makeText(context, response.message ?: getString(R.string.error_occurred), Toast.LENGTH_SHORT).show()
                    }
                }
            } catch (e: Exception) {
                binding.loadingSpinner.visibility = View.GONE
                Toast.makeText(context, "Network error: ${e.localizedMessage}", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun showDomainResult(message: String, orderUrl: String?, suggestions: List<Suggestion>? = null) {
        val resultText = buildString {
            append(message)
            suggestions?.forEach { sug ->
                append("\n\u2022 ${sug.domain} - ${sug.price}")
            }
        }
        Toast.makeText(context, resultText, Toast.LENGTH_LONG).show()

        if (orderUrl != null) {
            startActivity(Intent(Intent.ACTION_VIEW, Uri.parse(orderUrl)))
        }
    }

    private fun whoisLookup() {
        val domain = binding.inputWhois.text.toString().trim()
        if (domain.isEmpty()) {
            binding.inputWhoisLayout.error = "Please enter a domain"
            return
        }
        binding.inputWhoisLayout.error = null

        if (!NetworkUtils.isOnline(requireContext())) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show()
            return
        }

        binding.loadingSpinner.visibility = View.VISIBLE

        lifecycleScope.launch {
            try {
                val response = RetrofitClient.apiService.whoisLookup(domain)
                binding.loadingSpinner.visibility = View.GONE

                if (response.status == "success" && response.whois_data != null) {
                    val info = response.whois_data.entries
                        .filter { it.value.isNotEmpty() }
                        .take(20)
                        .joinToString("\n") { "${it.key}: ${it.value}" }
                    Toast.makeText(context, info.take(500), Toast.LENGTH_LONG).show()
                } else {
                    Toast.makeText(context, response.message ?: "No WHOIS data found", Toast.LENGTH_SHORT).show()
                }
            } catch (e: Exception) {
                binding.loadingSpinner.visibility = View.GONE
                Toast.makeText(context, "Network error: ${e.localizedMessage}", Toast.LENGTH_SHORT).show()
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
