<?php

namespace OpenCompany\Integrations\Mindee;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Mindee document parsing REST API.
 *
 * Handles Token authentication, product endpoint construction, document
 * payload encoding, asynchronous polling, and error normalization.
 */
class MindeeService
{
    /**
     * @param  string  $apiKey  Mindee API key for Token authentication.
     * @param  string  $baseUrl  Base URL for the Mindee API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.mindee.net/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Parse an invoice document with Mindee's off-the-shelf invoice API.
     *
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function parseInvoice(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predictProduct('mindee', 'invoices', 'v4', $document, $fileName, $options);
    }

    /**
     * Parse an expense receipt document with Mindee's off-the-shelf receipt API.
     *
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function parseReceipt(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predictProduct('mindee', 'expense_receipts', 'v5', $document, $fileName, $options);
    }

    /**
     * Parse a passport document with Mindee's off-the-shelf passport API.
     *
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function parsePassport(string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predictProduct('mindee', 'passport', 'v1', $document, $fileName, $options);
    }

    /**
     * Parse a document with any Mindee product endpoint.
     *
     * @param  string  $account  Mindee account name, usually "mindee" for off-the-shelf APIs.
     * @param  string  $apiName  API name such as "invoices" or a custom model name.
     * @param  string  $apiVersion  API version such as "v4" or "1".
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function predictProduct(string $account, string $apiName, string $apiVersion, string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict($this->productPath($account, $apiName, $apiVersion, 'predict'), $document, $fileName, $options);
    }

    /**
     * Enqueue an asynchronous document prediction with any Mindee product endpoint.
     *
     * @param  string  $account  Mindee account name.
     * @param  string  $apiName  API name.
     * @param  string  $apiVersion  API version.
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function predictProductAsync(string $account, string $apiName, string $apiVersion, string $document, ?string $fileName = null, array $options = []): array
    {
        return $this->predict($this->productPath($account, $apiName, $apiVersion, 'predict_async'), $document, $fileName, $options);
    }

    /**
     * Retrieve an asynchronous prediction job status or completed document redirect.
     *
     * @param  string  $account  Mindee account name.
     * @param  string  $apiName  API name.
     * @param  string  $apiVersion  API version.
     * @param  string  $jobId  Mindee asynchronous job ID.
     * @return array<string, mixed>
     */
    public function getAsyncPrediction(string $account, string $apiName, string $apiVersion, string $jobId): array
    {
        return $this->request('GET', $this->productPath($account, $apiName, $apiVersion, 'documents/queue/'.rawurlencode($jobId)));
    }

    /**
     * Parse a document using an endpoint ID in account/api/version format.
     *
     * @param  string  $endpointId  Endpoint ID such as "acme/purchase_orders/v1".
     * @param  string  $document  File path, URL, or base64-encoded document content.
     * @param  string|null  $fileName  Filename for multipart or base64 uploads.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    public function parseCustom(string $endpointId, string $document, ?string $fileName = null, array $options = []): array
    {
        [$account, $apiName, $apiVersion] = $this->parseEndpointId($endpointId);

        return $this->predictProduct($account, $apiName, $apiVersion, $document, $fileName, $options);
    }

    /**
     * Send a document to a Mindee prediction endpoint.
     *
     * @param  string  $path  API endpoint path.
     * @param  string  $document  File path, URL, or base64-encoded content.
     * @param  string|null  $fileName  Filename for the upload.
     * @param  array<string, mixed>  $options  Additional query parameters.
     * @return array<string, mixed>
     */
    private function predict(string $path, string $document, ?string $fileName, array $options = []): array
    {
        $url = $this->urlWithQuery($this->baseUrl.$path, $options);
        $http = $this->buildHttpClient();

        if (is_file($document) && is_readable($document)) {
            $response = $http
                ->attach('document', file_get_contents($document), $fileName ?? basename($document))
                ->post($url);

            return $this->handleResponse($response, 'POST', $path);
        }

        $response = $http->post($url, ['document' => $document]);

        return $this->handleResponse($response, 'POST', $path);
    }

    /**
     * Make a JSON API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $http = $this->buildHttpClient();
        $url = $this->baseUrl.$path;

        $response = match (strtoupper($method)) {
            'GET' => $http->get($url, $data),
            'POST' => $http->post($url, $data),
            default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
        };

        return $this->handleResponse($response, $method, $path);
    }

    /**
     * Build an authenticated HTTP client.
     *
     * @throws RuntimeException If the API key is not configured.
     */
    private function buildHttpClient(): \Illuminate\Http\Client\PendingRequest
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Mindee API key is not configured.');
        }

        return Http::withHeaders([
            'Authorization' => 'Token '.$this->apiKey,
            'Accept' => 'application/json',
        ])->timeout(60);
    }

    /**
     * Handle an API response.
     *
     * @param  Response  $response  HTTP response.
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path called.
     * @return array<string, mixed>
     *
     * @throws RuntimeException On non-successful responses.
     */
    private function handleResponse(Response $response, string $method, string $path): array
    {
        try {
            if ($response->status() >= 300 && $response->status() < 400) {
                return [
                    'status' => $response->status(),
                    'location' => $response->header('Location'),
                ];
            }

            if (! $response->successful()) {
                $error = $response->json('api_request.error') ?? $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Mindee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Mindee API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            if ($response->body() === '') {
                return ['success' => true, 'status' => $response->status()];
            }

            return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
        } catch (ConnectionException $e) {
            Log::error("Mindee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Mindee API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Mindee product path.
     */
    private function productPath(string $account, string $apiName, string $apiVersion, string $operation): string
    {
        foreach (compact('account', 'apiName', 'apiVersion') as $name => $value) {
            if ($value === '') {
                throw new RuntimeException("{$name} must be provided.");
            }
        }

        return '/products/'.rawurlencode($account).'/'.rawurlencode($apiName).'/'.rawurlencode($apiVersion).'/'.$operation;
    }

    /**
     * Parse custom endpoint IDs from account/api/version strings.
     *
     * @return array{0: string, 1: string, 2: string}
     */
    private function parseEndpointId(string $endpointId): array
    {
        $parts = array_values(array_filter(explode('/', trim($endpointId, '/')), static fn (string $part): bool => $part !== ''));

        if (count($parts) !== 3) {
            throw new RuntimeException('endpoint_id must use account/api_name/api_version format, for example acme/purchase_orders/v1.');
        }

        return [$parts[0], $parts[1], $parts[2]];
    }

    /**
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }

                $parts[] = rawurlencode((string) $key).'='.rawurlencode(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
