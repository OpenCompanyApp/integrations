<?php

namespace OpenCompany\Integrations\Confluence;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Confluence Cloud REST API.
 *
 * Provides methods for pages, spaces, comments, labels, search,
 * ancestors, and children operations.
 */
class ConfluenceService
{
    /**
     * @param  string  $apiToken  Confluence Personal Access Token or OAuth token
     * @param  string  $baseUrl   Confluence Cloud REST API base URL (e.g. https://mycompany.atlassian.com/wiki/rest/api)
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://your-domain.atlassian.com/wiki/rest/api',
    ) {}

    /**
     * Check whether the Confluence API token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /*-----------------------------------------------------------------------
     | Pages
     *---------------------------------------------------------------------*/

    /**
     * Create a new page in a Confluence space.
     *
     * @param  string  $spaceKey  The space key (e.g. "DEV")
     * @param  string  $title     The page title
     * @param  string  $body      The page body in Confluence storage format (HTML)
     * @param  string|null  $parentId  Optional parent page ID
     * @param  string  $type  Content type (default: "page")
     * @return array<string, mixed>
     */
    public function createPage(string $spaceKey, string $title, string $body, ?string $parentId = null, string $type = 'page'): array
    {
        $payload = [
            'type' => $type,
            'title' => $title,
            'space' => ['key' => $spaceKey],
            'body' => [
                'storage' => [
                    'value' => $body,
                    'representation' => 'storage',
                ],
            ],
        ];

        if ($parentId !== null) {
            $payload['ancestors'] = [['id' => $parentId]];
        }

        return $this->request('POST', '/content', $payload);
    }

    /**
     * Get details for a specific page by ID.
     *
     * @param  string  $pageId  The content ID
     * @param  string|null  $expand  Comma-separated list of properties to expand (e.g. "body.storage,version,space")
     * @return array<string, mixed>
     */
    public function getPage(string $pageId, ?string $expand = null): array
    {
        $params = [];
        if ($expand !== null) {
            $params['expand'] = $expand;
        }

        return $this->request('GET', "/content/{$pageId}", $params);
    }

    /**
     * Update an existing page.
     *
     * @param  string  $pageId   The content ID
     * @param  string  $title    The updated page title
     * @param  string  $body     The updated page body in Confluence storage format (HTML)
     * @param  int  $version     The new version number (must be current version + 1)
     * @param  string|null  $status  Optional status (e.g. "current", "draft")
     * @return array<string, mixed>
     */
    public function updatePage(string $pageId, string $title, string $body, int $version, ?string $status = null): array
    {
        $payload = [
            'version' => ['number' => $version],
            'title' => $title,
            'type' => 'page',
            'body' => [
                'storage' => [
                    'value' => $body,
                    'representation' => 'storage',
                ],
            ],
        ];

        if ($status !== null) {
            $payload['status'] = $status;
        }

        return $this->request('PUT', "/content/{$pageId}", $payload);
    }

    /**
     * Delete a page by ID.
     *
     * @param  string  $pageId  The content ID
     * @return array<string, mixed>
     */
    public function deletePage(string $pageId): array
    {
        return $this->request('DELETE', "/content/{$pageId}");
    }

    /*-----------------------------------------------------------------------
     | Search
     *---------------------------------------------------------------------*/

    /**
     * Search for content using CQL (Confluence Query Language).
     *
     * @param  string  $cql      CQL query string (e.g. 'title = "My Page"' or 'space = "DEV" and type = "page"')
     * @param  int|null  $limit   Maximum number of results to return
     * @param  int|null  $start   Start offset for pagination
     * @param  string|null  $expand  Comma-separated list of properties to expand
     * @return array<string, mixed>
     */
    public function searchPages(string $cql, ?int $limit = null, ?int $start = null, ?string $expand = null): array
    {
        $params = ['cql' => $cql];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($expand !== null) {
            $params['expand'] = $expand;
        }

        return $this->request('GET', '/content/search', $params);
    }

    /*-----------------------------------------------------------------------
     | Ancestors & Children
     *---------------------------------------------------------------------*/

    /**
     * Get the ancestor (parent) pages of a page.
     *
     * @param  string  $pageId  The content ID
     * @return array<string, mixed>
     */
    public function getPageAncestors(string $pageId): array
    {
        return $this->request('GET', "/content/{$pageId}/ancestors");
    }

    /**
     * Get the child pages of a page.
     *
     * @param  string  $pageId  The content ID
     * @param  int|null  $limit  Maximum number of results to return
     * @param  int|null  $start  Start offset for pagination
     * @param  string|null  $expand  Comma-separated list of properties to expand
     * @return array<string, mixed>
     */
    public function getPageChildren(string $pageId, ?int $limit = null, ?int $start = null, ?string $expand = null): array
    {
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($expand !== null) {
            $params['expand'] = $expand;
        }

        return $this->request('GET', "/content/{$pageId}/child/page", $params);
    }

    /*-----------------------------------------------------------------------
     | Comments
     *---------------------------------------------------------------------*/

    /**
     * Add a comment to a page.
     *
     * @param  string  $pageId  The content ID of the page to comment on
     * @param  string  $body    The comment body in Confluence storage format (HTML)
     * @return array<string, mixed>
     */
    public function addComment(string $pageId, string $body): array
    {
        return $this->request('POST', '/content', [
            'type' => 'comment',
            'container' => ['id' => $pageId, 'type' => 'page', 'status' => 'current'],
            'body' => [
                'storage' => [
                    'value' => $body,
                    'representation' => 'storage',
                ],
            ],
        ]);
    }

    /*-----------------------------------------------------------------------
     | Spaces
     *---------------------------------------------------------------------*/

    /**
     * List spaces accessible to the authenticated user.
     *
     * @param  int|null  $limit   Maximum number of results to return
     * @param  int|null  $start   Start offset for pagination
     * @param  string|null  $type   Space type filter (e.g. "global", "personal")
     * @param  string|null  $status Space status filter (e.g. "current", "archived")
     * @return array<string, mixed>
     */
    public function getSpaces(?int $limit = null, ?int $start = null, ?string $type = null, ?string $status = null): array
    {
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/space', $params);
    }

    /**
     * Get details for a specific space by key.
     *
     * @param  string  $spaceKey  The space key (e.g. "DEV")
     * @return array<string, mixed>
     */
    public function getSpace(string $spaceKey): array
    {
        return $this->request('GET', "/space/{$spaceKey}");
    }

    /*-----------------------------------------------------------------------
     | Labels
     *---------------------------------------------------------------------*/

    /**
     * Get labels for a page.
     *
     * @param  string  $pageId  The content ID
     * @return array<string, mixed>
     */
    public function getLabels(string $pageId): array
    {
        return $this->request('GET', "/content/{$pageId}/label");
    }

    /**
     * Add labels to a page.
     *
     * @param  string  $pageId  The content ID
     * @param  array<int, array<string, string>>  $labels  Array of label objects, e.g. [{"prefix": "global", "name": "label-name"}]
     * @return array<string, mixed>
     */
    public function addLabels(string $pageId, array $labels): array
    {
        return $this->request('POST', "/content/{$pageId}/label", $labels);
    }

    /*-----------------------------------------------------------------------
     | Connection Test
     *---------------------------------------------------------------------*/

    /**
     * Test the API connection by fetching the current user profile.
     *
     * Returns the user's display name on success.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/user/current');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to the Confluence Cloud REST API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API endpoint path (e.g. "/content", "/space/DEV")
     * @param  array<string, mixed>|list<mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Confluence API token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = rtrim($this->baseUrl, '/') . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Confluence API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Confluence API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Confluence API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Confluence API: {$e->getMessage()}");
        }
    }
}
