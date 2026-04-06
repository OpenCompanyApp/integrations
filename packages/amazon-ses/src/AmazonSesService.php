<?php

namespace OpenCompany\Integrations\AmazonSes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmazonSesService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://email.us-east-1.amazonaws.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Send an email via the Amazon SES v2 API.
     *
     * @param  array  $body  The outbound email payload (FromEmailAddress, Destination, Content, etc.).
     * @return array The API response.
     */
    public function sendEmail(array $body): array
    {
        return $this->request('POST', '/v2/email/outbound-emails', $body);
    }

    /**
     * Get an email template by name.
     *
     * @param  string  $name  The template name.
     * @return array The template details.
     */
    public function getTemplate(string $name): array
    {
        return $this->request('GET', '/v2/email/templates/' . urlencode($name));
    }

    /**
     * List all email templates.
     *
     * @param  int|null  $pageSize  Maximum number of templates to return per page.
     * @param  string|null  $nextToken  Pagination token from a previous response.
     * @return array The list of templates.
     */
    public function listTemplates(?int $pageSize = null, ?string $nextToken = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['PageSize'] = $pageSize;
        }
        if ($nextToken !== null) {
            $params['NextToken'] = $nextToken;
        }

        return $this->request('GET', '/v2/email/templates', $params);
    }

    /**
     * Create a new email template.
     *
     * @param  array  $body  The template definition (TemplateName, Subject, HtmlContent, TextContent).
     * @return array The API response.
     */
    public function createTemplate(array $body): array
    {
        return $this->request('POST', '/v2/email/templates', $body);
    }

    /**
     * List suppressed email addresses for a configuration set.
     *
     * @param  string  $configurationSet  The configuration set name.
     * @param  int|null  $pageSize  Maximum number of suppressions to return per page.
     * @param  string|null  $nextToken  Pagination token from a previous response.
     * @return array The list of suppressions.
     */
    public function listSuppressions(string $configurationSet, ?int $pageSize = null, ?string $nextToken = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['PageSize'] = $pageSize;
        }
        if ($nextToken !== null) {
            $params['NextToken'] = $nextToken;
        }

        return $this->request('GET', '/v2/suppression/' . urlencode($configurationSet), $params);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array The user details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Request body (POST/PUT) or query parameters (GET).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Amazon SES API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Request body (POST/PUT) or query parameters (GET).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Amazon SES access token is not configured.');
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
                    Log::warning("Amazon SES API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Amazon SES API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Amazon SES API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Amazon SES API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Amazon SES API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Amazon SES API: {$e->getMessage()}");
        }
    }
}
