<?php

namespace OpenCompany\Integrations\ReadMe;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ReadMe API.
 *
 * Handles Bearer-token authentication, API v2 branch-based endpoints, legacy
 * search routing, request validation, and response error normalization.
 */
class ReadMeService
{
    /**
     * @param  string  $apiToken  ReadMe API key or token.
     * @param  string  $baseUrl  ReadMe API v2 base URL.
     * @param  string  $legacyBaseUrl  ReadMe legacy dashboard API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.readme.com/v2',
        private string $legacyBaseUrl = 'https://dash.readme.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->legacyBaseUrl = rtrim($this->legacyBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiToken) !== '';
    }

    /**
     * Get project metadata.
     *
     * @param  array<string, mixed>  $params  No parameters.
     * @return array<string, mixed>
     */
    public function getProjectMetadata(array $params = []): array
    {
        return $this->get('project', $params);
    }

    /**
     * Get API keys for a project subdomain.
     *
     * @param  array<string, mixed>  $params  Project subdomain and pagination options.
     * @return array<string, mixed>
     */
    public function listApiKeys(array $params): array
    {
        $subdomain = $this->id($params, 'subdomain');
        unset($params['subdomain']);

        return $this->get('projects/'.$subdomain.'/apikeys', $params);
    }

    /**
     * Get ReadMe branches.
     *
     * @param  array<string, mixed>  $params  Pagination options.
     * @return array<string, mixed>
     */
    public function listBranches(array $params = []): array
    {
        return $this->get('branches', $params);
    }

    /**
     * Get one branch.
     *
     * @param  array<string, mixed>  $params  Branch name.
     * @return array<string, mixed>
     */
    public function getBranch(array $params): array
    {
        return $this->get('branches/'.$this->branch($params));
    }

    /**
     * Get categories for a branch section.
     *
     * @param  array<string, mixed>  $params  Branch and section.
     * @return array<string, mixed>
     */
    public function listCategories(array $params): array
    {
        return $this->get('branches/'.$this->branch($params).'/categories/'.$this->section($params));
    }

    /**
     * Get a category by title or slug.
     *
     * @param  array<string, mixed>  $params  Branch, section, and category title.
     * @return array<string, mixed>
     */
    public function getCategory(array $params): array
    {
        return $this->get('branches/'.$this->branch($params).'/categories/'.$this->section($params).'/'.$this->id($params, 'title'));
    }

    /**
     * Get pages within a category.
     *
     * @param  array<string, mixed>  $params  Branch, section, category title, and pagination options.
     * @return array<string, mixed>
     */
    public function listCategoryPages(array $params): array
    {
        $branch = $this->branch($params);
        $section = $this->section($params);
        $title = $this->id($params, 'title');
        unset($params['branch'], $params['section'], $params['title']);

        return $this->get('branches/'.$branch.'/categories/'.$section.'/'.$title.'/pages', $params);
    }

    /**
     * Get a guide page by slug.
     *
     * @param  array<string, mixed>  $params  Branch and slug.
     * @return array<string, mixed>
     */
    public function getGuide(array $params): array
    {
        return $this->get('branches/'.$this->branch($params).'/guides/'.$this->id($params, 'slug'));
    }

    /**
     * Get an API reference page by slug.
     *
     * @param  array<string, mixed>  $params  Branch and slug.
     * @return array<string, mixed>
     */
    public function getReference(array $params): array
    {
        return $this->get('branches/'.$this->branch($params).'/references/'.$this->id($params, 'slug'));
    }

    /**
     * Get all API definitions.
     *
     * @param  array<string, mixed>  $params  Pagination options.
     * @return array<string, mixed>
     */
    public function listApiDefinitions(array $params = []): array
    {
        return $this->get('apis', $params);
    }

    /**
     * Get one API definition.
     *
     * @param  array<string, mixed>  $params  API definition ID.
     * @return array<string, mixed>
     */
    public function getApiDefinition(array $params): array
    {
        return $this->get('apis/'.$this->id($params, 'api_id'));
    }

    /**
     * Search ReadMe docs using the legacy search endpoint documented by ReadMe.
     *
     * @param  array<string, mixed>  $params  Search query and optional x-readme-version header.
     * @return array<string, mixed>
     */
    public function searchDocs(array $params): array
    {
        $this->require($params, ['search'], 'docs search');
        $headers = [];
        if (($params['version'] ?? '') !== '') {
            $headers['x-readme-version'] = (string) $params['version'];
        }

        return $this->legacyPost('docs/search', ['search' => $params['search']], $headers);
    }

    /**
     * Execute a ReadMe v2 GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        return $this->request('get', $this->baseUrl.'/'.$path, query: $this->clean($query));
    }

    /**
     * Execute a ReadMe legacy POST request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, string>  $headers  Additional headers.
     * @return array<string, mixed>
     */
    private function legacyPost(string $path, array $body = [], array $headers = []): array
    {
        return $this->request('post', $this->legacyBaseUrl.'/'.$path, body: $this->clean($body), extraHeaders: $headers);
    }

    /**
     * Execute a ReadMe HTTP request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, string>  $extraHeaders  Additional headers.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $body = [], array $extraHeaders = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('ReadMe API token is required.');
        }

        try {
            $pending = Http::acceptJson()
                ->asJson()
                ->withToken($this->apiToken)
                ->withHeaders($extraHeaders)
                ->timeout(60);

            $response = match ($method) {
                'get' => $pending->get($url, $query),
                'post' => $pending->post($url, $body),
                default => throw new RuntimeException('Unsupported ReadMe HTTP method.'),
            };

            return $this->parseResponse($response, $url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('ReadMe API connection error', ['url' => $url, 'error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to ReadMe API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize ReadMe API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $url): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : trim(strip_tags($response->body()));
            Log::error('ReadMe API error', ['url' => $url, 'status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('ReadMe API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Validate and URL-encode a required identifier.
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
     * Validate and URL-encode the branch parameter.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function branch(array $params): string
    {
        return $this->id($params, 'branch');
    }

    /**
     * Validate the ReadMe section parameter.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function section(array $params): string
    {
        $section = (string) ($params['section'] ?? '');
        if (!in_array($section, ['guides', 'reference', 'recipes', 'custom_pages'], true)) {
            throw new RuntimeException('section must be guides, reference, recipes, or custom_pages.');
        }

        return rawurlencode($section);
    }

    /**
     * Validate required fields.
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
     * Remove null and empty-string values.
     *
     * @param  array<string, mixed>  $input  Input values.
     * @return array<string, mixed>
     */
    private function clean(array $input): array
    {
        return array_filter($input, static fn (mixed $value): bool => $value !== null && $value !== '');
    }
}
