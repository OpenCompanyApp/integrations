<?php

namespace OpenCompany\Integrations\Fred;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Federal Reserve Economic Data API.
 *
 * Handles API-key authentication, JSON response selection, endpoint validation,
 * error normalization, and all FRED API communication for tool classes.
 */
class FredService
{
    /**
     * @param  string  $apiKey  FRED API key.
     * @param  string  $baseUrl  FRED API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.stlouisfed.org/fred')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Get a FRED category.
     *
     * @param  array<string, mixed>  $params  Optional category_id and realtime period.
     * @return array<string, mixed>
     */
    public function category(array $params = []): array
    {
        return $this->request('category', $params);
    }

    /**
     * Get child categories for a parent category.
     *
     * @param  array<string, mixed>  $params  Optional category_id and realtime period.
     * @return array<string, mixed>
     */
    public function categoryChildren(array $params = []): array
    {
        return $this->request('category/children', $params);
    }

    /**
     * Get related categories for a category.
     *
     * @param  array<string, mixed>  $params  Category identifier and realtime period.
     * @return array<string, mixed>
     */
    public function categoryRelated(array $params): array
    {
        return $this->request('category/related', $params, ['category_id']);
    }

    /**
     * Get series in a category.
     *
     * @param  array<string, mixed>  $params  Category identifier, search, filters, ordering, pagination, and realtime period.
     * @return array<string, mixed>
     */
    public function categorySeries(array $params): array
    {
        return $this->request('category/series', $params, ['category_id']);
    }

    /**
     * Get tags for a category.
     *
     * @param  array<string, mixed>  $params  Category identifier and tag filters.
     * @return array<string, mixed>
     */
    public function categoryTags(array $params): array
    {
        return $this->request('category/tags', $params, ['category_id']);
    }

    /**
     * Get related tags for a category and tag set.
     *
     * @param  array<string, mixed>  $params  Category identifier, tag_names, and optional tag filters.
     * @return array<string, mixed>
     */
    public function categoryRelatedTags(array $params): array
    {
        return $this->request('category/related_tags', $params, ['category_id', 'tag_names']);
    }

    /**
     * Get all releases of economic data.
     *
     * @param  array<string, mixed>  $params  Realtime period, ordering, and pagination options.
     * @return array<string, mixed>
     */
    public function releases(array $params = []): array
    {
        return $this->request('releases', $params);
    }

    /**
     * Get release dates for all releases.
     *
     * @param  array<string, mixed>  $params  Date filters, release filter, ordering, and pagination options.
     * @return array<string, mixed>
     */
    public function releasesDates(array $params = []): array
    {
        return $this->request('releases/dates', $params);
    }

    /**
     * Get one release.
     *
     * @param  array<string, mixed>  $params  Release identifier and realtime period.
     * @return array<string, mixed>
     */
    public function release(array $params): array
    {
        return $this->request('release', $params, ['release_id']);
    }

    /**
     * Get release dates for one release.
     *
     * @param  array<string, mixed>  $params  Release identifier, date filters, ordering, and pagination options.
     * @return array<string, mixed>
     */
    public function releaseDates(array $params): array
    {
        return $this->request('release/dates', $params, ['release_id']);
    }

    /**
     * Get series on a release.
     *
     * @param  array<string, mixed>  $params  Release identifier, filters, ordering, pagination, and realtime period.
     * @return array<string, mixed>
     */
    public function releaseSeries(array $params): array
    {
        return $this->request('release/series', $params, ['release_id']);
    }

    /**
     * Get sources for a release.
     *
     * @param  array<string, mixed>  $params  Release identifier and realtime period.
     * @return array<string, mixed>
     */
    public function releaseSources(array $params): array
    {
        return $this->request('release/sources', $params, ['release_id']);
    }

    /**
     * Get tags for a release.
     *
     * @param  array<string, mixed>  $params  Release identifier and tag filters.
     * @return array<string, mixed>
     */
    public function releaseTags(array $params): array
    {
        return $this->request('release/tags', $params, ['release_id']);
    }

    /**
     * Get related tags for a release and tag set.
     *
     * @param  array<string, mixed>  $params  Release identifier, tag_names, and tag filters.
     * @return array<string, mixed>
     */
    public function releaseRelatedTags(array $params): array
    {
        return $this->request('release/related_tags', $params, ['release_id', 'tag_names']);
    }

    /**
     * Get release tables for a release.
     *
     * @param  array<string, mixed>  $params  Release identifier, optional element_id, observation_date, and observation value inclusion.
     * @return array<string, mixed>
     */
    public function releaseTables(array $params): array
    {
        return $this->request('release/tables', $params, ['release_id']);
    }

    /**
     * Get an economic data series.
     *
     * @param  array<string, mixed>  $params  Series identifier and realtime period.
     * @return array<string, mixed>
     */
    public function series(array $params): array
    {
        return $this->request('series', $params, ['series_id']);
    }

    /**
     * Get categories for a series.
     *
     * @param  array<string, mixed>  $params  Series identifier and realtime period.
     * @return array<string, mixed>
     */
    public function seriesCategories(array $params): array
    {
        return $this->request('series/categories', $params, ['series_id']);
    }

    /**
     * Get observations for an economic data series.
     *
     * @param  array<string, mixed>  $params  Series identifier, date filters, transformations, frequency, aggregation, output type, pagination, and vintage dates.
     * @return array<string, mixed>
     */
    public function seriesObservations(array $params): array
    {
        return $this->request('series/observations', $params, ['series_id']);
    }

    /**
     * Get the release for a series.
     *
     * @param  array<string, mixed>  $params  Series identifier and realtime period.
     * @return array<string, mixed>
     */
    public function seriesRelease(array $params): array
    {
        return $this->request('series/release', $params, ['series_id']);
    }

    /**
     * Search economic data series by text and filters.
     *
     * @param  array<string, mixed>  $params  Search text, search type, filters, ordering, pagination, and realtime period.
     * @return array<string, mixed>
     */
    public function seriesSearch(array $params): array
    {
        return $this->request('series/search', $params, ['search_text']);
    }

    /**
     * Get tags for a series search.
     *
     * @param  array<string, mixed>  $params  Series search text and optional tag filters.
     * @return array<string, mixed>
     */
    public function seriesSearchTags(array $params): array
    {
        return $this->request('series/search/tags', $params, ['series_search_text']);
    }

    /**
     * Get related tags for a series search and tag set.
     *
     * @param  array<string, mixed>  $params  Series search text, tag_names, and optional tag filters.
     * @return array<string, mixed>
     */
    public function seriesSearchRelatedTags(array $params): array
    {
        return $this->request('series/search/related_tags', $params, ['series_search_text', 'tag_names']);
    }

    /**
     * Get tags for a series.
     *
     * @param  array<string, mixed>  $params  Series identifier and realtime period.
     * @return array<string, mixed>
     */
    public function seriesTags(array $params): array
    {
        return $this->request('series/tags', $params, ['series_id']);
    }

    /**
     * Get series sorted by latest FRED server updates.
     *
     * @param  array<string, mixed>  $params  Realtime period, update time filters, filter value, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function seriesUpdates(array $params = []): array
    {
        return $this->request('series/updates', $params);
    }

    /**
     * Get vintage dates for a series.
     *
     * @param  array<string, mixed>  $params  Series identifier, realtime period, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function seriesVintageDates(array $params): array
    {
        return $this->request('series/vintagedates', $params, ['series_id']);
    }

    /**
     * Get all sources of economic data.
     *
     * @param  array<string, mixed>  $params  Realtime period, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function sources(array $params = []): array
    {
        return $this->request('sources', $params);
    }

    /**
     * Get one source of economic data.
     *
     * @param  array<string, mixed>  $params  Source identifier and realtime period.
     * @return array<string, mixed>
     */
    public function source(array $params): array
    {
        return $this->request('source', $params, ['source_id']);
    }

    /**
     * Get releases for a source.
     *
     * @param  array<string, mixed>  $params  Source identifier, realtime period, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function sourceReleases(array $params): array
    {
        return $this->request('source/releases', $params, ['source_id']);
    }

    /**
     * Get all tags, search tags, or get tags by name.
     *
     * @param  array<string, mixed>  $params  Realtime period, tag names, tag group, search text, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function tags(array $params = []): array
    {
        return $this->request('tags', $params);
    }

    /**
     * Get related tags for one or more tags.
     *
     * @param  array<string, mixed>  $params  Tag names, exclusion tags, tag group, search text, ordering, and pagination.
     * @return array<string, mixed>
     */
    public function relatedTags(array $params): array
    {
        return $this->request('related_tags', $params, ['tag_names']);
    }

    /**
     * Get series matching tags.
     *
     * @param  array<string, mixed>  $params  Tag names, exclusion tags, ordering, pagination, and realtime period.
     * @return array<string, mixed>
     */
    public function tagsSeries(array $params): array
    {
        return $this->request('tags/series', $params, ['tag_names']);
    }

    /**
     * Execute a FRED GET request.
     *
     * @param  array<string, mixed>  $params  Endpoint query parameters.
     * @param  list<string>  $required  Required parameter names.
     * @return array<string, mixed>
     */
    private function request(string $path, array $params = [], array $required = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('FRED API key is required.');
        }

        foreach ($required as $field) {
            if (!array_key_exists($field, $params) || trim((string) $params[$field]) === '') {
                throw new RuntimeException($field.' is required for fred/'.$path.'.');
            }
        }

        $query = array_filter($this->normalizeQuery($params) + ['api_key' => $this->apiKey, 'file_type' => 'json'], static fn (mixed $value): bool => $value !== null && $value !== '');

        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl.'/'.$path, $query);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('FRED API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to FRED API: '.$e->getMessage());
        }
    }

    /**
     * Normalize tool query values for FRED.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function normalizeQuery(array $params): array
    {
        $query = [];
        foreach ($params as $key => $value) {
            $query[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }

        return $query;
    }

    /**
     * Parse JSON responses and normalize FRED errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful() || (is_array($json) && array_key_exists('error_code', $json))) {
            $code = is_array($json) ? (string) ($json['error_code'] ?? '') : '';
            $message = is_array($json) ? (string) ($json['error_message'] ?? '') : trim(strip_tags($response->body()));
            Log::error('FRED API error: '.$path, ['status' => $response->status(), 'code' => $code, 'error' => $message]);

            throw new RuntimeException('FRED API error'.($code !== '' ? ' '.$code : '').' ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }
}
