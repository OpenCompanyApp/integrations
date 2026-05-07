<?php

namespace OpenCompany\Integrations\AlphaVantage;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Alpha Vantage API.
 *
 * Handles API-key injection, function routing, response parsing for JSON and
 * CSV endpoints, and Alpha Vantage error or rate-limit normalization.
 */
class AlphaVantageService
{
    /**
     * @param  string  $apiKey  Alpha Vantage API key.
     * @param  string  $baseUrl  Alpha Vantage query endpoint URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://www.alphavantage.co/query',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '?');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Execute one Alpha Vantage function.
     *
     * @param  array<string, mixed>  $params  Function query parameters without apikey.
     * @return array<string, mixed>
     */
    public function query(string $function, array $params = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Alpha Vantage API key is not configured.');
        }

        $query = $this->cleanQuery(array_merge(['function' => $function], $params, ['apikey' => $this->apiKey]));

        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl, $query);

            return $this->parseResponse($response, $function);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Alpha Vantage API connection error: {$function}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Alpha Vantage API: {$e->getMessage()}");
        }
    }

    /**
     * Remove empty values and comma-join array filters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function cleanQuery(array $query): array
    {
        $clean = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $items = array_values(array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== ''));
                if ($items === []) {
                    continue;
                }
                $clean[$key] = implode(',', array_map(static fn (mixed $item): string => (string) $item, $items));

                continue;
            }

            $clean[$key] = $value;
        }

        return $clean;
    }

    /**
     * Parse Alpha Vantage JSON or CSV responses and normalize service errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $function): array
    {
        $contentType = (string) $response->header('Content-Type');
        $json = str_contains(strtolower($contentType), 'json') ? $response->json() : null;

        if (!$response->successful()) {
            $message = is_array($json) ? ($json['Error Message'] ?? $json['Note'] ?? $json['Information'] ?? $json['message'] ?? null) : null;
            $message = is_string($message) ? $message : $response->body();
            Log::error("Alpha Vantage API error: {$function}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('Alpha Vantage API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            foreach (['Error Message', 'Note', 'Information'] as $key) {
                if (isset($json[$key]) && is_string($json[$key])) {
                    throw new RuntimeException('Alpha Vantage API error: '.$json[$key]);
                }
            }

            return $json;
        }

        $body = $response->body();
        if ($body !== '') {
            return ['body' => $body, 'status' => $response->status(), 'content_type' => $contentType];
        }

        return ['success' => true, 'status' => $response->status()];
    }
}
