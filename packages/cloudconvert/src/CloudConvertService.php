<?php

namespace OpenCompany\Integrations\CloudConvert;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the CloudConvert API v2.
 *
 * Handles bearer-token authentication, async and sync API hosts, response
 * parsing, and endpoint helpers used by CloudConvert tools.
 */
class CloudConvertService
{
    /**
     * @param  string  $apiKey  CloudConvert API key.
     * @param  string  $baseUrl  Async CloudConvert API base URL, including /v2.
     * @param  string  $syncBaseUrl  Sync CloudConvert API base URL, including /v2.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.cloudconvert.com/v2',
        private string $syncBaseUrl = 'https://sync.api.cloudconvert.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->syncBaseUrl = rtrim($this->syncBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Create an async job.
     *
     * @param  array<string, mixed>  $tasks  Named CloudConvert task definitions.
     * @param  array<string, mixed>  $options  Additional job options such as tag or webhook_url.
     * @return array<string, mixed>
     */
    public function createJob(array $tasks, array $options = []): array
    {
        return $this->apiPost('/jobs', array_filter([
            'tasks' => $tasks,
            'tag' => $options['tag'] ?? null,
            'webhook_url' => $options['webhook_url'] ?? null,
        ], static fn (mixed $value): bool => $value !== null && $value !== []));
    }

    /**
     * Create a job and wait for completion using the sync API host.
     *
     * @param  array<string, mixed>  $tasks  Named CloudConvert task definitions.
     * @param  array<string, mixed>  $options  Additional sync job options.
     * @return array<string, mixed>
     */
    public function createJobAndWait(array $tasks, array $options = []): array
    {
        return $this->apiPost('/jobs', array_filter([
            'tasks' => $tasks,
            'tag' => $options['tag'] ?? null,
            'redirect' => $options['redirect'] ?? null,
        ], static fn (mixed $value): bool => $value !== null && $value !== []), sync: true);
    }

    /**
     * Get a job by ID.
     *
     * @param  array<string, mixed>  $query  Query parameters such as redirect.
     * @return array<string, mixed>
     */
    public function getJob(string $jobId, array $query = []): array
    {
        return $this->apiGet('/jobs/' . rawurlencode($jobId), $query);
    }

    /**
     * Wait for a job using the sync API host.
     *
     * @param  array<string, mixed>  $query  Query parameters such as redirect.
     * @return array<string, mixed>
     */
    public function waitJob(string $jobId, array $query = []): array
    {
        return $this->apiGet('/jobs/' . rawurlencode($jobId), $query, sync: true);
    }

    /**
     * List jobs using documented filter query keys.
     *
     * @param  array<string, mixed>  $query  List filters and pagination.
     * @return array<string, mixed>
     */
    public function listJobs(array $query = []): array
    {
        return $this->apiGet('/jobs', $query);
    }

    /**
     * Delete a job and its temporary data.
     *
     * @return array<string, mixed>
     */
    public function deleteJob(string $jobId): array
    {
        return $this->apiDelete('/jobs/' . rawurlencode($jobId));
    }

    /**
     * Get a task by ID.
     *
     * @param  array<string, mixed>  $query  Query parameters such as include.
     * @return array<string, mixed>
     */
    public function getTask(string $taskId, array $query = []): array
    {
        return $this->apiGet('/tasks/' . rawurlencode($taskId), $query);
    }

    /**
     * Wait for a task using the sync API host.
     *
     * @return array<string, mixed>
     */
    public function waitTask(string $taskId): array
    {
        return $this->apiGet('/tasks/' . rawurlencode($taskId), sync: true);
    }

    /**
     * List tasks using documented filter query keys.
     *
     * @param  array<string, mixed>  $query  List filters and pagination.
     * @return array<string, mixed>
     */
    public function listTasks(array $query = []): array
    {
        return $this->apiGet('/tasks', $query);
    }

    /**
     * Cancel a waiting or processing task.
     *
     * @return array<string, mixed>
     */
    public function cancelTask(string $taskId): array
    {
        return $this->apiPost('/tasks/' . rawurlencode($taskId) . '/cancel');
    }

    /**
     * Retry a task based on the original task payload.
     *
     * @return array<string, mixed>
     */
    public function retryTask(string $taskId): array
    {
        return $this->apiPost('/tasks/' . rawurlencode($taskId) . '/retry');
    }

    /**
     * Delete a task and its temporary data.
     *
     * @return array<string, mixed>
     */
    public function deleteTask(string $taskId): array
    {
        return $this->apiDelete('/tasks/' . rawurlencode($taskId));
    }

    /**
     * List available operations, formats, engines, and options.
     *
     * @param  array<string, mixed>  $query  Operation filters and include values.
     * @return array<string, mixed>
     */
    public function listOperations(array $query = []): array
    {
        return $this->apiGet('/operations', $query);
    }

    /**
     * Get the authenticated user profile and remaining credits.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/users/me');
    }

    /**
     * Create an account-level webhook.
     *
     * @param  array<string, mixed>  $data  Webhook body with url and events.
     * @return array<string, mixed>
     */
    public function createWebhook(array $data): array
    {
        return $this->apiPost('/webhooks', $data);
    }

    /**
     * List account-level webhooks.
     *
     * @param  array<string, mixed>  $query  List filters and pagination.
     * @return array<string, mixed>
     */
    public function listWebhooks(array $query = []): array
    {
        return $this->apiGet('/users/me/webhooks', $query);
    }

    /**
     * Delete an account-level webhook.
     *
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $webhookId): array
    {
        return $this->apiDelete('/webhooks/' . rawurlencode($webhookId));
    }

    /**
     * Generate a CloudConvert signed URL from a base URL, secret, and job body.
     *
     * @param  array<string, mixed>  $job  Job payload to encode into the URL.
     */
    public function createSignedUrl(string $signedUrlBase, string $signingSecret, array $job, ?string $cacheKey = null): string
    {
        $query = 'job=' . rtrim(strtr(base64_encode(json_encode($job, JSON_THROW_ON_ERROR)), '+/', '-_'), '=');

        if ($cacheKey !== null && $cacheKey !== '') {
            $query .= '&cache_key=' . rawurlencode($cacheKey);
        }

        $url = rtrim($signedUrlBase, '?&') . '?' . $query;

        return $url . '&s=' . hash_hmac('sha256', $url, $signingSecret);
    }

    /**
     * Validate a CloudConvert webhook signature.
     */
    public function verifyWebhookSignature(string $payload, string $signature, string $signingSecret): bool
    {
        return hash_equals(hash_hmac('sha256', $payload, $signingSecret), $signature);
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = [], bool $sync = false): array
    {
        return $this->request('GET', $path, $query, sync: $sync);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = [], bool $sync = false): array
    {
        return $this->request('POST', $path, $data, $query, $sync);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = [], bool $sync = false): array
    {
        return $this->request('PUT', $path, $data, $query, $sync);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = [], bool $sync = false): array
    {
        return $this->request('DELETE', $path, $query, sync: $sync);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or JSON body for POST/PUT.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = [], bool $sync = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $query, $sync);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to CloudConvert.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = [], bool $sync = false): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('CloudConvert API key is not configured.');
        }

        $url = ($sync ? $this->syncBaseUrl : $this->baseUrl) . '/' . ltrim($path, '/');

        try {
            $http = Http::withToken($this->apiKey)
                ->acceptJson()
                ->asJson()
                ->timeout($sync ? 120 : 30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error.message') ?? $response->body();

                Log::error("CloudConvert API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('CloudConvert API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("CloudConvert API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to CloudConvert API: {$e->getMessage()}");
        }
    }
}
