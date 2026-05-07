<?php

namespace OpenCompany\Integrations\Firecrawl;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Firecrawl API.
 *
 * Handles authentication, HTTP communication, and error handling for Firecrawl v2 JSON endpoints.
 */
class FirecrawlService
{
    /**
     * @param  string  $apiKey  Firecrawl API key.
     * @param  string  $baseUrl  Firecrawl API base URL, including the API version path.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.firecrawl.dev/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Scrape a single URL and return its content.
     *
     * @param  string  $url  The URL to scrape.
     * @param  array<string, mixed>  $options  Optional scrape options.
     * @return array<string, mixed> The scrape result.
     */
    public function scrape(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/scrape', $body);
    }

    /**
     * Start a crawl job for a URL. Returns the crawl job ID and status.
     *
     * @param  string  $url  The root URL to crawl.
     * @param  array<string, mixed>  $options  Optional crawl options.
     * @return array<string, mixed> The crawl job info including `id`.
     */
    public function crawl(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/crawl', $body);
    }

    /**
     * Get the status and results of a crawl job.
     *
     * @param  string  $id  The crawl job ID.
     * @return array<string, mixed> The crawl status and any available data.
     */
    public function getCrawlStatus(string $id): array
    {
        return $this->request('GET', '/crawl/'.rawurlencode($id));
    }

    /**
     * Cancel a crawl job.
     *
     * @param  string  $id  The crawl job ID.
     * @return array<string, mixed>
     */
    public function cancelCrawl(string $id): array
    {
        return $this->request('DELETE', '/crawl/'.rawurlencode($id));
    }

    /**
     * Get failed pages for a crawl job.
     *
     * @param  string  $id  The crawl job ID.
     * @return array<string, mixed>
     */
    public function getCrawlErrors(string $id): array
    {
        return $this->request('GET', '/crawl/'.rawurlencode($id).'/errors');
    }

    /**
     * Get currently active crawl jobs for the team.
     *
     * @return array<string, mixed>
     */
    public function getActiveCrawls(): array
    {
        return $this->request('GET', '/crawl/active');
    }

    /**
     * Preview crawl parameters generated from a natural-language prompt.
     *
     * @param  array<string, mixed>  $body  Preview request payload.
     * @return array<string, mixed>
     */
    public function previewCrawlParams(array $body): array
    {
        return $this->request('POST', '/crawl/params-preview', $body);
    }

    /**
     * Map a URL to discover all linked pages on the site.
     *
     * @param  string  $url  The root URL to map.
     * @param  array<string, mixed>  $options  Optional map options.
     * @return array<string, mixed> The map result including discovered URLs.
     */
    public function map(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/map', $body);
    }

    /**
     * Extract structured data from one or more URLs using AI.
     *
     * Search the web and optionally scrape search results.
     *
     * @param  array<string, mixed>  $body  Search request payload.
     * @return array<string, mixed>
     */
    public function search(array $body): array
    {
        return $this->request('POST', '/search', $body);
    }

    /**
     * Start a batch scrape job for multiple URLs.
     *
     * @param  array<string>  $urls  URLs to scrape.
     * @param  array<string, mixed>  $options  Optional batch scrape options.
     * @return array<string, mixed>
     */
    public function batchScrape(array $urls, array $options = []): array
    {
        return $this->request('POST', '/batch/scrape', array_merge(['urls' => $urls], $options));
    }

    /**
     * Get the status and results of a batch scrape job.
     *
     * @param  string  $id  Batch scrape job ID.
     * @return array<string, mixed>
     */
    public function getBatchScrapeStatus(string $id): array
    {
        return $this->request('GET', '/batch/scrape/'.rawurlencode($id));
    }

    /**
     * Cancel a batch scrape job.
     *
     * @param  string  $id  Batch scrape job ID.
     * @return array<string, mixed>
     */
    public function cancelBatchScrape(string $id): array
    {
        return $this->request('DELETE', '/batch/scrape/'.rawurlencode($id));
    }

    /**
     * Get failed pages for a batch scrape job.
     *
     * @param  string  $id  Batch scrape job ID.
     * @return array<string, mixed>
     */
    public function getBatchScrapeErrors(string $id): array
    {
        return $this->request('GET', '/batch/scrape/'.rawurlencode($id).'/errors');
    }

    /**
     * Extract structured data from one or more URLs using AI.
     *
     * @param  array<string>  $urls  The URLs to extract data from.
     * @param  array<string, mixed>  $options  Optional extraction options.
     * @return array<string, mixed> The extraction results.
     */
    public function extract(array $urls, array $options = []): array
    {
        $body = array_merge(['urls' => $urls], $options);

        return $this->request('POST', '/extract', $body);
    }

    /**
     * Get the status of an extract job.
     *
     * @param  string  $id  Extract job ID.
     * @return array<string, mixed>
     */
    public function getExtractStatus(string $id): array
    {
        return $this->request('GET', '/extract/'.rawurlencode($id));
    }

    /**
     * Start an agentic web data gathering task.
     *
     * @param  array<string, mixed>  $body  Agent request payload.
     * @return array<string, mixed>
     */
    public function agent(array $body): array
    {
        return $this->request('POST', '/agent', $body);
    }

    /**
     * Get the status of an agent job.
     *
     * @param  string  $jobId  Agent job ID.
     * @return array<string, mixed>
     */
    public function getAgentStatus(string $jobId): array
    {
        return $this->request('GET', '/agent/'.rawurlencode($jobId));
    }

    /**
     * Cancel an agent job.
     *
     * @param  string  $jobId  Agent job ID.
     * @return array<string, mixed>
     */
    public function cancelAgent(string $jobId): array
    {
        return $this->request('DELETE', '/agent/'.rawurlencode($jobId));
    }

    /**
     * Create a browser session.
     *
     * @param  array<string, mixed>  $body  Browser session options.
     * @return array<string, mixed>
     */
    public function createBrowser(array $body = []): array
    {
        return $this->request('POST', '/browser', $body);
    }

    /**
     * List browser sessions.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listBrowsers(array $params = []): array
    {
        return $this->request('GET', '/browser', $params);
    }

    /**
     * Execute code or a prompt in a browser session.
     *
     * @param  string  $sessionId  Browser session ID.
     * @param  array<string, mixed>  $body  Execution payload.
     * @return array<string, mixed>
     */
    public function executeBrowser(string $sessionId, array $body): array
    {
        return $this->request('POST', '/browser/'.rawurlencode($sessionId).'/execute', $body);
    }

    /**
     * Delete a browser session.
     *
     * @param  string  $sessionId  Browser session ID.
     * @return array<string, mixed>
     */
    public function deleteBrowser(string $sessionId): array
    {
        return $this->request('DELETE', '/browser/'.rawurlencode($sessionId));
    }

    /**
     * List recent API activity for the team.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function activity(array $params = []): array
    {
        return $this->request('GET', '/team/activity', $params);
    }

    /**
     * Get remaining credits for the authenticated team.
     *
     * @return array<string, mixed>
     */
    public function creditUsage(): array
    {
        return $this->request('GET', '/team/credit-usage');
    }

    /**
     * Get historical credit usage for the authenticated team.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function historicalCreditUsage(array $params = []): array
    {
        return $this->request('GET', '/team/credit-usage/historical', $params);
    }

    /**
     * Get remaining extract tokens for the authenticated team.
     *
     * @return array<string, mixed>
     */
    public function tokenUsage(): array
    {
        return $this->request('GET', '/team/token-usage');
    }

    /**
     * Get historical token usage for the authenticated team.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function historicalTokenUsage(array $params = []): array
    {
        return $this->request('GET', '/team/token-usage/historical', $params);
    }

    /**
     * Get team queue status.
     *
     * @return array<string, mixed>
     */
    public function queueStatus(): array
    {
        return $this->request('GET', '/team/queue-status');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Firecrawl API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing, the request fails, or the server returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Firecrawl API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Firecrawl API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Firecrawl API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the base URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Firecrawl API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Firecrawl API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Firecrawl API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Firecrawl API: {$e->getMessage()}");
        }
    }
}
