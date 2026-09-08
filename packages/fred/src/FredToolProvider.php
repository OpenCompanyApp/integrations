<?php

namespace OpenCompany\Integrations\Fred;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fred\Tools\FredCategory;
use OpenCompany\Integrations\Fred\Tools\FredCategoryChildren;
use OpenCompany\Integrations\Fred\Tools\FredCategoryRelated;
use OpenCompany\Integrations\Fred\Tools\FredCategoryRelatedTags;
use OpenCompany\Integrations\Fred\Tools\FredCategorySeries;
use OpenCompany\Integrations\Fred\Tools\FredCategoryTags;
use OpenCompany\Integrations\Fred\Tools\FredRelatedTags;
use OpenCompany\Integrations\Fred\Tools\FredRelease;
use OpenCompany\Integrations\Fred\Tools\FredReleaseDates;
use OpenCompany\Integrations\Fred\Tools\FredReleaseRelatedTags;
use OpenCompany\Integrations\Fred\Tools\FredReleaseSeries;
use OpenCompany\Integrations\Fred\Tools\FredReleaseSources;
use OpenCompany\Integrations\Fred\Tools\FredReleaseTables;
use OpenCompany\Integrations\Fred\Tools\FredReleaseTags;
use OpenCompany\Integrations\Fred\Tools\FredReleases;
use OpenCompany\Integrations\Fred\Tools\FredReleasesDates;
use OpenCompany\Integrations\Fred\Tools\FredSeries;
use OpenCompany\Integrations\Fred\Tools\FredSeriesCategories;
use OpenCompany\Integrations\Fred\Tools\FredSeriesObservations;
use OpenCompany\Integrations\Fred\Tools\FredSeriesRelease;
use OpenCompany\Integrations\Fred\Tools\FredSeriesSearch;
use OpenCompany\Integrations\Fred\Tools\FredSeriesSearchRelatedTags;
use OpenCompany\Integrations\Fred\Tools\FredSeriesSearchTags;
use OpenCompany\Integrations\Fred\Tools\FredSeriesTags;
use OpenCompany\Integrations\Fred\Tools\FredSeriesUpdates;
use OpenCompany\Integrations\Fred\Tools\FredSeriesVintageDates;
use OpenCompany\Integrations\Fred\Tools\FredSource;
use OpenCompany\Integrations\Fred\Tools\FredSourceReleases;
use OpenCompany\Integrations\Fred\Tools\FredSources;
use OpenCompany\Integrations\Fred\Tools\FredTags;
use OpenCompany\Integrations\Fred\Tools\FredTagsSeries;

/**
 * Tool catalog and configuration metadata for FRED.
 *
 * Exposes the documented FRED category, release, series, source, and tag
 * endpoints with API-key based configuration.
 */
class FredToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['FRED requires an API key sent as the api_key query parameter.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'fred';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'FRED',
            'description' => 'Federal Reserve economic data',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'FRED',
            'description' => 'Federal Reserve Economic Data API for categories, releases, series metadata, observations, sources, and tags.',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://fred.stlouisfed.org/docs/api/fred/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'FRED API key', 'hint' => 'Required for all FRED API endpoints.', 'required' => true],
        ];
    }

    /**
     * Verify FRED credentials with a lightweight category request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'FRED API key is required.'];
            }

            $response = Http::acceptJson()
                ->timeout(20)
                ->get('https://api.stlouisfed.org/fred/category', ['api_key' => $apiKey, 'file_type' => 'json']);

            return $response->successful()
                ? ['success' => true, 'message' => 'FRED API key accepted.']
                : ['success' => false, 'error' => 'FRED returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'FRED API key', 'hint' => 'Required for all FRED API endpoints.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'fred_category' => ['class' => FredCategory::class, 'type' => 'read', 'name' => 'Category', 'description' => 'Get a FRED category.', 'icon' => 'ph:folder'],
            'fred_category_children' => ['class' => FredCategoryChildren::class, 'type' => 'read', 'name' => 'Category Children', 'description' => 'Get child categories for a parent category.', 'icon' => 'ph:tree-structure'],
            'fred_category_related' => ['class' => FredCategoryRelated::class, 'type' => 'read', 'name' => 'Category Related', 'description' => 'Get related categories for a category.', 'icon' => 'ph:link'],
            'fred_category_series' => ['class' => FredCategorySeries::class, 'type' => 'read', 'name' => 'Category Series', 'description' => 'Get series in a category.', 'icon' => 'ph:list-magnifying-glass'],
            'fred_category_tags' => ['class' => FredCategoryTags::class, 'type' => 'read', 'name' => 'Category Tags', 'description' => 'Get tags for a category.', 'icon' => 'ph:tag'],
            'fred_category_related_tags' => ['class' => FredCategoryRelatedTags::class, 'type' => 'read', 'name' => 'Category Related Tags', 'description' => 'Get related tags for a category.', 'icon' => 'ph:tags'],
            'fred_releases' => ['class' => FredReleases::class, 'type' => 'read', 'name' => 'Releases', 'description' => 'Get all releases of economic data.', 'icon' => 'ph:calendar'],
            'fred_releases_dates' => ['class' => FredReleasesDates::class, 'type' => 'read', 'name' => 'Releases Dates', 'description' => 'Get release dates for all releases.', 'icon' => 'ph:calendar-dots'],
            'fred_release' => ['class' => FredRelease::class, 'type' => 'read', 'name' => 'Release', 'description' => 'Get one release of economic data.', 'icon' => 'ph:newspaper'],
            'fred_release_dates' => ['class' => FredReleaseDates::class, 'type' => 'read', 'name' => 'Release Dates', 'description' => 'Get release dates for one release.', 'icon' => 'ph:calendar-check'],
            'fred_release_series' => ['class' => FredReleaseSeries::class, 'type' => 'read', 'name' => 'Release Series', 'description' => 'Get series on a release.', 'icon' => 'ph:chart-line'],
            'fred_release_sources' => ['class' => FredReleaseSources::class, 'type' => 'read', 'name' => 'Release Sources', 'description' => 'Get sources for a release.', 'icon' => 'ph:database'],
            'fred_release_tags' => ['class' => FredReleaseTags::class, 'type' => 'read', 'name' => 'Release Tags', 'description' => 'Get tags for a release.', 'icon' => 'ph:tag'],
            'fred_release_related_tags' => ['class' => FredReleaseRelatedTags::class, 'type' => 'read', 'name' => 'Release Related Tags', 'description' => 'Get related tags for a release.', 'icon' => 'ph:tags'],
            'fred_release_tables' => ['class' => FredReleaseTables::class, 'type' => 'read', 'name' => 'Release Tables', 'description' => 'Get release tables for a release.', 'icon' => 'ph:table'],
            'fred_series' => ['class' => FredSeries::class, 'type' => 'read', 'name' => 'Series', 'description' => 'Get an economic data series.', 'icon' => 'ph:chart-line'],
            'fred_series_categories' => ['class' => FredSeriesCategories::class, 'type' => 'read', 'name' => 'Series Categories', 'description' => 'Get categories for a series.', 'icon' => 'ph:folders'],
            'fred_series_observations' => ['class' => FredSeriesObservations::class, 'type' => 'read', 'name' => 'Series Observations', 'description' => 'Get observations for a series.', 'icon' => 'ph:chart-scatter'],
            'fred_series_release' => ['class' => FredSeriesRelease::class, 'type' => 'read', 'name' => 'Series Release', 'description' => 'Get the release for a series.', 'icon' => 'ph:newspaper-clipping'],
            'fred_series_search' => ['class' => FredSeriesSearch::class, 'type' => 'read', 'name' => 'Series Search', 'description' => 'Search economic data series.', 'icon' => 'ph:magnifying-glass'],
            'fred_series_search_tags' => ['class' => FredSeriesSearchTags::class, 'type' => 'read', 'name' => 'Series Search Tags', 'description' => 'Get tags for a series search.', 'icon' => 'ph:tag'],
            'fred_series_search_related_tags' => ['class' => FredSeriesSearchRelatedTags::class, 'type' => 'read', 'name' => 'Series Search Related Tags', 'description' => 'Get related tags for a series search.', 'icon' => 'ph:tags'],
            'fred_series_tags' => ['class' => FredSeriesTags::class, 'type' => 'read', 'name' => 'Series Tags', 'description' => 'Get tags for a series.', 'icon' => 'ph:tag'],
            'fred_series_updates' => ['class' => FredSeriesUpdates::class, 'type' => 'read', 'name' => 'Series Updates', 'description' => 'Get series sorted by latest FRED server updates.', 'icon' => 'ph:clock-clockwise'],
            'fred_series_vintagedates' => ['class' => FredSeriesVintageDates::class, 'type' => 'read', 'name' => 'Series Vintage Dates', 'description' => 'Get vintage dates for a series.', 'icon' => 'ph:clock-counter-clockwise'],
            'fred_sources' => ['class' => FredSources::class, 'type' => 'read', 'name' => 'Sources', 'description' => 'Get all sources of economic data.', 'icon' => 'ph:database'],
            'fred_source' => ['class' => FredSource::class, 'type' => 'read', 'name' => 'Source', 'description' => 'Get one source of economic data.', 'icon' => 'ph:database'],
            'fred_source_releases' => ['class' => FredSourceReleases::class, 'type' => 'read', 'name' => 'Source Releases', 'description' => 'Get releases for a source.', 'icon' => 'ph:list-bullets'],
            'fred_tags' => ['class' => FredTags::class, 'type' => 'read', 'name' => 'Tags', 'description' => 'Get all tags, search tags, or get tags by name.', 'icon' => 'ph:tag'],
            'fred_related_tags' => ['class' => FredRelatedTags::class, 'type' => 'read', 'name' => 'Related Tags', 'description' => 'Get related tags for one or more tags.', 'icon' => 'ph:tags'],
            'fred_tags_series' => ['class' => FredTagsSeries::class, 'type' => 'read', 'name' => 'Tags Series', 'description' => 'Get series matching tags.', 'icon' => 'ph:list-magnifying-glass'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a FRED tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): FredService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FredService(apiKey: $creds->get('fred', 'api_key', '', $account));
        }

        return app(FredService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/fred.md';
    }
}
