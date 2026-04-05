<?php

namespace OpenCompany\Integrations\Netlify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NetlifyService
{
    /**
     * Create a new NetlifyService instance.
     *
     * @param  string  $accessToken  Netlify personal access token or OAuth token.
     * @param  string  $baseUrl  Netlify API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.netlify.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all sites the authenticated user has access to.
     *
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $perPage  Number of results per page (max 100).
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/listSites
     */
    public function listSites(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/sites', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get details for a single site.
     *
     * @param  string  $siteId  The site ID (Netlify site identifier).
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/getSite
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId));
    }

    /**
     * Create a new site.
     *
     * @param  string  $name  Human-readable name for the site (used as subdomain unless custom domain is set).
     * @param  array<string, mixed>  $body  Additional site configuration (e.g., custom_domain, repo, etc.).
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/createSite
     */
    public function createSite(string $name, array $body = []): array
    {
        $payload = array_merge(['name' => $name], $body);

        return $this->request('POST', '/sites', $payload);
    }

    /**
     * Delete a site permanently.
     *
     * @param  string  $siteId  The site ID to delete.
     *
     * @see https://open-api.netlify.com/#operation/deleteSite
     */
    public function deleteSite(string $siteId): void
    {
        $this->request('DELETE', '/sites/' . urlencode($siteId));
    }

    /**
     * List deploys for a site.
     *
     * @param  string  $siteId  The site ID.
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $perPage  Number of results per page (max 100).
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/listSiteDeploys
     */
    public function listDeploys(string $siteId, int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId) . '/deploys', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Create a new deploy for a site.
     *
     * @param  string  $siteId  The site ID.
     * @param  array<string, mixed>  $body  Deploy payload (e.g., title, branch, framework, etc.).
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/createSiteDeploy
     */
    public function createDeploy(string $siteId, array $body = []): array
    {
        return $this->request('POST', '/sites/' . urlencode($siteId) . '/deploys', $body);
    }

    /**
     * List forms for a site.
     *
     * @param  string  $siteId  The site ID.
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/listSiteForms
     */
    public function listForms(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId) . '/forms');
    }

    /**
     * Get details for a single form.
     *
     * @param  string  $formId  The form ID.
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/getForm
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     *
     * @see https://open-api.netlify.com/#operation/getCurrentUser
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/sites").
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Netlify API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Netlify access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Netlify API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Netlify API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the access token may be invalid.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Netlify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Netlify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Netlify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Netlify API: {$e->getMessage()}");
        }
    }
}
