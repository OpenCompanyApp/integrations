<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleSearchConsoleService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://searchconsole.googleapis.com',
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
     * List sites the authenticated user has access to.
     *
     * @param  int|null  $pageSize  Maximum number of results per page.
     * @param  string|null  $pageToken  Token for the next page of results.
     * @return array<string, mixed>
     */
    public function listSites(?int $pageSize = null, ?string $pageToken = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['pageSize'] = $pageSize;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v3/sites', $params);
    }

    /**
     * Get details for a single site.
     *
     * @param  string  $id  The site URL (e.g., "https://example.com/").
     * @return array<string, mixed>
     */
    public function getSite(string $id): array
    {
        return $this->request('GET', '/v3/sites/' . urlencode($id));
    }

    /**
     * List sitemaps for a site.
     *
     * @param  string  $siteUrl  The site URL.
     * @param  int|null  $pageSize  Maximum number of results per page.
     * @param  string|null  $pageToken  Token for the next page of results.
     * @param  bool|null  $shortUrls  Whether to return short URLs.
     * @return array<string, mixed>
     */
    public function listSitemaps(string $siteUrl, ?int $pageSize = null, ?string $pageToken = null, ?bool $shortUrls = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['pageSize'] = $pageSize;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($shortUrls !== null) {
            $params['shortUrls'] = $shortUrls;
        }

        return $this->request('GET', '/v3/sites/' . urlencode($siteUrl) . '/sitemaps', $params);
    }

    /**
     * Get details for a single sitemap.
     *
     * @param  string  $siteUrl  The site URL.
     * @param  string  $id  The sitemap URL or ID.
     * @return array<string, mixed>
     */
    public function getSitemap(string $siteUrl, string $id): array
    {
        return $this->request('GET', '/v3/sites/' . urlencode($siteUrl) . '/sitemaps/' . urlencode($id));
    }

    /**
     * List search analytics data for a site.
     *
     * @param  string  $siteUrl  The site URL.
     * @param  string  $startDate  Start date in YYYY-MM-DD format.
     * @param  string  $endDate  End date in YYYY-MM-DD format.
     * @param  array<string>|null  $dimensions  Dimensions to group by (e.g., ["query", "page"]).
     * @param  string|null  $type  Search type: "web", "image", "video", or "news".
     * @return array<string, mixed>
     */
    public function listSearchAnalytics(string $siteUrl, string $startDate, string $endDate, ?array $dimensions = null, ?string $type = null): array
    {
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        if ($dimensions !== null) {
            $params['dimensions'] = $dimensions;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/v3/sites/' . urlencode($siteUrl) . '/searchAnalytics', $params);
    }

    /**
     * List URL inspection results for a site.
     *
     * @param  string  $siteUrl  The site URL.
     * @param  string|null  $pageToken  Token for the next page of results.
     * @param  int|null  $limit  Maximum number of results.
     * @param  string|null  $inspectionResult  Filter by inspection result status.
     * @return array<string, mixed>
     */
    public function listUrlInspection(string $siteUrl, ?string $pageToken = null, ?int $limit = null, ?string $inspectionResult = null): array
    {
        $params = [];
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($inspectionResult !== null) {
            $params['inspectionResult'] = $inspectionResult;
        }

        return $this->request('GET', '/v3/sites/' . urlencode($siteUrl) . '/urlInspection', $params);
    }

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v3/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Search Console API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Search Console access token is not configured.');
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
                    Log::warning("Google Search Console API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Google Search Console API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the token may have expired.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Google Search Console API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Search Console API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Search Console API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Search Console API: {$e->getMessage()}");
        }
    }
}
