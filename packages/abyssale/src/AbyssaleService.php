<?php

namespace OpenCompany\Integrations\Abyssale;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Abyssale REST API.
 *
 * Handles x-api-key authentication, request dispatch, and error normalization
 * for designs, generation, files, projects, exports, and dynamic images.
 */
class AbyssaleService
{
    /**
     * @param  string  $apiKey  Abyssale API key.
     * @param  string  $baseUrl  Abyssale API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.abyssale.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    // -- Designs -----------------------------------------------------------

    /**
     * List designs available in the workspace.
     *
     * @return array<string, mixed>
     */
    public function listDesigns(): array
    {
        return $this->request('GET', '/designs');
    }

    /**
     * Retrieve details for a design.
     *
     * @param  string  $designId  Design UUID.
     * @return array<string, mixed>
     */
    public function getDesign(string $designId): array
    {
        return $this->request('GET', '/designs/'.$this->encode($designId));
    }

    /**
     * Retrieve details for a specific design format.
     *
     * @param  string  $designId  Design UUID.
     * @param  string  $formatSpecifier  Format ID or name.
     * @return array<string, mixed>
     */
    public function getDesignFormat(string $designId, string $formatSpecifier): array
    {
        return $this->request('GET', '/designs/'.$this->encode($designId).'/formats/'.$this->encode($formatSpecifier));
    }

    /**
     * Create or retrieve a dynamic image URL for a design.
     *
     * @param  string  $designId  Design UUID.
     * @param  array<string, mixed>  $payload  Dynamic image options.
     * @return array<string, mixed>
     */
    public function createDynamicImageUrl(string $designId, array $payload = []): array
    {
        return $this->request('POST', '/designs/'.$this->encode($designId).'/dynamic-image-url', $payload);
    }

    // -- Generation --------------------------------------------------------

    /**
     * Generate a single synchronous image from a static design.
     *
     * @param  string  $designId  Design UUID.
     * @param  array<string, mixed>  $elements  Element override dictionary.
     * @param  string|null  $templateFormatName  Optional format name when a design has multiple formats.
     * @return array<string, mixed>
     */
    public function generateImage(string $designId, array $elements, ?string $templateFormatName = null): array
    {
        $payload = ['elements' => $elements];

        if ($templateFormatName !== null && $templateFormatName !== '') {
            $payload['template_format_name'] = $templateFormatName;
        }

        return $this->request('POST', '/banner-builder/'.$this->encode($designId).'/generate', $payload);
    }

    /**
     * Generate images, videos, PDFs, GIFs, or HTML5 files asynchronously.
     *
     * @param  string  $designId  Design UUID.
     * @param  array<string, mixed>  $payload  Async generation payload.
     * @return array<string, mixed>
     */
    public function generateMultiFormatMedia(string $designId, array $payload): array
    {
        return $this->request('POST', '/async/banner-builder/'.$this->encode($designId).'/generate', $payload);
    }

    /**
     * Generate a multi-page PDF asynchronously.
     *
     * @param  string  $designId  Design UUID.
     * @param  array<string, mixed>  $pages  Page override dictionary.
     * @param  string|null  $callbackUrl  Optional callback URL.
     * @return array<string, mixed>
     */
    public function generateMultiPagePdf(string $designId, array $pages, ?string $callbackUrl = null): array
    {
        $payload = ['pages' => $pages];

        if ($callbackUrl !== null && $callbackUrl !== '') {
            $payload['callback_url'] = $callbackUrl;
        }

        return $this->request('POST', '/async/banner-builder/'.$this->encode($designId).'/generate', $payload);
    }

    // -- Fonts, files, exports --------------------------------------------

    /**
     * Retrieve all custom and Google fonts available to the workspace.
     *
     * @return array<string, mixed>
     */
    public function listFonts(): array
    {
        return $this->request('GET', '/fonts');
    }

    /**
     * Retrieve a generated file by banner ID.
     *
     * @param  string  $bannerId  Generated banner/file UUID.
     * @return array<string, mixed>
     */
    public function getFile(string $bannerId): array
    {
        return $this->request('GET', '/banners/'.$this->encode($bannerId));
    }

    /**
     * Create an asynchronous ZIP export for generated banners.
     *
     * @param  array<int, string>  $ids  Banner IDs to export.
     * @param  string|null  $callbackUrl  Optional callback URL.
     * @return array<string, mixed>
     */
    public function createBannerExport(array $ids, ?string $callbackUrl = null): array
    {
        $payload = ['ids' => $ids];

        if ($callbackUrl !== null && $callbackUrl !== '') {
            $payload['callback_url'] = $callbackUrl;
        }

        return $this->request('POST', '/async/banners/export', $payload);
    }

    // -- Projects and workspace templates ---------------------------------

    /**
     * List projects in the workspace.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Create a project.
     *
     * @param  string  $name  Project name.
     * @return array<string, mixed>
     */
    public function createProject(string $name): array
    {
        return $this->request('POST', '/projects', ['name' => $name]);
    }

    /**
     * Duplicate a workspace template into a project.
     *
     * @param  string  $companyTemplateId  Workspace template UUID.
     * @param  string  $projectId  Target project UUID.
     * @param  string|null  $name  Optional name for the duplicated design.
     * @return array<string, mixed>
     */
    public function duplicateWorkspaceTemplate(string $companyTemplateId, string $projectId, ?string $name = null): array
    {
        $payload = ['project_id' => $projectId];

        if ($name !== null && $name !== '') {
            $payload['name'] = $name;
        }

        return $this->request('POST', '/workspace-templates/'.$this->encode($companyTemplateId).'/use', $payload);
    }

    /**
     * Retrieve the status of a workspace-template duplication request.
     *
     * @param  string  $duplicateRequestId  Duplication request UUID.
     * @return array<string, mixed>
     */
    public function getDuplicationRequest(string $duplicateRequestId): array
    {
        return $this->request('GET', '/design-duplication-requests/'.$this->encode($duplicateRequestId));
    }

    // -- Generic API escape hatch -----------------------------------------

    /**
     * Send a GET request to a documented Abyssale API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a documented Abyssale API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Abyssale API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Abyssale API key is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Abyssale API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Abyssale API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Abyssale API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Abyssale API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a caller-supplied path into an API-relative path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }

    /**
     * Encode a path segment without treating slashes as path separators.
     */
    private function encode(string $value): string
    {
        return rawurlencode($value);
    }
}
