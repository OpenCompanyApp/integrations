<?php

namespace OpenCompany\Integrations\HuggingFace;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Hugging Face Hub and HF Inference APIs.
 *
 * Handles Hub metadata requests, repository utilities, serverless inference,
 * generic relative-path calls, and authenticated response parsing.
 */
class HuggingFaceService
{
    /**
     * @param  string  $accessToken  Hugging Face user access token.
     * @param  string  $baseUrl  Hugging Face Hub API base URL.
     * @param  string  $inferenceUrl  HF Inference model router base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://huggingface.co/api',
        private string $inferenceUrl = 'https://router.huggingface.co/hf-inference/models',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->inferenceUrl = rtrim($this->inferenceUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List models from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params);
    }

    /**
     * Get detailed information about a specific model.
     *
     * @param  string  $modelId  The model ID (e.g. "meta-llama/Llama-3.3-70B-Instruct")
     * @return array<string, mixed>
     */
    public function getModel(string $modelId): array
    {
        return $this->request('GET', '/models/' . $this->encodeRepoId($modelId));
    }

    /**
     * List datasets from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listDatasets(array $params = []): array
    {
        return $this->request('GET', '/datasets', $params);
    }

    /**
     * Get detailed information about a dataset.
     *
     * @param  string  $datasetId  Dataset ID (for example "mozilla-foundation/common_voice_17_0").
     * @return array<string, mixed>
     */
    public function getDataset(string $datasetId): array
    {
        return $this->request('GET', '/datasets/' . $this->encodeRepoId($datasetId));
    }

    /**
     * Run inference against a model using the Inference API.
     *
     * @param  string  $modelId  The model ID (e.g. "meta-llama/Llama-3.3-70B-Instruct")
     * @param  array<string, mixed>  $payload  The inference request body
     * @return array<string, mixed>
     */
    public function inference(string $modelId, array $payload): array
    {
        return $this->rawJsonRequest('POST', $this->inferenceUrl . '/' . $this->encodeRepoId($modelId), $payload);
    }

    /**
     * List Spaces from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listSpaces(array $params = []): array
    {
        return $this->request('GET', '/spaces', $params);
    }

    /**
     * Get detailed information about a Space.
     *
     * @param  string  $spaceId  Space ID (for example "org/space-name").
     * @return array<string, mixed>
     */
    public function getSpace(string $spaceId): array
    {
        return $this->request('GET', '/spaces/' . $this->encodeRepoId($spaceId));
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/whoami-v2');
    }

    /**
     * List commits for a model, dataset, or Space repository.
     *
     * @param  string  $repoType  Repository type: models, datasets, or spaces.
     * @param  string  $repoId  Repository ID.
     * @param  string  $revision  Revision name.
     * @return array<string, mixed>
     */
    public function listCommits(string $repoType, string $repoId, string $revision = 'main'): array
    {
        return $this->request('GET', '/' . $this->normalizeRepoType($repoType) . '/' . $this->encodeRepoId($repoId) . '/commits/' . rawurlencode($revision));
    }

    /**
     * List Git references for a repository.
     *
     * @param  string  $repoType  Repository type: models, datasets, or spaces.
     * @param  string  $repoId  Repository ID.
     * @return array<string, mixed>
     */
    public function listRefs(string $repoType, string $repoId): array
    {
        return $this->request('GET', '/' . $this->normalizeRepoType($repoType) . '/' . $this->encodeRepoId($repoId) . '/refs');
    }

    /**
     * List repository tree contents.
     *
     * @param  string  $repoType  Repository type: models, datasets, or spaces.
     * @param  string  $repoId  Repository ID.
     * @param  string  $revision  Revision name.
     * @param  string  $path  Folder path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTree(string $repoType, string $repoId, string $revision = 'main', string $path = '', array $params = []): array
    {
        $path = trim($path, '/');

        return $this->request('GET', '/' . $this->normalizeRepoType($repoType) . '/' . $this->encodeRepoId($repoId) . '/tree/' . rawurlencode($revision) . ($path !== '' ? '/' . $this->encodePath($path) : ''), $params);
    }

    /**
     * Get repository security scan status.
     *
     * @param  string  $repoType  Repository type: models, datasets, or spaces.
     * @param  string  $repoId  Repository ID.
     * @return array<string, mixed>
     */
    public function getScanStatus(string $repoType, string $repoId): array
    {
        return $this->request('GET', '/' . $this->normalizeRepoType($repoType) . '/' . $this->encodeRepoId($repoId) . '/scan');
    }

    /**
     * List Hugging Face model tags grouped by type.
     *
     * @return array<string, mixed>
     */
    public function listModelTags(): array
    {
        return $this->request('GET', '/models-tags-by-type');
    }

    /**
     * List Hugging Face dataset tags grouped by type.
     *
     * @return array<string, mixed>
     */
    public function listDatasetTags(): array
    {
        return $this->request('GET', '/datasets-tags-by-type');
    }

    /**
     * List available Space hardware options.
     *
     * @return array<string, mixed>
     */
    public function listSpaceHardware(): array
    {
        return $this->request('GET', '/spaces/hardware');
    }

    /**
     * Create a model, dataset, or Space repository.
     *
     * @param  array<string, mixed>  $payload  Repository creation payload.
     * @return array<string, mixed>
     */
    public function createRepo(array $payload): array
    {
        return $this->request('POST', '/repos/create', $payload);
    }

    /**
     * Send a GET request to a relative Hugging Face Hub API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Hugging Face Hub API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Hugging Face Hub API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Hugging Face Hub API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (e.g. "/models")
     * @param  array<string, mixed>  $data  Query parameters or request body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        return $this->rawJsonRequest($method, $this->baseUrl . $path, $data);
    }

    /**
     * Make a raw HTTP request to the Hugging Face API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $url  Absolute request URL
     * @param  array<string, mixed>  $data  Query parameters (GET) or request body (POST)
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    private function rawJsonRequest(string $method, string $url, array $data = []): array
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Hugging Face access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(60);

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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Hugging Face API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hugging Face API endpoint not available (HTTP {$response->status()}). The endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Hugging Face API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hugging Face API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hugging Face API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hugging Face API: {$e->getMessage()}");
        }
    }

    /**
     * Preserve repo slashes while URL-encoding each path segment.
     */
    private function encodeRepoId(string $repoId): string
    {
        return implode('/', array_map('rawurlencode', explode('/', trim($repoId, '/'))));
    }

    /**
     * Encode a nested repository path.
     */
    private function encodePath(string $path): string
    {
        return implode('/', array_map('rawurlencode', explode('/', trim($path, '/'))));
    }

    /**
     * Normalize singular or plural repository type values.
     */
    private function normalizeRepoType(string $repoType): string
    {
        return match ($repoType) {
            'model', 'models' => 'models',
            'dataset', 'datasets' => 'datasets',
            'space', 'spaces' => 'spaces',
            default => throw new RuntimeException('repo_type must be models, datasets, or spaces.'),
        };
    }

    /**
     * Normalize and validate a caller-supplied Hub API path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Hugging Face API path must be a relative path such as /models.');
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }
}
