<?php

namespace OpenCompany\Integrations\CloudConvert;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudConvertService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.cloudconvert.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Create a new job with an optional tasks array.
     *
     * @param  array  $tasks  Array of task definitions (e.g., [['name' => 'import', 'operation' => 'import/url', 'input' => '...']]).
     * @param  string|null  $tag  Optional tag for the job.
     * @param  string|null  $webhookUrl  Optional webhook URL for job completion.
     */
    public function createJob(array $tasks = [], ?string $tag = null, ?string $webhookUrl = null): array
    {
        $data = [];

        if (!empty($tasks)) {
            $data['tasks'] = $tasks;
        }

        if ($tag !== null) {
            $data['tag'] = $tag;
        }

        if ($webhookUrl !== null) {
            $data['webhook_url'] = $webhookUrl;
        }

        return $this->request('POST', '/jobs', $data);
    }

    /**
     * Get a job by ID.
     */
    public function getJob(string $jobId): array
    {
        return $this->request('GET', '/jobs/' . urlencode($jobId));
    }

    /**
     * List jobs with optional filtering and pagination.
     */
    public function listJobs(int $perPage = 20, int $page = 1, ?string $status = null, ?string $tag = null): array
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($tag !== null) {
            $params['tag'] = $tag;
        }

        return $this->request('GET', '/jobs', $params);
    }

    /**
     * Create a standalone task.
     *
     * @param  string  $operation  The task operation (e.g., 'import/url', 'convert', 'export/url').
     * @param  array  $payload  Operation-specific payload.
     * @param  string|null  $name  Optional name for the task.
     * @param  string|null  $input  Optional input task name to chain from.
     */
    public function createTask(string $operation, array $payload = [], ?string $name = null, ?string $input = null): array
    {
        $data = [
            'operation' => $operation,
        ];

        if (!empty($payload)) {
            $data['payload'] = $payload;
        }

        if ($name !== null) {
            $data['name'] = $name;
        }

        if ($input !== null) {
            $data['input'] = $input;
        }

        return $this->request('POST', '/tasks', $data);
    }

    /**
     * Get a task by ID.
     */
    public function getTask(string $taskId): array
    {
        return $this->request('GET', '/tasks/' . urlencode($taskId));
    }

    /**
     * List tasks with optional filtering and pagination.
     */
    public function listTasks(int $perPage = 20, int $page = 1, ?string $status = null, ?string $operation = null, ?string $jobId = null): array
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($operation !== null) {
            $params['operation'] = $operation;
        }

        if ($jobId !== null) {
            $params['job_id'] = $jobId;
        }

        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Get the current authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the CloudConvert API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('CloudConvert API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("CloudConvert API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("CloudConvert API endpoint not available (HTTP {$response->status()}). Check your API key and base URL.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("CloudConvert API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("CloudConvert API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("CloudConvert API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to CloudConvert API: {$e->getMessage()}");
        }
    }
}
