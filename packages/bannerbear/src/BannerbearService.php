<?php

namespace OpenCompany\Integrations\Bannerbear;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BannerbearService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.bannerbear.com/v2',
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
     * Create a new image from a template.
     *
     * @param  string  $templateId  The template UID to use.
     * @param  array<int, array{name: string, text?: string, image_url?: string, color?: string, barcode?: string}>  $modifications  List of modification objects.
     * @param  array  $options  Additional options (e.g., width, height, transparent, metadata).
     * @return array The created image resource.
     */
    public function createImage(string $templateId, array $modifications, array $options = []): array
    {
        $payload = array_merge([
            'template' => $templateId,
            'modifications' => $modifications,
        ], $options);

        return $this->request('POST', '/images', $payload);
    }

    /**
     * List images in the account.
     *
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array List of image resources.
     */
    public function listImages(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/images', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get an image by its ID.
     *
     * @param  string  $imageId  The image UID.
     * @return array The image resource.
     */
    public function getImage(string $imageId): array
    {
        return $this->request('GET', '/images/' . urlencode($imageId));
    }

    /**
     * Create a new video from a template.
     *
     * @param  string  $templateId  The template UID to use.
     * @param  array  $modifications  List of modification objects per scene.
     * @param  array  $options  Additional options (e.g., fps, trim, metadata).
     * @return array The created video resource.
     */
    public function createVideo(string $templateId, array $modifications, array $options = []): array
    {
        $payload = array_merge([
            'template' => $templateId,
            'modifications' => $modifications,
        ], $options);

        return $this->request('POST', '/videos', $payload);
    }

    /**
     * Get a video by its ID.
     *
     * @param  string  $videoId  The video UID.
     * @return array The video resource.
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/videos/' . urlencode($videoId));
    }

    /**
     * List all templates in the account.
     *
     * @return array List of template resources.
     */
    public function listTemplates(): array
    {
        return $this->request('GET', '/templates');
    }

    /**
     * Get a single template by its ID.
     *
     * @param  string  $templateId  The template UID.
     * @return array The template resource.
     */
    public function getTemplate(string $templateId): array
    {
        return $this->request('GET', '/templates/' . urlencode($templateId));
    }

    /**
     * Create an animated GIF from a template.
     *
     * @param  string  $templateId  The template UID to use.
     * @param  array  $modifications  List of modification objects per frame.
     * @param  array  $options  Additional options (e.g., fps, duration, metadata).
     * @return array The created animated GIF resource.
     */
    public function createAnimatedGif(string $templateId, array $modifications, array $options = []): array
    {
        $payload = array_merge([
            'template' => $templateId,
            'modifications' => $modifications,
        ], $options);

        return $this->request('POST', '/animated_gifs', $payload);
    }

    /**
     * List collections in the account.
     *
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array List of collection resources.
     */
    public function listCollections(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/collections', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the current authenticated user's account info.
     *
     * @return array The account resource.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /images).
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return array<string, mixed> Parsed JSON response.
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
     * Make a raw HTTP request to the Bannerbear API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /images).
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Bannerbear API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Bannerbear API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Bannerbear API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Bannerbear API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Bannerbear API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bannerbear API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bannerbear API: {$e->getMessage()}");
        }
    }
}
