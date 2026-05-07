<?php

namespace OpenCompany\Integrations\BraveSearch;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Brave Search API.
 *
 * Handles subscription-token authentication, GET and POST endpoint dispatch,
 * optional location headers, and Brave error normalization.
 */
class BraveSearchService
{
    /**
     * @param  string  $apiKey  Brave Search API subscription token.
     * @param  string  $baseUrl  Brave Search API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.search.brave.com/res/v1')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Search Brave's web index.
     *
     * @param  array<string, mixed>  $params  Query, country, language, freshness, pagination, snippets, rich, goggles, local, and location header options.
     * @return array<string, mixed>
     */
    public function webSearch(array $params): array
    {
        return $this->get('web/search', $params, ['q']);
    }

    /**
     * Fetch a rich callback result returned by web search.
     *
     * @param  array<string, mixed>  $params  Rich callback key.
     * @return array<string, mixed>
     */
    public function webRich(array $params): array
    {
        return $this->get('web/rich', $params, ['callback_key']);
    }

    /**
     * Retrieve LLM-ready extracted web context with GET.
     *
     * @param  array<string, mixed>  $params  Query, context budget, threshold, local, goggles, and location header options.
     * @return array<string, mixed>
     */
    public function llmContext(array $params): array
    {
        return $this->get('llm/context', $params, ['q']);
    }

    /**
     * Retrieve LLM-ready extracted web context with POST.
     *
     * @param  array<string, mixed>  $params  JSON body matching LLM context query parameters plus optional location headers.
     * @return array<string, mixed>
     */
    public function llmContextPost(array $params): array
    {
        return $this->post('llm/context', $params, ['q']);
    }

    /**
     * Search Brave's image index.
     *
     * @param  array<string, mixed>  $params  Query, country, language, count, safesearch, and spellcheck options.
     * @return array<string, mixed>
     */
    public function imageSearch(array $params): array
    {
        return $this->get('images/search', $params, ['q']);
    }

    /**
     * Search Brave's news index.
     *
     * @param  array<string, mixed>  $params  Query, country, language, freshness, pagination, snippets, goggles, and safesearch options.
     * @return array<string, mixed>
     */
    public function newsSearch(array $params): array
    {
        return $this->get('news/search', $params, ['q']);
    }

    /**
     * Search Brave's video index.
     *
     * @param  array<string, mixed>  $params  Query, country, language, freshness, pagination, safesearch, and spellcheck options.
     * @return array<string, mixed>
     */
    public function videoSearch(array $params): array
    {
        return $this->get('videos/search', $params, ['q']);
    }

    /**
     * Search geographic places.
     *
     * @param  array<string, mixed>  $params  Query, coordinates, location, radius, count, country, language, units, safesearch, and spellcheck options.
     * @return array<string, mixed>
     */
    public function placeSearch(array $params): array
    {
        if ((array_key_exists('latitude', $params) xor array_key_exists('longitude', $params))) {
            throw new RuntimeException('latitude and longitude must be provided together.');
        }

        return $this->get('local/place_search', $params);
    }

    /**
     * Fetch details for local place IDs.
     *
     * @param  array<string, mixed>  $params  One or more ephemeral place IDs, language, UI locale, and units.
     * @return array<string, mixed>
     */
    public function localPois(array $params): array
    {
        return $this->get('local/pois', $params, ['ids']);
    }

    /**
     * Fetch AI-generated descriptions for local place IDs.
     *
     * @param  array<string, mixed>  $params  One or more ephemeral place IDs.
     * @return array<string, mixed>
     */
    public function localDescriptions(array $params): array
    {
        return $this->get('local/descriptions', $params, ['ids']);
    }

    /**
     * Get query autocomplete suggestions.
     *
     * @param  array<string, mixed>  $params  Partial query, country, count, and rich suggestion options.
     * @return array<string, mixed>
     */
    public function suggest(array $params): array
    {
        return $this->get('suggest/search', $params, ['q']);
    }

    /**
     * Get spellcheck corrections for a query.
     *
     * @param  array<string, mixed>  $params  Query and country options.
     * @return array<string, mixed>
     */
    public function spellcheck(array $params): array
    {
        return $this->get('spellcheck/search', $params, ['q']);
    }

    /**
     * Create a Brave grounded answer through the OpenAI-compatible endpoint.
     *
     * @param  array<string, mixed>  $params  Chat completion payload, including messages, stream, country, language, citations, entities, and research flags.
     * @return array<string, mixed>
     */
    public function answer(array $params): array
    {
        if (!isset($params['messages']) || !is_array($params['messages'])) {
            throw new RuntimeException('messages is required and must be an array.');
        }

        $params['model'] ??= 'brave';

        return $this->post('chat/completions', $params);
    }

    /**
     * Fetch a legacy summarizer search result by key.
     *
     * @param  array<string, mixed>  $params  Summarizer key and optional entity_info or inline_references flags.
     * @return array<string, mixed>
     */
    public function summarizerSearch(array $params): array
    {
        return $this->get('summarizer/search', $params, ['key']);
    }

    /**
     * Fetch just the legacy summarizer summary.
     *
     * @param  array<string, mixed>  $params  Summarizer key and optional inline_references flag.
     * @return array<string, mixed>
     */
    public function summarizerSummary(array $params): array
    {
        return $this->get('summarizer/summary', $params, ['key']);
    }

    /**
     * Fetch just the legacy summarizer title.
     *
     * @param  array<string, mixed>  $params  Summarizer key.
     * @return array<string, mixed>
     */
    public function summarizerTitle(array $params): array
    {
        return $this->get('summarizer/title', $params, ['key']);
    }

    /**
     * Fetch legacy summarizer enrichment data.
     *
     * @param  array<string, mixed>  $params  Summarizer key.
     * @return array<string, mixed>
     */
    public function summarizerEnrichments(array $params): array
    {
        return $this->get('summarizer/enrichments', $params, ['key']);
    }

    /**
     * Fetch legacy summarizer follow-up questions.
     *
     * @param  array<string, mixed>  $params  Summarizer key.
     * @return array<string, mixed>
     */
    public function summarizerFollowups(array $params): array
    {
        return $this->get('summarizer/followups', $params, ['key']);
    }

    /**
     * Fetch legacy summarizer entity information.
     *
     * @param  array<string, mixed>  $params  Summarizer key.
     * @return array<string, mixed>
     */
    public function summarizerEntityInfo(array $params): array
    {
        return $this->get('summarizer/entity_info', $params, ['key']);
    }

    /**
     * Execute a Brave Search GET request.
     *
     * @param  array<string, mixed>  $params  Query parameters and optional location header inputs.
     * @param  list<string>  $required  Required query parameter names.
     * @return array<string, mixed>
     */
    private function get(string $path, array $params = [], array $required = []): array
    {
        $this->validateConfiguredAndRequired($path, $params, $required);
        [$query, $headers] = $this->splitQueryAndHeaders($params);

        try {
            $response = Http::acceptJson()
                ->withHeaders($this->headers($headers))
                ->timeout(60)
                ->get($this->baseUrl.'/'.$path, $query);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Brave Search API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Brave Search API: '.$e->getMessage());
        }
    }

    /**
     * Execute a Brave Search POST request.
     *
     * @param  array<string, mixed>  $params  JSON body and optional location header inputs.
     * @param  list<string>  $required  Required body parameter names.
     * @return array<string, mixed>
     */
    private function post(string $path, array $params = [], array $required = []): array
    {
        $this->validateConfiguredAndRequired($path, $params, $required);
        [$body, $headers] = $this->splitQueryAndHeaders($params);

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->withHeaders($this->headers($headers))
                ->timeout(60)
                ->post($this->baseUrl.'/'.$path, $body);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Brave Search API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Brave Search API: '.$e->getMessage());
        }
    }

    /**
     * Validate credentials and required parameters.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @param  list<string>  $required  Required parameter names.
     */
    private function validateConfiguredAndRequired(string $path, array $params, array $required): void
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Brave Search API key is required.');
        }

        foreach ($required as $field) {
            if (!array_key_exists($field, $params) || $params[$field] === null || $params[$field] === '' || (is_array($params[$field]) && $params[$field] === [])) {
                throw new RuntimeException($field.' is required for '.$path.'.');
            }
        }
    }

    /**
     * Split location header inputs from query/body parameters.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array{0: array<string, mixed>, 1: array<string, string>}
     */
    private function splitQueryAndHeaders(array $params): array
    {
        $headers = [];
        $query = [];
        $headerMap = [
            'loc_lat' => 'X-Loc-Lat',
            'loc_long' => 'X-Loc-Long',
            'loc_city' => 'X-Loc-City',
            'loc_state' => 'X-Loc-State',
            'loc_state_name' => 'X-Loc-State-Name',
            'loc_country' => 'X-Loc-Country',
            'loc_postal_code' => 'X-Loc-Postal-Code',
        ];

        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if (isset($headerMap[$key])) {
                $headers[$headerMap[$key]] = (string) $value;
                continue;
            }
            $query[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }

        return [$query, $headers];
    }

    /**
     * Build request headers for Brave Search.
     *
     * @param  array<string, string>  $extraHeaders  Optional location headers.
     * @return array<string, string>
     */
    private function headers(array $extraHeaders = []): array
    {
        return ['X-Subscription-Token' => $this->apiKey, 'Accept-Encoding' => 'gzip'] + $extraHeaders;
    }

    /**
     * Parse JSON responses and normalize Brave Search API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful() || (is_array($json) && array_key_exists('error', $json))) {
            $message = is_array($json)
                ? (string) ($json['error']['message'] ?? $json['message'] ?? $json['detail'] ?? '')
                : trim(strip_tags($response->body()));
            Log::error('Brave Search API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('Brave Search API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }
}
