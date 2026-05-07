<?php

namespace OpenCompany\Integrations\Recruitee;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Recruitee Core API.
 *
 * Handles bearer authentication, company-scoped endpoint construction, API errors,
 * and JSON parsing for all Recruitee tools.
 */
class RecruiteeService
{
    private const DEFAULT_BASE_URL = 'https://api.recruitee.com/c/{company_id}';

    /**
     * @param  string  $accessToken  Recruitee API bearer token.
     * @param  string  $companyId  Recruitee company ID or subdomain.
     * @param  string  $baseUrl  Base URL for the Recruitee API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $companyId = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' && $this->companyId !== '';
    }

    /**
     * List company offers.
     *
     * @param  array<string, mixed>  $params  Query parameters such as status, page, and limit.
     * @return array<string, mixed>
     */
    public function listOffers(array $params = []): array
    {
        return $this->request('GET', '/offers', $params);
    }

    /**
     * Get one company offer by ID.
     *
     * @param  int  $offerId  The offer ID.
     * @return array<string, mixed>
     */
    public function getOffer(int $offerId): array
    {
        return $this->request('GET', '/offers/' . $offerId);
    }

    /**
     * Create a company offer.
     *
     * @param  array<string, mixed>  $offer  Offer object accepted by Recruitee.
     * @return array<string, mixed>
     */
    public function createOffer(array $offer): array
    {
        return $this->request('POST', '/offers', ['offer' => $offer]);
    }

    /**
     * Update a company offer.
     *
     * @param  int  $offerId  The offer ID.
     * @param  array<string, mixed>  $offer  Offer fields accepted by Recruitee.
     * @return array<string, mixed>
     */
    public function updateOffer(int $offerId, array $offer): array
    {
        return $this->request('PATCH', '/offers/' . $offerId, ['offer' => $offer]);
    }

    /**
     * Delete a company offer.
     *
     * @param  int  $offerId  The offer ID.
     * @return array<string, mixed>
     */
    public function deleteOffer(int $offerId): array
    {
        return $this->request('DELETE', '/offers/' . $offerId);
    }

    /**
     * List candidates.
     *
     * @param  array<string, mixed>  $params  Query parameters such as page, limit, and offset.
     * @return array<string, mixed>
     */
    public function listCandidates(array $params = []): array
    {
        return $this->request('GET', '/candidates', $params);
    }

    /**
     * Search candidates through the newer search endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters including limit, page, filters_json, and sort_by.
     * @return array<string, mixed>
     */
    public function searchCandidates(array $params = []): array
    {
        return $this->request('GET', '/search/new/candidates', $params);
    }

    /**
     * Get one candidate by ID.
     *
     * @param  int  $candidateId  The candidate ID.
     * @return array<string, mixed>
     */
    public function getCandidate(int $candidateId): array
    {
        return $this->request('GET', '/candidates/' . $candidateId);
    }

    /**
     * Create a candidate.
     *
     * @param  array<string, mixed>  $candidate  Candidate object accepted by Recruitee.
     * @param  array<int, int>|null  $offers  Optional offer IDs to assign the candidate to.
     * @return array<string, mixed>
     */
    public function createCandidate(array $candidate, ?array $offers = null): array
    {
        $body = ['candidate' => $candidate];

        if ($offers !== null) {
            $body['offers'] = array_values($offers);
        }

        return $this->request('POST', '/candidates', $body);
    }

    /**
     * Update a candidate.
     *
     * @param  int  $candidateId  The candidate ID.
     * @param  array<string, mixed>  $candidate  Candidate fields accepted by Recruitee.
     * @return array<string, mixed>
     */
    public function updateCandidate(int $candidateId, array $candidate): array
    {
        return $this->request('PATCH', '/candidates/' . $candidateId, ['candidate' => $candidate]);
    }

    /**
     * Update a candidate CV from a local or remote file object.
     *
     * @param  int  $candidateId  The candidate ID.
     * @param  array<string, mixed>  $candidate  Candidate CV payload accepted by Recruitee.
     * @return array<string, mixed>
     */
    public function updateCandidateCv(int $candidateId, array $candidate): array
    {
        return $this->request('PATCH', '/candidates/' . $candidateId . '/update_cv', ['candidate' => $candidate]);
    }

    /**
     * Delete a candidate.
     *
     * @param  int  $candidateId  The candidate ID.
     * @return array<string, mixed>
     */
    public function deleteCandidate(int $candidateId): array
    {
        return $this->request('DELETE', '/candidates/' . $candidateId);
    }

    /**
     * List notes for a candidate.
     *
     * @param  int  $candidateId  The candidate ID.
     * @return array<string, mixed>
     */
    public function listCandidateNotes(int $candidateId): array
    {
        return $this->request('GET', '/candidates/' . $candidateId . '/notes');
    }

    /**
     * List all departments.
     *
     * @return array<string, mixed>
     */
    public function listDepartments(): array
    {
        return $this->request('GET', '/departments');
    }

    /**
     * List company locations.
     *
     * @param  array<string, mixed>  $params  Query parameters including limit, page, query, scope, and view_mode.
     * @return array<string, mixed>
     */
    public function listLocations(array $params = []): array
    {
        return $this->request('GET', '/locations', $params);
    }

    /**
     * Upload an attachment to a candidate or offer from a remote URL.
     *
     * @param  array<string, mixed>  $attachment  Attachment object with remote_file_url and optional candidate_id or offer_id.
     * @return array<string, mixed>
     */
    public function uploadAttachment(array $attachment): array
    {
        return $this->request('POST', '/attachments', ['attachment' => $attachment]);
    }

    /**
     * Get the current authenticated user when the host exposes the endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Call a documented company-scoped Recruitee GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to the company base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a documented company-scoped Recruitee POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to the company base URL.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call a documented company-scoped Recruitee PATCH endpoint.
     *
     * @param  string  $path  Endpoint path relative to the company base URL.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = []): array
    {
        return $this->request('PATCH', $path, $body);
    }

    /**
     * Call a documented company-scoped Recruitee DELETE endpoint.
     *
     * @param  string  $path  Endpoint path relative to the company base URL.
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Recruitee API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('Recruitee access token is not configured.');
        }

        $url = $this->baseUrl . '/' . $this->normalizePath($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Recruitee API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Recruitee API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Recruitee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Recruitee API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Recruitee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Recruitee API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a configured base URL into the current company-scoped Core API base.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $companyId = trim($this->companyId);
        $baseUrl = trim($baseUrl);

        if ($baseUrl === '' || str_contains($baseUrl, '{company}.recruitee.com/api/v2')) {
            $baseUrl = self::DEFAULT_BASE_URL;
        }

        $baseUrl = str_replace(['{company_id}', '{company}'], rawurlencode($companyId), $baseUrl);
        $baseUrl = rtrim($baseUrl, '/');

        if ($baseUrl === 'https://api.recruitee.com' && $companyId !== '') {
            return $baseUrl . '/c/' . rawurlencode($companyId);
        }

        return $baseUrl;
    }

    /**
     * Normalize a relative API path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Recruitee API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use a Recruitee API path relative to the configured company base URL.');
        }

        return $path;
    }
}
