<?php

namespace OpenCompany\Integrations\Mindee;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Mindee document OCR API.
 *
 * Handles authentication, HTTP communication, and file uploads for
 * document parsing endpoints (invoices, receipts, passports, custom).
 */
class MindeeService
{
    /**
     * Create a new MindeeService instance.
     *
     * @param string $apiKey  Mindee API key for Bearer token authentication.
     * @param string $baseUrl Base URL for the Mindee API (default: https://api.mindee.net/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.mindee.net/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Parse an invoice document.
     *
     * Accepts either a file path or a base64-encoded string.
     *
     * @param string      $document   File path or base64-encoded document content.
     * @param string|null $fileName   Optional filename override (used for base64 uploads).
     * @param array       $options    Additional options (e.g., include_merging, cropper).
     * @return array Parsed invoice prediction result.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function parseInvoice(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict('/products/invoices/v4/predict', $document, $fileName, $options);
    }

    /**
     * Parse an expense receipt document.
     *
     * Accepts either a file path or a base64-encoded string.
     *
     * @param string      $document   File path or base64-encoded document content.
     * @param string|null $fileName   Optional filename override (used for base64 uploads).
     * @param array       $options    Additional options (e.g., include_merging, cropper).
     * @return array Parsed receipt prediction result.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function parseReceipt(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict('/products/expense_receipts/v5/predict', $document, $fileName, $options);
    }

    /**
     * Parse a passport document.
     *
     * Accepts either a file path or a base64-encoded string.
     *
     * @param string      $document   File path or base64-encoded document content.
     * @param string|null $fileName   Optional filename override (used for base64 uploads).
     * @param array       $options    Additional options.
     * @return array Parsed passport prediction result.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function parsePassport(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict('/products/passport/v1/predict', $document, $fileName, $options);
    }

    /**
     * Parse a custom document using a specific endpoint ID.
     *
     * Accepts either a file path or a base64-encoded string.
     *
     * @param string      $endpointId The custom endpoint ID (from your Mindee dashboard).
     * @param string      $document   File path or base64-encoded document content.
     * @param string|null $fileName   Optional filename override (used for base64 uploads).
     * @param array       $options    Additional options.
     * @return array Parsed custom document prediction result.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function parseCustom(string $endpointId, string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict('/custom/v1/predict', $document, $fileName, array_merge($options, [
            'endpoint_id' => $endpointId,
        ]));
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array User data from the Mindee API.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Send a document to a prediction endpoint.
     *
     * Detects whether the document input is a file path or a base64 string,
     * and sends the appropriate request type (multipart or JSON).
     *
     * @param string      $path     API endpoint path (e.g., /products/invoices/v4/predict).
     * @param string      $document File path or base64-encoded content.
     * @param string|null $fileName Filename for the upload.
     * @param array       $options  Additional query parameters or options.
     * @return array Prediction result from the API.
     */
    private function predict(string $path, string $document, ?string $fileName, array $options = []): array
    {
        $url = $this->baseUrl . $path;

        if (!empty($options)) {
            $separator = str_contains($url, '?') ? '&' : '?';
            $url .= $separator . http_build_query($options);
        }

        $http = $this->buildHttpClient();

        // Detect if document is a file path or base64 data
        if (file_exists($document) && is_readable($document)) {
            $name = $fileName ?? basename($document);
            $response = $http->attach('document', file_get_contents($document), $name)->post($url);
        } else {
            // Treat as base64-encoded content
            $name = $fileName ?? 'document.pdf';
            $response = $http->post($url, [
                'document' => $document,
            ]);
        }

        return $this->handleResponse($response, 'POST', $path);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API endpoint path.
     * @param array  $data   Query or body parameters.
     * @return array Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $url = $this->baseUrl . $path;
        $http = $this->buildHttpClient();

        $response = match (strtoupper($method)) {
            'GET' => $http->get($url, $data),
            'POST' => $http->post($url, $data),
            'PUT' => $http->put($url, $data),
            'DELETE' => $http->delete($url, $data),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        return $this->handleResponse($response, $method, $path);
    }

    /**
     * Build an HTTP client instance with authentication headers.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     *
     * @throws \RuntimeException If the API key is not configured.
     */
    private function buildHttpClient(): \Illuminate\Http\Client\PendingRequest
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Mindee API key is not configured.');
        }

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(60);
    }

    /**
     * Handle an API response, logging errors and throwing on failure.
     *
     * @param \Illuminate\Http\Client\Response $response The HTTP response.
     * @param string                           $method   The HTTP method used.
     * @param string                           $path     The API path called.
     * @return array Parsed JSON response body.
     *
     * @throws \RuntimeException On non-successful responses or connection errors.
     */
    private function handleResponse(\Illuminate\Http\Client\Response $response, string $method, string $path): array
    {
        try {
            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Mindee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    "Mindee API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error("Mindee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Mindee API: {$e->getMessage()}");
        }
    }
}
