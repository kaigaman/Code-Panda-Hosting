package com.codepanda.app.ui.domain

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.codepanda.app.databinding.ItemDomainSuggestionBinding
import com.codepanda.app.network.models.Suggestion

class DomainSuggestionAdapter(
    private val onRegisterClick: (String) -> Unit
) : ListAdapter<Suggestion, DomainSuggestionAdapter.ViewHolder>(DiffCallback) {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val binding = ItemDomainSuggestionBinding.inflate(
            LayoutInflater.from(parent.context), parent, false
        )
        return ViewHolder(binding)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.bind(getItem(position))
    }

    inner class ViewHolder(
        private val binding: ItemDomainSuggestionBinding
    ) : RecyclerView.ViewHolder(binding.root) {

        fun bind(suggestion: Suggestion) {
            binding.tvDomain.text = suggestion.domain
            binding.tvPrice.text = suggestion.price
            binding.btnRegister.setOnClickListener {
                onRegisterClick(suggestion.url)
            }
        }
    }

    private object DiffCallback : DiffUtil.ItemCallback<Suggestion>() {
        override fun areItemsTheSame(old: Suggestion, new: Suggestion) = old.domain == new.domain
        override fun areContentsTheSame(old: Suggestion, new: Suggestion) = old == new
    }
}