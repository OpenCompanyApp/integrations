<?php

namespace OpenCompany\Integrations\NewsApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for NewsAPI v2.
 *
 * Handles API-key authentication, endpoint routing, snake_case to camelCase
 * query mapping, compatibility validation, and API error normalization.
 */
class NewsApiService
{
    private const CATEGORIES = ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'];
    private const LANGUAGES = ['ar', 'de', 'en', 'es', 'fr', 'he', 'it', 'nl', 'no', 'pt', 'ru', 'sv', 'ud', 'zh'];
    private const COUNTRIES = ['ae', 'ar', 'at', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr', 'hk', 'hu', 'id', 'ie', 'il', 'in', 'it', 'jp', 'kr', 'lt', 'lv', 'ma', 'mx', 'my', 'ng', 'nl', 'no', 'nz', 'ph', 'pl', 'pt', 'ro', 'rs', 'ru', 'sa', 'se', 'sg', 'si', 'sk', 'th', 'tr', 'tw', 'ua', 'us', 've', 'za'];

    /**
     * @param  string  $apiKey  NewsAPI key.
     * @param  string  $baseUrl  NewsAPI v2 base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://newsapi.org/v2')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Search across indexed articles.
     *
     * @param  array<string, mixed>  $params  Search query, sources, domains, date, language, sort, and pagination filters.
     * @return array<string, mixed>
     */
    public function everything(array $params): array
    {
        if (($params['q'] ?? '') === '' && ($params['sources'] ?? '') === '' && ($params['domains'] ?? '') === '') {
            throw new RuntimeException('q, sources, or domains is required for everything searches.');
        }

        $query = $this->map($params, [
            'q' => 'q',
            'search_in' => 'searchIn',
            'sources' => 'sources',
            'domains' => 'domains',
            'exclude_domains' => 'excludeDomains',
            'from_date' => 'from',
            'to_date' => 'to',
            'language' => 'language',
            'sort_by' => 'sortBy',
            'page_size' => 'pageSize',
            'page' => 'page',
        ]);

        $this->validateCsvChoices((string) ($params['search_in'] ?? ''), ['title', 'description', 'content'], 'search_in');
        $this->validateChoice((string) ($params['language'] ?? ''), self::LANGUAGES, 'language');
        $this->validateChoice((string) ($params['sort_by'] ?? ''), ['relevancy', 'popularity', 'publishedAt'], 'sort_by');

        return $this->request('/everything', $query);
    }

    /**
     * Retrieve live top and breaking headlines.
     *
     * @param  array<string, mixed>  $params  Country, category, sources, query, and pagination filters.
     * @return array<string, mixed>
     */
    public function topHeadlines(array $params = []): array
    {
        if (($params['sources'] ?? '') !== '' && (($params['country'] ?? '') !== '' || ($params['category'] ?? '') !== '')) {
            throw new RuntimeException('sources cannot be mixed with country or category for top headlines.');
        }

        $query = $this->map($params, [
            'country' => 'country',
            'category' => 'category',
            'sources' => 'sources',
            'q' => 'q',
            'page_size' => 'pageSize',
            'page' => 'page',
        ]);

        $this->validateChoice((string) ($params['country'] ?? ''), self::COUNTRIES, 'country');
        $this->validateChoice((string) ($params['category'] ?? ''), self::CATEGORIES, 'category');

        return $this->request('/top-headlines', $query);
    }

    /**
     * List sources available to top-headlines.
     *
     * @param  array<string, mixed>  $params  Category, language, and country filters.
     * @return array<string, mixed>
     */
    public function sources(array $params = []): array
    {
        $query = $this->map($params, [
            'category' => 'category',
            'language' => 'language',
            'country' => 'country',
        ]);

        $this->validateChoice((string) ($params['category'] ?? ''), self::CATEGORIES, 'category');
        $this->validateChoice((string) ($params['language'] ?? ''), self::LANGUAGES, 'language');
        $this->validateChoice((string) ($params['country'] ?? ''), self::COUNTRIES, 'country');

        return $this->request('/top-headlines/sources', $query);
    }

    /**
     * Execute a NewsAPI GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $path, array $query = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('NewsAPI API key is required.');
        }

        try {
            $response = Http::acceptJson()
                ->withHeaders(['X-Api-Key' => $this->apiKey])
                ->timeout(60)
                ->get($this->baseUrl.$path, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('NewsAPI connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to NewsAPI: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize NewsAPI errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful() || (is_array($json) && ($json['status'] ?? null) === 'error')) {
            $code = is_array($json) ? (string) ($json['code'] ?? '') : '';
            $message = is_array($json) ? (string) ($json['message'] ?? '') : trim(strip_tags($response->body()));
            Log::error('NewsAPI error: '.$path, ['status' => $response->status(), 'code' => $code, 'error' => $message]);

            throw new RuntimeException('NewsAPI error'.($code !== '' ? ' '.$code : '').' ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Map tool argument names to NewsAPI query parameter names.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @param  array<string, string>  $map  Snake-case to API field map.
     * @return array<string, mixed>
     */
    private function map(array $params, array $map): array
    {
        $query = [];
        foreach ($map as $from => $to) {
            if (array_key_exists($from, $params)) {
                $query[$to] = is_bool($params[$from]) ? ($params[$from] ? 'true' : 'false') : $params[$from];
            }
        }

        return $query;
    }

    /**
     * Validate an optional enum parameter.
     *
     * @param  list<string>  $allowed  Allowed values.
     */
    private function validateChoice(string $value, array $allowed, string $field): void
    {
        if ($value !== '' && !in_array($value, $allowed, true)) {
            throw new RuntimeException($field.' must be one of: '.implode(', ', $allowed).'.');
        }
    }

    /**
     * Validate an optional comma-separated enum parameter.
     *
     * @param  list<string>  $allowed  Allowed values.
     */
    private function validateCsvChoices(string $value, array $allowed, string $field): void
    {
        if ($value === '') {
            return;
        }

        foreach (array_map('trim', explode(',', $value)) as $part) {
            $this->validateChoice($part, $allowed, $field);
        }
    }
}
