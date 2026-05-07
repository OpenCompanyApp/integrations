<?php

namespace OpenCompany\Integrations\Langfuse;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Langfuse Public API.
 *
 * Handles Basic Auth with project API keys, host URL normalization, JSON
 * request dispatch, error logging, and response parsing for Langfuse tools.
 */
class LangfuseService
{
    /**
     * @param  string  $publicKey  Langfuse project public key.
     * @param  string  $secretKey  Langfuse project secret key.
     * @param  string  $baseUrl  Langfuse host URL or full /api/public base URL.
     */
    public function __construct(
        private string $publicKey = '',
        private string $secretKey = '',
        private string $baseUrl = 'https://cloud.langfuse.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');

        if (!str_ends_with($this->baseUrl, '/api/public')) {
            $this->baseUrl .= '/api/public';
        }
    }

    public function isConfigured(): bool
    {
        return $this->publicKey !== '' && $this->secretKey !== '';
    }

    /**
     * Check Langfuse public API health.
     *
     * @return array<string, mixed>
     */
    public function health(): array
    {
        return $this->request('GET', '/health');
    }

    /**
     * Ingest tracing batches through Langfuse's ingestion endpoint.
     *
     * @param  array<string, mixed>  $body  Ingestion request body.
     * @return array<string, mixed>
     */
    public function ingest(array $body): array
    {
        return $this->request('POST', '/ingestion', $body);
    }

    /**
     * List traces with Langfuse's legacy trace query endpoint.
     *
     * @param  array<string, mixed>  $params  Trace query filters and pagination.
     * @return array<string, mixed>
     */
    public function listTraces(array $params = []): array
    {
        return $this->request('GET', '/traces', $params);
    }

    /**
     * Retrieve a trace by ID.
     *
     * @return array<string, mixed>
     */
    public function getTrace(string $traceId): array
    {
        return $this->request('GET', '/traces/' . rawurlencode($traceId));
    }

    /**
     * Delete a trace by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteTrace(string $traceId): array
    {
        return $this->request('DELETE', '/traces/' . rawurlencode($traceId));
    }

    /**
     * List observations with Langfuse v2 filters.
     *
     * @param  array<string, mixed>  $params  Observation query filters and pagination.
     * @return array<string, mixed>
     */
    public function listObservations(array $params = []): array
    {
        return $this->request('GET', '/v2/observations', $params);
    }

    /**
     * Retrieve an observation by ID.
     *
     * @return array<string, mixed>
     */
    public function getObservation(string $observationId): array
    {
        return $this->request('GET', '/observations/' . rawurlencode($observationId));
    }

    /**
     * Create a score through the v1 score endpoint.
     *
     * @param  array<string, mixed>  $body  Score creation body.
     * @return array<string, mixed>
     */
    public function createScore(array $body): array
    {
        return $this->request('POST', '/scores', $body);
    }

    /**
     * List scores with Langfuse v2 filters.
     *
     * @param  array<string, mixed>  $params  Score query filters and pagination.
     * @return array<string, mixed>
     */
    public function listScores(array $params = []): array
    {
        return $this->request('GET', '/v2/scores', $params);
    }

    /**
     * Retrieve a score by ID.
     *
     * @return array<string, mixed>
     */
    public function getScore(string $scoreId): array
    {
        return $this->request('GET', '/v2/scores/' . rawurlencode($scoreId));
    }

    /**
     * Delete a score by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteScore(string $scoreId): array
    {
        return $this->request('DELETE', '/scores/' . rawurlencode($scoreId));
    }

    /**
     * List sessions.
     *
     * @param  array<string, mixed>  $params  Session query filters and pagination.
     * @return array<string, mixed>
     */
    public function listSessions(array $params = []): array
    {
        return $this->request('GET', '/sessions', $params);
    }

    /**
     * Retrieve a session by ID.
     *
     * @return array<string, mixed>
     */
    public function getSession(string $sessionId): array
    {
        return $this->request('GET', '/sessions/' . rawurlencode($sessionId));
    }

    /**
     * List datasets.
     *
     * @param  array<string, mixed>  $params  Dataset query filters and pagination.
     * @return array<string, mixed>
     */
    public function listDatasets(array $params = []): array
    {
        return $this->request('GET', '/v2/datasets', $params);
    }

    /**
     * Create a dataset.
     *
     * @param  array<string, mixed>  $body  Dataset creation body.
     * @return array<string, mixed>
     */
    public function createDataset(array $body): array
    {
        return $this->request('POST', '/v2/datasets', $body);
    }

    /**
     * Retrieve a dataset by name.
     *
     * @return array<string, mixed>
     */
    public function getDataset(string $datasetName): array
    {
        return $this->request('GET', '/v2/datasets/' . rawurlencode($datasetName));
    }

    /**
     * Create a dataset item.
     *
     * @param  array<string, mixed>  $body  Dataset item creation body.
     * @return array<string, mixed>
     */
    public function createDatasetItem(array $body): array
    {
        return $this->request('POST', '/dataset-items', $body);
    }

    /**
     * List dataset items.
     *
     * @param  array<string, mixed>  $params  Dataset item query filters and pagination.
     * @return array<string, mixed>
     */
    public function listDatasetItems(array $params = []): array
    {
        return $this->request('GET', '/dataset-items', $params);
    }

    /**
     * Retrieve a dataset item by ID.
     *
     * @return array<string, mixed>
     */
    public function getDatasetItem(string $datasetItemId): array
    {
        return $this->request('GET', '/dataset-items/' . rawurlencode($datasetItemId));
    }

    /**
     * Delete a dataset item by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteDatasetItem(string $datasetItemId): array
    {
        return $this->request('DELETE', '/dataset-items/' . rawurlencode($datasetItemId));
    }

    /**
     * Create a dataset run item.
     *
     * @param  array<string, mixed>  $body  Dataset run item creation body.
     * @return array<string, mixed>
     */
    public function createDatasetRunItem(array $body): array
    {
        return $this->request('POST', '/dataset-run-items', $body);
    }

    /**
     * List dataset run items.
     *
     * @param  array<string, mixed>  $params  Dataset run item query filters and pagination.
     * @return array<string, mixed>
     */
    public function listDatasetRunItems(array $params = []): array
    {
        return $this->request('GET', '/dataset-run-items', $params);
    }

    /**
     * List prompts.
     *
     * @param  array<string, mixed>  $params  Prompt query filters and pagination.
     * @return array<string, mixed>
     */
    public function listPrompts(array $params = []): array
    {
        return $this->request('GET', '/v2/prompts', $params);
    }

    /**
     * Create a prompt version.
     *
     * @param  array<string, mixed>  $body  Prompt creation body.
     * @return array<string, mixed>
     */
    public function createPrompt(array $body): array
    {
        return $this->request('POST', '/v2/prompts', $body);
    }

    /**
     * Retrieve a prompt by name.
     *
     * @param  array<string, mixed>  $params  Prompt retrieval options.
     * @return array<string, mixed>
     */
    public function getPrompt(string $promptName, array $params = []): array
    {
        return $this->request('GET', '/v2/prompts/' . rawurlencode($promptName), $params);
    }

    /**
     * Delete a prompt by name.
     *
     * @return array<string, mixed>
     */
    public function deletePrompt(string $promptName): array
    {
        return $this->request('DELETE', '/v2/prompts/' . rawurlencode($promptName));
    }

    /**
     * Update a specific prompt version.
     *
     * @param  array<string, mixed>  $body  Prompt version update body.
     * @return array<string, mixed>
     */
    public function updatePromptVersion(string $promptName, string|int $version, array $body): array
    {
        return $this->request('PATCH', '/v2/prompts/' . rawurlencode($promptName) . '/versions/' . rawurlencode((string) $version), $body);
    }

    /**
     * Create a comment on a Langfuse object.
     *
     * @param  array<string, mixed>  $body  Comment creation body.
     * @return array<string, mixed>
     */
    public function createComment(array $body): array
    {
        return $this->request('POST', '/comments', $body);
    }

    /**
     * List comments.
     *
     * @param  array<string, mixed>  $params  Comment query filters and pagination.
     * @return array<string, mixed>
     */
    public function listComments(array $params = []): array
    {
        return $this->request('GET', '/comments', $params);
    }

    /**
     * Retrieve a comment by ID.
     *
     * @return array<string, mixed>
     */
    public function getComment(string $commentId): array
    {
        return $this->request('GET', '/comments/' . rawurlencode($commentId));
    }

    /**
     * Query Langfuse metrics.
     *
     * @param  array<string, mixed>  $body  Metrics request body.
     * @return array<string, mixed>
     */
    public function metrics(array $body): array
    {
        return $this->request('POST', '/v2/metrics', $body, timeout: 120);
    }

    /**
     * List model definitions.
     *
     * @param  array<string, mixed>  $params  Model query filters and pagination.
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params);
    }

    /**
     * Create a model definition.
     *
     * @param  array<string, mixed>  $body  Model definition body.
     * @return array<string, mixed>
     */
    public function createModel(array $body): array
    {
        return $this->request('POST', '/models', $body);
    }

    /**
     * Retrieve a model definition by ID.
     *
     * @return array<string, mixed>
     */
    public function getModel(string $modelId): array
    {
        return $this->request('GET', '/models/' . rawurlencode($modelId));
    }

    /**
     * Delete a model definition by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteModel(string $modelId): array
    {
        return $this->request('DELETE', '/models/' . rawurlencode($modelId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], int $timeout = 60): array
    {
        $response = $this->rawRequest($method, $path, $data, $timeout);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Langfuse API.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data = [], int $timeout = 60): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Langfuse public key and secret key are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->publicKey, $this->secretKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout($timeout);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message')
                    ?? $response->json('error.message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("Langfuse API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Langfuse API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Langfuse API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Langfuse API: {$e->getMessage()}");
        }
    }
}
