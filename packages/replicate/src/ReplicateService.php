<?php

namespace OpenCompany\Integrations\Replicate;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReplicateService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.replicate.com/v1',
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
     * List predictions.
     *
     * @return array<string, mixed>
     */
    public function listPredictions(): array
    {
        return $this->request('GET', '/predictions');
    }

    /**
     * Get a single prediction by ID.
     *
     * @param  string  $predictionId  The prediction identifier.
     * @return array<string, mixed>
     */
    public function getPrediction(string $predictionId): array
    {
        return $this->request('GET', '/predictions/' . urlencode($predictionId));
    }

    /**
     * Create a new prediction.
     *
     * @param  string  $modelVersion  The model version identifier.
     * @param  array<string, mixed>  $input  The model input values.
     * @param  string|null  $webhook  Optional webhook URL for completion notifications.
     * @param  array<string>|null  $webhookEvents  Optional list of webhook events.
     * @return array<string, mixed>
     */
    public function createPrediction(
        string $modelVersion,
        array $input,
        ?string $webhook = null,
        ?array $webhookEvents = null,
    ): array {
        $body = [
            'version' => $modelVersion,
            'input' => $input,
        ];

        if ($webhook !== null) {
            $body['webhook'] = $webhook;
        }

        if ($webhookEvents !== null) {
            $body['webhook_events_filter'] = $webhookEvents;
        }

        return $this->request('POST', '/predictions', $body);
    }

    /**
     * List models.
     *
     * @return array<string, mixed>
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Get a single model by owner and name.
     *
     * @param  string  $modelOwner  The model owner (user or org).
     * @param  string  $modelName  The model name.
     * @return array<string, mixed>
     */
    public function getModel(string $modelOwner, string $modelName): array
    {
        return $this->request('GET', '/models/' . urlencode($modelOwner) . '/' . urlencode($modelName));
    }

    /**
     * List collections.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get the current user's profile and billing information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Replicate API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Replicate API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(120);

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
                    Log::warning("Replicate API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Replicate API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("Replicate API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Replicate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Replicate API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Replicate API: {$e->getMessage()}");
        }
    }
}
