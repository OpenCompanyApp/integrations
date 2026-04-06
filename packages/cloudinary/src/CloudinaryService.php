<?php

namespace OpenCompany\Integrations\Cloudinary;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    /**
     * Create a new CloudinaryService instance.
     *
     * @param  string  $accessToken  OAuth access token for the Cloudinary API.
     * @param  string  $cloudName    Cloud name (subdomain in API URLs).
     * @param  string  $baseUrl      Base URL for the Cloudinary Admin API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $cloudName = '',
        private string $baseUrl = 'https://api.cloudinary.com/v1_1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->cloudName);
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
    public function upload(string $file, ?string $publicId = null, ?string $folder = null): array
    {
        $data = ['file' => $file];

        if ($publicId !== null) {
            $data['public_id'] = $publicId;
        }
        if ($folder !== null) {
            $data['folder'] = $folder;
        }

        return $this->request('POST', '/resources/image/upload', $data);
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
    public function listResources(string $type = 'image', ?int $maxResults = null, ?string $nextCursor = null, ?string $prefix = null): array
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

        return $this->request('GET', '/resources/' . urlencode($type), $params);
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
    public function getResource(string $type, string $publicId): array
    {
        return $this->request('GET', '/resources/' . urlencode($type) . '/' . urlencode($publicId));
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
    public function deleteResource(string $type, string $publicId): array
    {
        return $this->request('DELETE', '/resources/' . urlencode($type) . '/' . urlencode($publicId));
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
     * Get the currently authenticated Cloudinary user.
     *
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
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
        if (!$this->accessToken || !$this->cloudName) {
            throw new \RuntimeException('Cloudinary access token and cloud name are required.');
        }

        $url = $this->baseUrl . '/' . $this->cloudName . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
}
