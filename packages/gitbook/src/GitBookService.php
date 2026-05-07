<?php

namespace OpenCompany\Integrations\GitBook;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the GitBook API.
 *
 * Handles Bearer-token authentication, endpoint routing, required parameter
 * validation, and API error normalization for GitBook tools.
 */
class GitBookService
{
    /**
     * @param  string  $token  GitBook personal access token or integration token.
     * @param  string  $baseUrl  GitBook API base URL.
     */
    public function __construct(private string $token = '', private string $baseUrl = 'https://api.gitbook.com/v1')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->token) !== '';
    }

    /**
     * List organizations available to the token.
     *
     * @param  array<string, mixed>  $params  Pagination options.
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->get('orgs', $params);
    }

    /**
     * Get one organization.
     *
     * @param  array<string, mixed>  $params  Organization ID.
     * @return array<string, mixed>
     */
    public function getOrganization(array $params): array
    {
        return $this->get('orgs/'.$this->id($params, 'organization_id'));
    }

    /**
     * Search across an organization.
     *
     * @param  array<string, mixed>  $params  Organization ID, query, and pagination options.
     * @return array<string, mixed>
     */
    public function searchOrganization(array $params): array
    {
        $organizationId = $this->id($params, 'organization_id');
        unset($params['organization_id']);
        $this->require($params, ['query'], 'organization search');

        return $this->get('orgs/'.$organizationId.'/search', $params);
    }

    /**
     * List spaces in an organization.
     *
     * @param  array<string, mixed>  $params  Organization ID plus pagination/filter options.
     * @return array<string, mixed>
     */
    public function listSpaces(array $params): array
    {
        $organizationId = $this->id($params, 'organization_id');
        unset($params['organization_id']);

        return $this->get('orgs/'.$organizationId.'/spaces', $params);
    }

    /**
     * Get one space.
     *
     * @param  array<string, mixed>  $params  Space ID.
     * @return array<string, mixed>
     */
    public function getSpace(array $params): array
    {
        return $this->get('spaces/'.$this->id($params, 'space_id'));
    }

    /**
     * Search content in a space.
     *
     * @param  array<string, mixed>  $params  Space ID, search query, page, and limit.
     * @return array<string, mixed>
     */
    public function searchSpace(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        unset($params['space_id']);
        $this->require($params, ['query'], 'space search');

        return $this->get('spaces/'.$spaceId.'/search', $params);
    }

    /**
     * Get the current content revision for a space.
     *
     * @param  array<string, mixed>  $params  Space ID plus metadata/computed flags.
     * @return array<string, mixed>
     */
    public function getSpaceContent(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        unset($params['space_id']);

        return $this->get('spaces/'.$spaceId.'/content', $params);
    }

    /**
     * List all pages in a space content revision.
     *
     * @param  array<string, mixed>  $params  Space ID and metadata flag.
     * @return array<string, mixed>
     */
    public function listPages(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        unset($params['space_id']);

        return $this->get('spaces/'.$spaceId.'/content/pages', $params);
    }

    /**
     * Get one page by ID.
     *
     * @param  array<string, mixed>  $params  Space ID, page ID, format, and metadata options.
     * @return array<string, mixed>
     */
    public function getPage(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        $pageId = $this->id($params, 'page_id');
        unset($params['space_id'], $params['page_id']);

        return $this->get('spaces/'.$spaceId.'/content/page/'.$pageId, $params);
    }

    /**
     * Get one page by path.
     *
     * @param  array<string, mixed>  $params  Space ID, page path, format, and metadata options.
     * @return array<string, mixed>
     */
    public function getPageByPath(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        $pagePath = trim((string) ($params['page_path'] ?? ''), '/');
        if ($pagePath === '') {
            throw new RuntimeException('page_path is required.');
        }
        unset($params['space_id'], $params['page_path']);

        return $this->get('spaces/'.$spaceId.'/content/path/'.str_replace('%2F', '/', rawurlencode($pagePath)), $params);
    }

    /**
     * List all files in a space.
     *
     * @param  array<string, mixed>  $params  Space ID, pagination, limit, and metadata options.
     * @return array<string, mixed>
     */
    public function listFiles(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        unset($params['space_id']);

        return $this->get('spaces/'.$spaceId.'/content/files', $params);
    }

    /**
     * Get one file by ID.
     *
     * @param  array<string, mixed>  $params  Space ID, file ID, and metadata options.
     * @return array<string, mixed>
     */
    public function getFile(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        $fileId = $this->id($params, 'file_id');
        unset($params['space_id'], $params['file_id']);

        return $this->get('spaces/'.$spaceId.'/content/files/'.$fileId, $params);
    }

    /**
     * List OpenAPI specifications in a space.
     *
     * @param  array<string, mixed>  $params  Space ID and pagination options.
     * @return array<string, mixed>
     */
    public function listOpenApiSpecs(array $params): array
    {
        $spaceId = $this->id($params, 'space_id');
        unset($params['space_id']);

        return $this->get('spaces/'.$spaceId.'/openapi', $params);
    }

    /**
     * Execute a GitBook GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('GitBook API token is required.');
        }

        try {
            $response = Http::acceptJson()
                ->withToken($this->token)
                ->timeout(60)
                ->get($this->baseUrl.'/'.$path, $this->clean($query));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('GitBook API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to GitBook API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize GitBook errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : trim(strip_tags($response->body()));
            Log::error('GitBook API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('GitBook API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Validate a required identifier and URL-encode it.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function id(array $params, string $field): string
    {
        if (!array_key_exists($field, $params) || trim((string) $params[$field]) === '') {
            throw new RuntimeException($field.' is required.');
        }

        return rawurlencode((string) $params[$field]);
    }

    /**
     * Validate required query/body fields.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @param  list<string>  $required  Required field names.
     */
    private function require(array $params, array $required, string $label): void
    {
        foreach ($required as $field) {
            if (!array_key_exists($field, $params) || trim((string) $params[$field]) === '') {
                throw new RuntimeException($field.' is required for '.$label.'.');
            }
        }
    }

    /**
     * Remove null and empty-string query values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function clean(array $query): array
    {
        return array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');
    }
}
