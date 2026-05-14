package com.codepanda.app.network.models

data class DomainResponse(
    val status: String,
    val domain: String? = null,
    val action: String? = null,
    val price: String? = null,
    val order_url: String? = null,
    val suggestions: List<Suggestion>? = null,
    val message: String? = null
)

data class Suggestion(
    val domain: String,
    val price: String,
    val url: String
)

data class WhoisResponse(
    val status: String,
    val domain: String? = null,
    val whois_data: Map<String, String>? = null,
    val registered: Boolean? = null,
    val message: String? = null
)

data class FcmTokenRequest(
    val token: String,
    val device_id: String,
    val platform: String = "android"
)
