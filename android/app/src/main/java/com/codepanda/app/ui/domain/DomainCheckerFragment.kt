package com.codepanda.app.ui.domain

import android.app.AlertDialog
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
import androidx.recyclerview.widget.DividerItemDecoration
import com.codepanda.app.R
import com.codepanda.app.databinding.FragmentDomainCheckerBinding
import com.codepanda.app.network.RetrofitClient
import com.codepanda.app.util.NetworkUtils
import kotlinx.coroutines.launch

class DomainCheckerFragment : Fragment() {
    private var _binding: FragmentDomainCheckerBinding? = null
    private val binding get() = _binding!!
    private val suggestionAdapter = DomainSuggestionAdapter { url ->
        startActivity(Intent(Intent.ACTION_VIEW, Uri.parse(url)))
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?
    ): View {
        _binding = FragmentDomainCheckerBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        binding.domainResults.apply {
            adapter = suggestionAdapter
            addItemDecoration(DividerItemDecoration(context, DividerItemDecoration.VERTICAL))
        }

        binding.btnSearch.setOnClickListener { searchDomain() }
        binding.btnWhois.setOnClickListener { whoisLookup() }
        binding.btnCheckAnother.setOnClickListener { resetDomainSearch() }

        binding.inputDomain.setOnEditorActionListener { _, actionId, _ ->
            if (actionId == EditorInfo.IME_ACTION_SEARCH) { searchDomain(); true } else false
        }
        binding.inputWhois.setOnEditorActionListener { _, actionId, _ ->
            if (actionId == EditorInfo.IME_ACTION_SEARCH) { whoisLookup(); true } else false
        }
    }

    private fun isValidDomain(domain: String): Boolean {
        return DOMAIN_REGEX.matches(domain)
    }

    private fun searchDomain() {
        val domain = binding.inputDomain.text.toString().trim().lowercase()
        if (domain.isEmpty()) {
            binding.inputDomainLayout.error = getString(R.string.enter_domain)
            return
        }
        if (!isValidDomain(domain)) {
            binding.inputDomainLayout.error = getString(R.string.enter_domain)
            return
        }
        binding.inputDomainLayout.error = null

        if (!isAdded) return
        if (!NetworkUtils.isOnline(requireContext())) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show()
            return
        }

        binding.loadingSpinner.visibility = View.VISIBLE
        binding.domainResults.visibility = View.GONE
        binding.btnCheckAnother.visibility = View.GONE

        lifecycleScope.launch {
            try {
                val response = RetrofitClient.apiService.checkDomain(domain)
                if (!isAdded) return@launch
                binding.loadingSpinner.visibility = View.GONE

                when (response.status) {
                    "available" -> {
                        binding.domainResults.visibility = View.GONE
                        val price = if (response.price != null) " ${getString(R.string.at_price, response.price)}" else ""
                        val msg = "${response.domain} ${getString(R.string.available)} $price"
                        Toast.makeText(context, msg, Toast.LENGTH_LONG).show()
                        binding.btnCheckAnother.visibility = View.VISIBLE
                        response.order_url?.let { url ->
                            startActivity(Intent(Intent.ACTION_VIEW, Uri.parse(url)))
                        }
                    }
                    "unavailable" -> {
                        val suggestions = response.suggestions ?: emptyList()
                        if (suggestions.isNotEmpty()) {
                            suggestionAdapter.submitList(suggestions)
                            binding.domainResults.visibility = View.VISIBLE
                        }
                        Toast.makeText(context,
                            getString(R.string.domain_unavailable, response.domain),
                            Toast.LENGTH_SHORT).show()
                    }
                    else -> {
                        Toast.makeText(context, response.message ?: getString(R.string.error_occurred), Toast.LENGTH_SHORT).show()
                    }
                }
            } catch (e: Exception) {
                if (!isAdded) return@launch
                binding.loadingSpinner.visibility = View.GONE
                Toast.makeText(context, getString(R.string.network_error, e.localizedMessage ?: ""), Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun resetDomainSearch() {
        binding.inputDomain.text?.clear()
        binding.domainResults.visibility = View.GONE
        binding.btnCheckAnother.visibility = View.GONE
        suggestionAdapter.submitList(emptyList())
        binding.inputDomain.requestFocus()
    }

    private fun whoisLookup() {
        val domain = binding.inputWhois.text.toString().trim().lowercase()
        if (domain.isEmpty()) {
            binding.inputWhoisLayout.error = getString(R.string.enter_domain)
            return
        }
        if (!isValidDomain(domain)) {
            binding.inputWhoisLayout.error = getString(R.string.enter_domain)
            return
        }
        binding.inputWhoisLayout.error = null

        if (!isAdded) return
        if (!NetworkUtils.isOnline(requireContext())) {
            Toast.makeText(context, R.string.no_internet, Toast.LENGTH_SHORT).show()
            return
        }

        binding.loadingSpinner.visibility = View.VISIBLE

        lifecycleScope.launch {
            try {
                val response = RetrofitClient.apiService.whoisLookup(domain)
                if (!isAdded) return@launch
                binding.loadingSpinner.visibility = View.GONE

                if (response.status == "success" && response.whois_data != null) {
                    showWhoisDialog(domain, response.whois_data)
                } else {
                    Toast.makeText(context, response.message ?: getString(R.string.no_whois_data), Toast.LENGTH_SHORT).show()
                }
            } catch (e: Exception) {
                if (!isAdded) return@launch
                binding.loadingSpinner.visibility = View.GONE
                Toast.makeText(context, getString(R.string.network_error, e.localizedMessage ?: ""), Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun showWhoisDialog(domain: String, data: Map<String, String>) {
        val info = data.entries
            .filter { it.value.isNotEmpty() }
            .joinToString("\n") { "${it.key}: ${it.value}" }

        AlertDialog.Builder(requireContext())
            .setTitle(getString(R.string.whois_result, domain))
            .setMessage(info)
            .setPositiveButton(android.R.string.ok, null)
            .setCancelable(true)
            .show()
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }

    companion object {
        private val DOMAIN_REGEX = Regex(
            "^([a-zA-Z0-9]([a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?\\.)+[a-zA-Z]{2,}$"
        )
    }
}
