<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Parameter schemas shared by Brave Search tool classes.
 *
 * Keeps endpoint-specific tool files compact while still documenting Brave's
 * common query, locale, pagination, local, and AI-grounding options.
 */
class BraveSearchParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function web(): array
    {
        return self::query() + self::locale() + self::pagination(20) + self::freshness() + [
            'safesearch' => self::safesearch('moderate'),
            'spellcheck' => self::bool('Whether to apply spellcheck to the query.'),
            'extra_snippets' => self::bool('Return up to five additional snippets per result when supported by the plan.'),
            'summary' => self::bool('Request a legacy summarizer key in the web response.'),
            'enable_rich_callback' => self::bool('Return a rich callback key when rich data is available for the query.'),
            'goggles' => ['type' => 'string', 'required' => false, 'description' => 'Goggle URL or inline definition for custom reranking.'],
            'units' => ['type' => 'string', 'required' => false, 'description' => 'Units for local/rich results.', 'enum' => ['metric', 'imperial']],
        ] + self::locationHeaders();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function webRich(): array
    {
        return [
            'callback_key' => ['type' => 'string', 'required' => true, 'description' => 'Opaque rich callback key returned by web search when enable_rich_callback=1.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function llmContext(): array
    {
        return self::query() + [
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Country for search results, default us.'],
            'search_lang' => ['type' => 'string', 'required' => false, 'description' => 'Language preference for results, default en.'],
            'count' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum search results to consider. Range 1-50.'],
            'maximum_number_of_urls' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum URLs in the response. Range 1-50.'],
            'maximum_number_of_tokens' => ['type' => 'integer', 'required' => false, 'description' => 'Approximate maximum tokens in context. Range 1024-32768.'],
            'maximum_number_of_snippets' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum snippets across all URLs. Range 1-100.'],
            'maximum_number_of_tokens_per_url' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum tokens per URL. Range 512-8192.'],
            'maximum_number_of_snippets_per_url' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum snippets per URL. Range 1-100.'],
            'context_threshold_mode' => ['type' => 'string', 'required' => false, 'description' => 'Relevance threshold mode.', 'enum' => ['strict', 'balanced', 'lenient', 'disabled']],
            'enable_local' => self::bool('Force or disable local recall. Omit to let Brave auto-detect from location headers.'),
            'goggles' => ['type' => 'string', 'required' => false, 'description' => 'Goggle URL or inline definition for custom reranking.'],
        ] + self::freshness() + self::locationHeaders();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function media(int $maxCount, string $defaultSafeSearch = 'strict'): array
    {
        return self::query() + self::locale() + self::pagination($maxCount) + self::freshness() + [
            'safesearch' => self::safesearch($defaultSafeSearch),
            'spellcheck' => self::bool('Whether to apply spellcheck to the query.'),
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function news(): array
    {
        return self::query() + self::locale() + self::pagination(50) + self::freshness() + [
            'safesearch' => self::safesearch('strict'),
            'extra_snippets' => self::bool('Return up to five additional snippets per result when supported by the plan.'),
            'goggles' => ['type' => 'string', 'required' => false, 'description' => 'Goggle URL or inline definition for custom news reranking.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function place(): array
    {
        return [
            'latitude' => ['type' => 'number', 'required' => false, 'description' => 'Latitude of the search center. Required with longitude when coordinates are used.'],
            'longitude' => ['type' => 'number', 'required' => false, 'description' => 'Longitude of the search center. Required with latitude when coordinates are used.'],
            'location' => ['type' => 'string', 'required' => false, 'description' => 'Location name, such as san francisco ca united states or tokyo japan.'],
            'q' => ['type' => 'string', 'required' => false, 'description' => 'What to look for. Omit for explore mode around a location.'],
            'radius' => ['type' => 'number', 'required' => false, 'description' => 'Search radius bias in meters.'],
            'count' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results to return. Range 1-50.'],
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter country code.'],
            'search_lang' => ['type' => 'string', 'required' => false, 'description' => 'Search language.'],
            'ui_lang' => ['type' => 'string', 'required' => false, 'description' => 'UI language for response metadata.'],
            'units' => ['type' => 'string', 'required' => false, 'description' => 'Measurement units.', 'enum' => ['metric', 'imperial']],
            'safesearch' => self::safesearch('strict'),
            'spellcheck' => self::bool('Whether to apply spellcheck to the query.'),
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function localPois(): array
    {
        return [
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'One or more ephemeral place IDs from web or place search, maximum 20.', 'items' => ['type' => 'string']],
            'search_lang' => ['type' => 'string', 'required' => false, 'description' => 'Search language preference.'],
            'ui_lang' => ['type' => 'string', 'required' => false, 'description' => 'UI language for response metadata.'],
            'units' => ['type' => 'string', 'required' => false, 'description' => 'Measurement units.', 'enum' => ['metric', 'imperial']],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function localDescriptions(): array
    {
        return [
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'One or more ephemeral place IDs from web or place search, maximum 20.', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function suggest(): array
    {
        return self::query() + [
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Country for suggestions.'],
            'count' => ['type' => 'integer', 'required' => false, 'description' => 'Number of suggestions to return.'],
            'rich' => self::bool('Return rich suggestion metadata when supported by the plan.'),
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function spellcheck(): array
    {
        return self::query() + [
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Country for spelling corrections.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function answer(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'OpenAI-compatible chat messages.', 'items' => ['type' => 'object']],
            'model' => ['type' => 'string', 'required' => false, 'description' => 'Model name. Defaults to brave.'],
            'stream' => self::bool('Whether to stream. Non-streaming responses are easiest for tool use.'),
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Target country for search results.'],
            'language' => ['type' => 'string', 'required' => false, 'description' => 'Response language.'],
            'enable_entities' => self::bool('Include entity information. Brave requires streaming for advanced flags.'),
            'enable_citations' => self::bool('Include inline citations. Brave requires streaming for advanced flags.'),
            'enable_research' => self::bool('Enable multi-search research mode. Brave requires streaming for advanced flags.'),
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function summarizer(bool $withFlags = false): array
    {
        return [
            'key' => ['type' => 'string', 'required' => true, 'description' => 'Opaque summarizer key returned by web search with summary=1.'],
        ] + ($withFlags ? [
            'entity_info' => self::bool('Include entity information when available.'),
            'inline_references' => self::bool('Include inline references when available.'),
        ] : []);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function query(): array
    {
        return ['q' => ['type' => 'string', 'required' => true, 'description' => 'Search query. Brave search operators belong inside this string.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function locale(): array
    {
        return [
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter country code, or ALL where supported.'],
            'search_lang' => ['type' => 'string', 'required' => false, 'description' => 'Search result language preference.'],
            'ui_lang' => ['type' => 'string', 'required' => false, 'description' => 'UI language for response metadata.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function freshness(): array
    {
        return ['freshness' => ['type' => 'string', 'required' => false, 'description' => 'Freshness filter: pd, pw, pm, py, or YYYY-MM-DDtoYYYY-MM-DD.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function pagination(int $maxCount): array
    {
        return [
            'count' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results to return. Maximum '.$maxCount.'.'],
            'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based page offset. Brave caps offsets at 9 for most search endpoints.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function locationHeaders(): array
    {
        return [
            'loc_lat' => ['type' => 'number', 'required' => false, 'description' => 'Location header latitude for local-aware search.'],
            'loc_long' => ['type' => 'number', 'required' => false, 'description' => 'Location header longitude for local-aware search.'],
            'loc_city' => ['type' => 'string', 'required' => false, 'description' => 'Location header city.'],
            'loc_state' => ['type' => 'string', 'required' => false, 'description' => 'Location header state or region code.'],
            'loc_state_name' => ['type' => 'string', 'required' => false, 'description' => 'Location header state or region name.'],
            'loc_country' => ['type' => 'string', 'required' => false, 'description' => 'Location header country code.'],
            'loc_postal_code' => ['type' => 'string', 'required' => false, 'description' => 'Location header postal code.'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function bool(string $description): array
    {
        return ['type' => 'boolean', 'required' => false, 'description' => $description];
    }

    /**
     * @return array<string, mixed>
     */
    private static function safesearch(string $default): array
    {
        return ['type' => 'string', 'required' => false, 'description' => 'Safe search level. Brave default for this endpoint is '.$default.'.', 'enum' => ['off', 'moderate', 'strict']];
    }
}
