<?php

namespace OpenCompany\Integrations\Orcid;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ORCID Public API v3.0.
 *
 * Handles endpoint routing, optional bearer tokens, content negotiation for
 * JSON/XML/CSV, response parsing, and ORCID error normalization.
 */
class OrcidService
{
    /**
     * @param  string  $baseUrl  ORCID Public API base URL.
     * @param  string  $accessToken  Optional /read-public bearer token.
     */
    public function __construct(
        private string $baseUrl = 'https://pub.orcid.org/v3.0',
        private string $accessToken = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Query an ORCID API path.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function get(string $path, array $query = [], string $format = 'json'): array
    {
        $token = (string) ($query['access_token'] ?? $this->accessToken);
        unset($query['access_token']);

        try {
            $request = $this->request($format, $token);
            $response = $request->get($this->urlWithQuery($this->baseUrl.'/'.ltrim($path, '/'), $query));

            return $this->parseResponse($response, $path, $format);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ORCID API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to ORCID API: {$e->getMessage()}");
        }
    }

    /**
     * Create an HTTP request with the correct Accept header.
     */
    private function request(string $format, string $token): PendingRequest
    {
        $accept = match ($format) {
            'csv' => 'text/csv',
            'xml' => 'application/vnd.orcid+xml',
            default => 'application/vnd.orcid+json, application/json',
        };

        $request = Http::accept($accept)
            ->withUserAgent('OpenCompany Integrations orcid/1.0 (mailto:agent@example.test)')
            ->timeout(60);

        return $token === '' ? $request : $request->withToken($token);
    }

    /**
     * Build a URL with ORCID-compatible query parameters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $normalized = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized === [] ? $url : $url.'?'.http_build_query($normalized, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Parse ORCID JSON, XML, or CSV/text responses.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path, string $format): array
    {
        $contentType = (string) $response->header('Content-Type', '');
        $json = str_contains(strtolower($contentType), 'json') || $format === 'json' ? $response->json() : null;

        if (!$response->successful()) {
            $message = $this->errorMessage($json) ?? $response->body();
            Log::error("ORCID API error: {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('ORCID API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            $message = $this->errorMessage($json);
            if ($message !== null) {
                throw new RuntimeException('ORCID API error ('.$response->status().'): '.$message);
            }

            return $json;
        }

        return [
            'body' => $response->body(),
            'status' => $response->status(),
            'content_type' => $contentType,
        ];
    }

    /**
     * Extract a readable ORCID error message from JSON responses.
     */
    private function errorMessage(mixed $json): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        foreach (['user-message', 'developer-message', 'error_description', 'message'] as $key) {
            if (isset($json[$key]) && is_scalar($json[$key])) {
                return (string) $json[$key];
            }
        }

        return null;
    }
}
