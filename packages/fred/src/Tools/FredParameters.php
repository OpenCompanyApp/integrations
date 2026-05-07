<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Parameter schemas shared by FRED tool classes.
 *
 * Groups common FRED query options so each endpoint tool can expose complete
 * guidance without copying large parameter arrays.
 */
class FredParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function category(bool $requireCategoryId = false): array
    {
        return self::withRealtime([
            'category_id' => ['type' => 'integer', 'required' => $requireCategoryId, 'description' => 'FRED category ID. Root category is 0 when omitted on endpoints that support it.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function categorySeries(): array
    {
        return self::category(true) + self::seriesListFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function categoryTags(): array
    {
        return self::category(true) + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function categoryRelatedTags(): array
    {
        return self::category(true) + [
            'tag_names' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated tag names that related tags must match.'],
        ] + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releases(): array
    {
        return self::withRealtime(self::pagination() + [
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field, such as release_id, name, press_release, realtime_start, or realtime_end.'],
            'sort_order' => self::sortOrder(),
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releasesDates(bool $requireReleaseId = false): array
    {
        return self::withRealtime(($requireReleaseId ? [
            'release_id' => ['type' => 'integer', 'required' => true, 'description' => 'FRED release ID.'],
        ] : []) + self::pagination() + [
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field, such as release_date, release_id, or release_name.'],
            'sort_order' => self::sortOrder(),
            'include_release_dates_with_no_data' => ['type' => 'boolean', 'required' => false, 'description' => 'Include release dates that have no data.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function release(): array
    {
        return self::withRealtime([
            'release_id' => ['type' => 'integer', 'required' => true, 'description' => 'FRED release ID.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releaseSeries(): array
    {
        return self::release() + self::seriesListFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releaseTags(): array
    {
        return self::release() + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releaseRelatedTags(): array
    {
        return self::release() + [
            'tag_names' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated tag names that related tags must match.'],
        ] + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function releaseTables(): array
    {
        return [
            'release_id' => ['type' => 'integer', 'required' => true, 'description' => 'FRED release ID.'],
            'element_id' => ['type' => 'integer', 'required' => false, 'description' => 'Release table element ID to retrieve.'],
            'include_observation_values' => ['type' => 'boolean', 'required' => false, 'description' => 'Include observation values in the response when supported by the release table.'],
            'observation_date' => ['type' => 'string', 'required' => false, 'description' => 'Observation date used when including values, formatted YYYY-MM-DD.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function series(): array
    {
        return self::withRealtime([
            'series_id' => ['type' => 'string', 'required' => true, 'description' => 'FRED series ID, such as GDP or UNRATE.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function seriesObservations(): array
    {
        return self::series() + self::pagination() + [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum observations to return.'],
            'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
            'sort_order' => self::sortOrder(),
            'observation_start' => ['type' => 'string', 'required' => false, 'description' => 'Start observation date, formatted YYYY-MM-DD.'],
            'observation_end' => ['type' => 'string', 'required' => false, 'description' => 'End observation date, formatted YYYY-MM-DD.'],
            'units' => ['type' => 'string', 'required' => false, 'description' => 'Data transformation such as lin, chg, ch1, pch, pc1, pca, cch, cca, or log.'],
            'frequency' => ['type' => 'string', 'required' => false, 'description' => 'Aggregation frequency such as d, w, bw, m, q, sa, or a.'],
            'aggregation_method' => ['type' => 'string', 'required' => false, 'description' => 'Aggregation method such as avg, sum, or eop.'],
            'output_type' => ['type' => 'integer', 'required' => false, 'description' => 'FRED output type. Use 1 for observations by realtime period, 2 for all observations by vintage date, 3 for new/revised observations only, or 4 for initial release only.'],
            'vintage_dates' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated vintage dates, formatted YYYY-MM-DD.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function seriesSearch(): array
    {
        return self::withRealtime([
            'search_text' => ['type' => 'string', 'required' => true, 'description' => 'Text to search in FRED series metadata.'],
            'search_type' => ['type' => 'string', 'required' => false, 'description' => 'Search mode, such as full_text or series_id.'],
        ] + self::seriesListFilters());
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function seriesSearchTags(bool $related = false): array
    {
        return [
            'series_search_text' => ['type' => 'string', 'required' => true, 'description' => 'Text to search in FRED series metadata before returning tags.'],
            'tag_names' => ['type' => 'string', 'required' => $related, 'description' => 'Semicolon-separated tag names. Required for related tag search.'],
        ] + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function seriesUpdates(): array
    {
        return self::withRealtime(self::pagination() + [
            'filter_value' => ['type' => 'string', 'required' => false, 'description' => 'Filter value such as macro, regional, or all.'],
            'start_time' => ['type' => 'string', 'required' => false, 'description' => 'Start update timestamp filter.'],
            'end_time' => ['type' => 'string', 'required' => false, 'description' => 'End update timestamp filter.'],
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function source(bool $required = true): array
    {
        return self::withRealtime(($required ? [
            'source_id' => ['type' => 'integer', 'required' => true, 'description' => 'FRED source ID.'],
        ] : []) + self::pagination() + [
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field, such as source_id, name, realtime_start, or realtime_end.'],
            'sort_order' => self::sortOrder(),
        ]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function tags(): array
    {
        return self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function relatedTags(): array
    {
        return [
            'tag_names' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated tag names.'],
        ] + self::tagFilters();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function tagsSeries(): array
    {
        return [
            'tag_names' => ['type' => 'string', 'required' => true, 'description' => 'Semicolon-separated tag names that matching series must have.'],
            'exclude_tag_names' => ['type' => 'string', 'required' => false, 'description' => 'Semicolon-separated tag names to exclude.'],
        ] + self::withRealtime(self::pagination() + [
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field, such as series_id, title, units, frequency, seasonal_adjustment, realtime_start, realtime_end, last_updated, observation_start, observation_end, or popularity.'],
            'sort_order' => self::sortOrder(),
        ]);
    }

    /**
     * @param  array<string, array<string, mixed>>  $params  Parameter definitions.
     * @return array<string, array<string, mixed>>
     */
    private static function withRealtime(array $params): array
    {
        return [
            'realtime_start' => ['type' => 'string', 'required' => false, 'description' => 'Start of FRED realtime period, formatted YYYY-MM-DD.'],
            'realtime_end' => ['type' => 'string', 'required' => false, 'description' => 'End of FRED realtime period, formatted YYYY-MM-DD.'],
        ] + $params;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function pagination(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
            'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function seriesListFilters(): array
    {
        return self::pagination() + [
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field, such as series_id, title, units, frequency, seasonal_adjustment, realtime_start, realtime_end, last_updated, observation_start, observation_end, or popularity.'],
            'sort_order' => self::sortOrder(),
            'filter_variable' => ['type' => 'string', 'required' => false, 'description' => 'Filter field such as frequency, units, or seasonal_adjustment.'],
            'filter_value' => ['type' => 'string', 'required' => false, 'description' => 'Filter value paired with filter_variable.'],
            'tag_names' => ['type' => 'string', 'required' => false, 'description' => 'Semicolon-separated tag names to include.'],
            'exclude_tag_names' => ['type' => 'string', 'required' => false, 'description' => 'Semicolon-separated tag names to exclude.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function tagFilters(): array
    {
        return self::withRealtime(self::pagination() + [
            'tag_names' => ['type' => 'string', 'required' => false, 'description' => 'Semicolon-separated tag names.'],
            'exclude_tag_names' => ['type' => 'string', 'required' => false, 'description' => 'Semicolon-separated tag names to exclude.'],
            'tag_group_id' => ['type' => 'string', 'required' => false, 'description' => 'FRED tag group ID, such as freq, gen, geo, geot, rls, seas, src, or cc.'],
            'search_text' => ['type' => 'string', 'required' => false, 'description' => 'Search text for tag names.'],
            'order_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort field such as name, group_id, popularity, series_count, created, or notes.'],
            'sort_order' => self::sortOrder(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private static function sortOrder(): array
    {
        return ['type' => 'string', 'required' => false, 'description' => 'Sort direction.', 'enum' => ['asc', 'desc']];
    }
}
