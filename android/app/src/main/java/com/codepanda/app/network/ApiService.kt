package com.codepanda.app.network

import com.codepanda.app.network.models.DomainResponse
import com.codepanda.app.network.models.WhoisResponse
import retrofit2.http.GET
import retrofit2.http.Query

interface ApiService {
    @GET("domain-checker.php")
    suspend fun checkDomain(
        @Query("domain") domain: String,
        @Query("action") action: String = "register"
    ): DomainResponse

    @GET("whois-api.php")
    suspend fun whoisLookup(
        @Query("q") domain: String
    ): WhoisResponse
}
