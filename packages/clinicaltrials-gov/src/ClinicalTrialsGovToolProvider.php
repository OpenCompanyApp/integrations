<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovEnums;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFetchStudy;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFieldSizesStats;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFieldValuesStats;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovListStudies;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovMetadata;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovSearchAreas;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovSizeStats;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovVersion;

/**
 * Tool catalog and metadata for ClinicalTrials.gov.
 *
 * Exposes all current public API v2 endpoints for study search, study retrieval,
 * metadata, search areas, enums, statistics, and version checks.
 */
class ClinicalTrialsGovToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['ClinicalTrials.gov API v2 is public and requires no credentials. Check the version endpoint for dataTimestamp freshness.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'clinicaltrials-gov';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'ClinicalTrials.gov',
            'description' => 'Clinical study search, records, metadata, enums, statistics, and data version',
            'icon' => 'ph:first-aid',
            'logo' => 'ph:first-aid',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ClinicalTrials.gov',
            'description' => 'Public ClinicalTrials.gov REST API v2 for searching studies, retrieving individual study records, inspecting metadata/search areas/enums, reading statistics, and checking data versions.',
            'icon' => 'ph:first-aid',
            'logo' => 'ph:first-aid',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://clinicaltrials.gov/data-about-studies/learn-about-api',
        ];
    }

    public function tools(): array
    {
        return [
            'clinicaltrials_gov_list_studies' => ['class' => ClinicalTrialsGovListStudies::class, 'type' => 'read', 'name' => 'List Studies', 'description' => 'Search or list ClinicalTrials.gov studies with API v2 query and filter parameters.', 'icon' => 'ph:magnifying-glass'],
            'clinicaltrials_gov_fetch_study' => ['class' => ClinicalTrialsGovFetchStudy::class, 'type' => 'read', 'name' => 'Fetch Study', 'description' => 'Fetch a single study by NCT ID.', 'icon' => 'ph:article'],
            'clinicaltrials_gov_metadata' => ['class' => ClinicalTrialsGovMetadata::class, 'type' => 'read', 'name' => 'Metadata', 'description' => 'Retrieve the study data model field tree.', 'icon' => 'ph:tree-structure'],
            'clinicaltrials_gov_search_areas' => ['class' => ClinicalTrialsGovSearchAreas::class, 'type' => 'read', 'name' => 'Search Areas', 'description' => 'Retrieve search documents and search areas.', 'icon' => 'ph:list-magnifying-glass'],
            'clinicaltrials_gov_enums' => ['class' => ClinicalTrialsGovEnums::class, 'type' => 'read', 'name' => 'Enums', 'description' => 'Retrieve enum types and values used in study records.', 'icon' => 'ph:list-checks'],
            'clinicaltrials_gov_size_stats' => ['class' => ClinicalTrialsGovSizeStats::class, 'type' => 'read', 'name' => 'Size Stats', 'description' => 'Retrieve study JSON size statistics.', 'icon' => 'ph:chart-bar'],
            'clinicaltrials_gov_field_values_stats' => ['class' => ClinicalTrialsGovFieldValuesStats::class, 'type' => 'read', 'name' => 'Field Values Stats', 'description' => 'Retrieve value statistics for study leaf fields.', 'icon' => 'ph:chart-pie'],
            'clinicaltrials_gov_field_sizes_stats' => ['class' => ClinicalTrialsGovFieldSizesStats::class, 'type' => 'read', 'name' => 'Field Sizes Stats', 'description' => 'Retrieve size statistics for list and array fields.', 'icon' => 'ph:chart-donut'],
            'clinicaltrials_gov_version' => ['class' => ClinicalTrialsGovVersion::class, 'type' => 'read', 'name' => 'Version', 'description' => 'Retrieve API and data version timestamps.', 'icon' => 'ph:clock'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [];
    }

    /**
     * Create a ClinicalTrials.gov tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(ClinicalTrialsGovService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/clinicaltrials-gov.md';
    }
}
