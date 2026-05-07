<?php

namespace OpenCompany\Integrations\Cloudinary;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Cloudinary Upload and Admin APIs.
 *
 * Routes signed upload calls and authenticated Admin API requests for assets,
 * folders, tags, transformations, upload presets, search, and usage data.
 */
class CloudinaryService
{
    /**
     * Create a new CloudinaryService instance.
     *
     * @param  string  $accessToken  Backward-compatible OAuth access token for the Cloudinary API.
     * @param  string  $cloudName    Cloud name (subdomain in API URLs).
     * @param  string  $baseUrl      Base URL for the Cloudinary Admin API.
     * @param  string  $apiKey       Cloudinary API key for Basic Auth and signed uploads.
     * @param  string  $apiSecret    Cloudinary API secret for Basic Auth and signed uploads.
     */
    public function __construct(
        private string $accessToken = '',
        private string $cloudName = '',
        private string $baseUrl = 'https://api.cloudinary.com/v1_1',
        private string $apiKey = '',
        private string $apiSecret = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->cloudName) && ((! empty($this->apiKey) && ! empty($this->apiSecret)) || ! empty($this->accessToken));
    }

    /**
     * Return the configured cloud name.
     */
    public function getCloudName(): string
    {
        return $this->cloudName;
    }

    /**
     * Upload an image to Cloudinary.
     *
     * Uses the Admin API with OAuth Bearer authentication.
     *
     * @param  string  $file      URL or base64 data URI of the file to upload.
     * @param  string|null  $publicId  The public ID to assign to the uploaded asset.
     * @param  string|null  $folder    The folder where the asset will be stored.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function upload(string $file, ?string $publicId = null, ?string $folder = null, string $resourceType = 'image', array $options = []): array
    {
        $data = array_merge($options, ['file' => $file]);

        if ($publicId !== null) {
            $data['public_id'] = $publicId;
        }
        if ($folder !== null) {
            $data['folder'] = $folder;
        }

        return $this->uploadRequest('POST', '/' . $this->segment($resourceType) . '/upload', $data);
    }

    /**
     * List resources of a given type.
     *
     * @param  string  $type        Resource type (e.g. "image", "video", "raw").
     * @param  int|null  $maxResults  Maximum number of resources to return (max 500).
     * @param  string|null  $nextCursor Pagination cursor from a previous response.
     * @param  string|null  $prefix     Only resources whose public ID starts with this prefix.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function listResources(string $type = 'image', ?int $maxResults = null, ?string $nextCursor = null, ?string $prefix = null, string $deliveryType = 'upload'): array
    {
        $params = [];
        if ($maxResults !== null) {
            $params['max_results'] = $maxResults;
        }
        if ($nextCursor !== null) {
            $params['next_cursor'] = $nextCursor;
        }
        if ($prefix !== null) {
            $params['prefix'] = $prefix;
        }

        return $this->request('GET', '/resources/' . $this->segment($type) . '/' . $this->segment($deliveryType), $params);
    }

    /**
     * Get details of a single resource.
     *
     * @param  string  $type      Resource type (e.g. "image", "video", "raw").
     * @param  string  $publicId  The public ID of the resource.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function getResource(string $type, string $publicId, string $deliveryType = 'upload'): array
    {
        return $this->request('GET', '/resources/' . $this->segment($type) . '/' . $this->segment($deliveryType) . '/' . $this->segment($publicId));
    }

    /**
     * Delete a single resource.
     *
     * @param  string  $type      Resource type (e.g. "image", "video", "raw").
     * @param  string  $publicId  The public ID of the resource.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function deleteResource(string $type, string $publicId, string $deliveryType = 'upload', array $options = []): array
    {
        return $this->request('DELETE', '/resources/' . $this->segment($type) . '/' . $this->segment($deliveryType), array_merge($options, [
            'public_ids' => [$publicId],
        ]));
    }

    /**
     * List all folders in the cloud.
     *
     * @param  string|null  $nextCursor Pagination cursor from a previous response.
     * @param  int|null  $maxResults  Maximum number of folders to return.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function listFolders(?string $nextCursor = null, ?int $maxResults = null): array
    {
        $params = [];
        if ($nextCursor !== null) {
            $params['next_cursor'] = $nextCursor;
        }
        if ($maxResults !== null) {
            $params['max_results'] = $maxResults;
        }

        return $this->request('GET', '/folders', $params);
    }

    /**
     * List subfolders of a parent folder.
     *
     * @param  array<string, mixed>  $params  Optional max_results and next_cursor.
     *
     * @return array<string, mixed>
     */
    public function listSubfolders(string $folder, array $params = []): array
    {
        return $this->request('GET', '/folders/' . $this->segment($folder), $params);
    }

    /**
     * Search folders by expression.
     *
     * @param  array<string, mixed>  $params  Optional expression, sort_by, max_results, next_cursor.
     * @return array<string, mixed>
     */
    public function searchFolders(array $params = []): array
    {
        return $this->request('GET', '/folders/search', $params);
    }

    /**
     * Create a new Cloudinary asset folder.
     *
     * @return array<string, mixed>
     */
    public function createFolder(string $folder): array
    {
        return $this->request('POST', '/folders/' . $this->segment($folder));
    }

    /**
     * Delete an empty Cloudinary asset folder.
     *
     * @param  array<string, mixed>  $params  Optional skip_backup.
     * @return array<string, mixed>
     */
    public function deleteFolder(string $folder, array $params = []): array
    {
        return $this->request('DELETE', '/folders/' . $this->segment($folder), $params);
    }

    /**
     * Search assets using the Admin API search expression language.
     *
     * @param  array<string, mixed>  $params  Query parameters such as expression, sort_by, max_results, next_cursor.
     * @return array<string, mixed>
     */
    public function searchResources(array $params = []): array
    {
        return $this->request('GET', '/resources/search', $params);
    }

    /**
     * List assets with a specified tag.
     *
     * @param  array<string, mixed>  $params  Optional max_results, next_cursor, direction.
     * @return array<string, mixed>
     */
    public function listResourcesByTag(string $tag, string $resourceType = 'image', array $params = []): array
    {
        return $this->request('GET', '/resources/' . $this->segment($resourceType) . '/tags/' . $this->segment($tag), $params);
    }

    /**
     * List tags used for a resource type.
     *
     * @param  array<string, mixed>  $params  Optional prefix, max_results, next_cursor.
     * @return array<string, mixed>
     */
    public function listTags(string $resourceType = 'image', array $params = []): array
    {
        return $this->request('GET', '/tags/' . $this->segment($resourceType), $params);
    }

    /**
     * List named transformations.
     *
     * @param  array<string, mixed>  $params  Optional max_results and next_cursor.
     * @return array<string, mixed>
     */
    public function listTransformations(array $params = []): array
    {
        return $this->request('GET', '/transformations', $params);
    }

    /**
     * List upload presets.
     *
     * @param  array<string, mixed>  $params  Optional max_results and next_cursor.
     * @return array<string, mixed>
     */
    public function listUploadPresets(array $params = []): array
    {
        return $this->request('GET', '/upload_presets', $params);
    }

    /**
     * Get product environment usage details.
     *
     * @param  array<string, mixed>  $params  Optional date in yyyy-mm-dd.
     * @return array<string, mixed>
     */
    public function getUsage(array $params = []): array
    {
        return $this->request('GET', '/usage', $params);
    }

    /**
     * Ping Cloudinary servers.
     *
     * @return array<string, mixed>
     */
    public function ping(): array
    {
        return $this->request('GET', '/ping');
    }

    /**
     * Call any Cloudinary Admin API GET endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        $path = '/' . ltrim($path, '/');

        if (str_starts_with($path, '//') || str_contains($path, '://')) {
            throw new \RuntimeException('path must be a Cloudinary Admin API path such as /resources/search.');
        }

        return $this->request('GET', $path, $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL (without cloud name prefix — already included).
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Cloudinary Admin API.
     *
     * The base URL already contains the version + cloud name segment
     * (e.g. "https://api.cloudinary.com/v1_1/{cloud_name}").
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path (e.g. "/resources/image").
     * @param  array<string, mixed>  $data  Parameters to send.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Cloudinary cloud name and API credentials are required.');
        }

        $url = $this->baseUrl . '/' . $this->cloudName . $path;

        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            if ($this->apiKey !== '' && $this->apiSecret !== '') {
                $headers['Authorization'] = 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret);
            } else {
                $headers['Authorization'] = 'Bearer ' . $this->accessToken;
            }

            $http = Http::withHeaders($headers)->timeout(30);

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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Cloudinary API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Cloudinary API endpoint not available (HTTP {$response->status()}). Check your cloud name and access token.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Cloudinary API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Cloudinary API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Cloudinary API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Cloudinary API: {$e->getMessage()}");
        }
    }

    /**
     * Make a signed Upload API request.
     *
     * @param  array<string, mixed>  $data  Upload parameters.
     * @return array<string, mixed>
     */
    private function uploadRequest(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Cloudinary cloud name and API credentials are required.');
        }

        if ($this->apiKey !== '' && $this->apiSecret !== '') {
            $data['api_key'] = $this->apiKey;
            $data['timestamp'] = $data['timestamp'] ?? time();
            $data['signature'] = $this->signature($data);
        }

        $url = $this->baseUrl . '/' . $this->cloudName . $path;

        $headers = ['Accept' => 'application/json'];
        if ($this->accessToken !== '' && ($this->apiKey === '' || $this->apiSecret === '')) {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $response = Http::withHeaders($headers)
            ->asForm()
            ->timeout(60)
            ->send(strtoupper($method), $url, ['form_params' => array_filter($data, static fn ($value) => $value !== null && $value !== '')]);

        if (! $response->successful()) {
            $error = $response->json('error') ?? $response->json('message') ?? $response->body();
            throw new \RuntimeException("Cloudinary API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
        }

        return $response->json() ?? [];
    }

    /**
     * Create a Cloudinary Upload API SHA-1 signature.
     *
     * @param  array<string, mixed>  $params  Upload parameters.
     */
    private function signature(array $params): string
    {
        unset($params['file'], $params['resource_type'], $params['api_key'], $params['signature']);

        $params = array_filter($params, static fn ($value) => $value !== null && $value !== '' && $value !== []);
        ksort($params);

        $parts = [];
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            } elseif (is_array($value)) {
                $value = implode(',', $value);
            }
            $parts[] = $key . '=' . $value;
        }

        return sha1(implode('&', $parts) . $this->apiSecret);
    }

    /**
     * Encode a single URL path segment while preserving folder slashes.
     */
    private function segment(string $value): string
    {
        return str_replace('%2F', '/', rawurlencode($value));
    }
}
