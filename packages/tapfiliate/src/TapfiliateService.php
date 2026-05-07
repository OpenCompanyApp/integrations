<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Tapfiliate REST API v1.6.
 *
 * Handles API-key authentication, request dispatch, response parsing, and error
 * normalization for affiliate, conversion, commission, customer, and program endpoints.
 */
class TapfiliateService
{
    /**
     * @param  string  $apiKey  Tapfiliate API key
     * @param  string  $baseUrl  Tapfiliate API base URL
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.tapfiliate.com/1.6',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Get the currently authenticated account/user profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me/');
    }

    /**
     * List affiliates with documented filters.
     *
     * @param  array<string, mixed>  $params  Filters such as click_id, source_id, email, referral_code, parent_id, or affiliate_group_id
     * @return array<string, mixed>
     */
    public function listAffiliates(array $params = []): array
    {
        return $this->request('GET', '/affiliates/', $params);
    }

    /**
     * Get a single affiliate by ID.
     *
     * @param  string  $affiliateId  Affiliate ID
     * @return array<string, mixed>
     */
    public function getAffiliate(string $affiliateId): array
    {
        return $this->request('GET', '/affiliates/' . rawurlencode($affiliateId) . '/');
    }

    /**
     * Create an affiliate.
     *
     * @param  array<string, mixed>  $params  Affiliate fields such as firstname, lastname, email, password, company, address, and custom_fields
     * @return array<string, mixed>
     */
    public function createAffiliate(array $params): array
    {
        return $this->request('POST', '/affiliates/', $params);
    }

    /**
     * Update an affiliate.
     *
     * @param  string  $affiliateId  Affiliate ID
     * @param  array<string, mixed>  $params  Affiliate fields to update
     * @return array<string, mixed>
     */
    public function updateAffiliate(string $affiliateId, array $params): array
    {
        return $this->request('PATCH', '/affiliates/' . rawurlencode($affiliateId) . '/', $params);
    }

    /**
     * Delete an affiliate.
     *
     * @param  string  $affiliateId  Affiliate ID
     * @return array<string, mixed>
     */
    public function deleteAffiliate(string $affiliateId): array
    {
        return $this->request('DELETE', '/affiliates/' . rawurlencode($affiliateId) . '/');
    }

    /**
     * Assign an affiliate group.
     *
     * @param  string  $affiliateId  Affiliate ID
     * @param  string  $groupId  Affiliate group ID
     * @return array<string, mixed>
     */
    public function setAffiliateGroup(string $affiliateId, string $groupId): array
    {
        return $this->request('PUT', '/affiliates/' . rawurlencode($affiliateId) . '/group/', [
            'group_id' => $groupId,
        ]);
    }

    /**
     * List notes for an affiliate.
     *
     * @param  string  $affiliateId  Affiliate ID
     * @return array<string, mixed>
     */
    public function listAffiliateNotes(string $affiliateId): array
    {
        return $this->request('GET', '/affiliates/' . rawurlencode($affiliateId) . '/notes/');
    }

    /**
     * List affiliate groups.
     *
     * @return array<string, mixed>
     */
    public function listAffiliateGroups(): array
    {
        return $this->request('GET', '/affiliate-groups/');
    }

    /**
     * List conversions with filters and pagination.
     *
     * @param  array<string, mixed>  $filters  Filters such as affiliate_id, external_id, program_id, date_from, date_to, or status
     * @return array<string, mixed>
     */
    public function listConversions(array $filters = []): array
    {
        return $this->request('GET', '/conversions/', $filters);
    }

    /**
     * Get a conversion by ID.
     *
     * @param  string|int  $conversionId  Conversion ID
     * @return array<string, mixed>
     */
    public function getConversion(string|int $conversionId): array
    {
        return $this->request('GET', '/conversions/' . rawurlencode((string) $conversionId) . '/');
    }

    /**
     * Create a conversion.
     *
     * @param  array<string, mixed>  $params  Conversion parameters
     * @return array<string, mixed>
     */
    public function createConversion(array $params): array
    {
        return $this->request('POST', '/conversions/', $params);
    }

    /**
     * Add a commission line to a conversion.
     *
     * @param  string|int  $conversionId  Conversion ID
     * @param  array<string, mixed>  $params  Commission fields such as conversion_sub_amount, commission_type, and comment
     * @return array<string, mixed>
     */
    public function addConversionCommission(string|int $conversionId, array $params): array
    {
        return $this->request('POST', '/conversions/' . rawurlencode((string) $conversionId) . '/commissions/', $params);
    }

    /**
     * List commissions.
     *
     * @param  array<string, mixed>  $filters  Filters such as affiliate_id, conversion_id, program_id, status, date_from, or date_to
     * @return array<string, mixed>
     */
    public function listCommissions(array $filters = []): array
    {
        return $this->request('GET', '/commissions/', $filters);
    }

    /**
     * Get a commission by ID.
     *
     * @param  string|int  $commissionId  Commission ID
     * @return array<string, mixed>
     */
    public function getCommission(string|int $commissionId): array
    {
        return $this->request('GET', '/commissions/' . rawurlencode((string) $commissionId) . '/');
    }

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $filters  Filters such as program_id, customer_id, affiliate_id, date_from, or date_to
     * @return array<string, mixed>
     */
    public function listCustomers(array $filters = []): array
    {
        return $this->request('GET', '/customers/', $filters);
    }

    /**
     * Create a customer.
     *
     * @param  array<string, mixed>  $params  Customer tracking parameters
     * @return array<string, mixed>
     */
    public function createCustomer(array $params): array
    {
        return $this->request('POST', '/customers/', $params);
    }

    /**
     * List programs.
     *
     * @return array<string, mixed>
     */
    public function listPrograms(): array
    {
        return $this->request('GET', '/programs/');
    }

    /**
     * Get an affiliate's program enrollment.
     *
     * @param  string  $programId  Program ID
     * @param  string  $affiliateId  Affiliate ID
     * @return array<string, mixed>
     */
    public function getProgramAffiliate(string $programId, string $affiliateId): array
    {
        return $this->request('GET', '/programs/' . rawurlencode($programId) . '/affiliates/' . rawurlencode($affiliateId) . '/');
    }

    /**
     * Update an affiliate's program enrollment.
     *
     * @param  string  $programId  Program ID
     * @param  string  $affiliateId  Affiliate ID
     * @param  array<string, mixed>  $params  Fields such as coupon
     * @return array<string, mixed>
     */
    public function updateProgramAffiliate(string $programId, string $affiliateId, array $params): array
    {
        return $this->request('PATCH', '/programs/' . rawurlencode($programId) . '/affiliates/' . rawurlencode($affiliateId) . '/', $params);
    }

    /**
     * List commission types for a program.
     *
     * @param  string  $programId  Program ID
     * @return array<string, mixed>
     */
    public function listProgramCommissionTypes(string $programId): array
    {
        return $this->request('GET', '/programs/' . rawurlencode($programId) . '/commission-types/');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw HTTP request to the Tapfiliate API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Tapfiliate API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Tapfiliate API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Tapfiliate API: {$e->getMessage()}");
        }
    }

    /**
     * Log and throw a normalized API exception.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Tapfiliate API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Tapfiliate API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be experiencing issues.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("Tapfiliate API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Tapfiliate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
