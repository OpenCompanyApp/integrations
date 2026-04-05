<?php

namespace OpenCompany\Integrations\Figma;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Figma REST API (v1).
 *
 * Wraps HTTP calls to Figma's REST endpoints for files, images,
 * comments, projects, components, styles, and user info.
 *
 * Authentication uses a Personal Access Token via the X-Figma-Token header.
 */
class FigmaService
{
    private const BASE_URL = 'https://api.figma.com/v1';

    /**
     * @param  string  $apiToken  Figma Personal Access Token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Auth ────────────────────────────────────────────────

    /**
     * Get the authenticated user's profile (GET /me).
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Files ────────────────────────────────────────────────

    /**
     * Get a Figma file by key (GET /files/{key}).
     *
     * @param  string  $fileKey  The file key to retrieve
     * @param  array<string, mixed>  $params  Query parameters (ids, depth, geometry, plugin_data)
     * @return array<string, mixed>
     */
    public function getFile(string $fileKey, array $params = []): array
    {
        return $this->request('GET', "/files/{$fileKey}", $params);
    }

    /**
     * Get specific nodes from a file (GET /files/{key}/nodes).
     *
     * @param  string  $fileKey  The file key
     * @param  array<string, mixed>  $params  Query parameters (ids, depth, geometry)
     * @return array<string, mixed>
     */
    public function getFileNodes(string $fileKey, array $params = []): array
    {
        return $this->request('GET', "/files/{$fileKey}/nodes", $params);
    }

    // ── Images ────────────────────────────────────────────────

    /**
     * Export images from a file (GET /images/{key}).
     *
     * @param  string  $fileKey  The file key
     * @param  array<string, mixed>  $params  Query parameters (ids, format, scale, svg_include_id_token)
     * @return array<string, mixed>
     */
    public function getFileImages(string $fileKey, array $params = []): array
    {
        return $this->request('GET', "/images/{$fileKey}", $params);
    }

    /**
     * Get image fill metadata for a file (GET /files/{key}/images).
     *
     * @param  string  $fileKey  The file key
     * @return array<string, mixed>
     */
    public function getImageFills(string $fileKey): array
    {
        return $this->request('GET', "/files/{$fileKey}/images");
    }

    // ── Comments ──────────────────────────────────────────────

    /**
     * List comments on a file (GET /files/{key}/comments).
     *
     * @param  string  $fileKey  The file key
     * @return array<string, mixed>
     */
    public function getComments(string $fileKey): array
    {
        return $this->request('GET', "/files/{$fileKey}/comments");
    }

    /**
     * Post a comment on a file (POST /files/{key}/comments).
     *
     * @param  string  $fileKey  The file key
     * @param  array<string, mixed>  $data  Comment payload (message, client_meta, comment_id)
     * @return array<string, mixed>
     */
    public function postComment(string $fileKey, array $data): array
    {
        return $this->request('POST', "/files/{$fileKey}/comments", $data);
    }

    /**
     * Delete a comment from a file (DELETE /files/{key}/comments/{commentId}).
     *
     * @param  string  $fileKey    The file key
     * @param  string  $commentId  The comment ID to delete
     * @return array<string, mixed>
     */
    public function deleteComment(string $fileKey, string $commentId): array
    {
        return $this->request('DELETE', "/files/{$fileKey}/comments/{$commentId}");
    }

    // ── Teams & Projects ──────────────────────────────────────

    /**
     * List projects in a team (GET /teams/{teamId}/projects).
     *
     * @param  string  $teamId  The team ID
     * @return array<string, mixed>
     */
    public function getTeamProjects(string $teamId): array
    {
        return $this->request('GET', "/teams/{$teamId}/projects");
    }

    /**
     * List files in a project (GET /projects/{projectId}/files).
     *
     * @param  string  $projectId  The project ID
     * @param  array<string, mixed>  $params  Query parameters (branch_data)
     * @return array<string, mixed>
     */
    public function getProjectFiles(string $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/files", $params);
    }

    // ── Styles & Components ────────────────────────────────────

    /**
     * List styles in a file (GET /files/{key}/styles).
     *
     * @param  string  $fileKey  The file key
     * @return array<string, mixed>
     */
    public function getStyles(string $fileKey): array
    {
        return $this->request('GET', "/files/{$fileKey}/styles");
    }

    /**
     * List components in a file (GET /files/{key}/components).
     *
     * @param  string  $fileKey  The file key
     * @return array<string, mixed>
     */
    public function getComponents(string $fileKey): array
    {
        return $this->request('GET', "/files/{$fileKey}/components");
    }

    /**
     * Get a component by key (GET /components/{key}).
     *
     * @param  string  $componentKey  The component key
     * @return array<string, mixed>
     */
    public function getComponent(string $componentKey): array
    {
        return $this->request('GET', "/components/{$componentKey}");
    }

    /**
     * Get a style by key (GET /styles/{key}).
     *
     * @param  string  $styleKey  The style key
     * @return array<string, mixed>
     */
    public function getStyle(string $styleKey): array
    {
        return $this->request('GET', "/styles/{$styleKey}");
    }

    /**
     * List published components in a team (GET /teams/{teamId}/components).
     *
     * @param  string  $teamId  The team ID
     * @param  array<string, mixed>  $params  Query parameters (max_depth)
     * @return array<string, mixed>
     */
    public function listTeamComponents(string $teamId, array $params = []): array
    {
        return $this->request('GET', "/teams/{$teamId}/components", $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Figma.
     *
     * @param  string  $method  HTTP method (GET, POST, DELETE)
     * @param  string  $path    API path (e.g. /files/abc123)
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Figma API token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'X-Figma-Token' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $status = $response->status();
                $body = $response->body();

                Log::error("Figma API error: {$method} {$path}", [
                    'status' => $status,
                    'body'   => $body,
                ]);

                throw new \RuntimeException("Figma API error ({$status}): {$body}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Figma API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Figma API: {$e->getMessage()}");
        }
    }
}
