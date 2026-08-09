<?php

namespace OpenCompany\Integrations\WorldBank;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankCompareData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankCountries;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankCountryInfo;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankGetData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankIncomeLevels;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankIndicatorInfo;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankIndicators;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankLanguages;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankLendingTypes;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankMultiIndicatorData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankRegions;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankSourceIndicators;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankSources;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankTopics;

/**
 * Exposes World Bank Indicators API v2 resources as agent tools.
 *
 * The integration is public and requires no credentials.
 */
class WorldBankToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'none',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'none',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'worldbank';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'World Bank',
            'description' => 'World Bank development indicators',
            'icon' => 'ph:globe',
            'logo' => 'ph:globe',
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
            'name' => 'World Bank',
            'description' => 'World Bank Indicators API v2 for countries, aggregates, sources, topics, indicators, and development data',
            'icon' => 'ph:globe',
            'logo' => 'ph:globe',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://datahelpdesk.worldbank.org/knowledgebase/topics/125589',
        ];
    }

    public function tools(): array
    {
        return [
            'worldbank_countries' => [
                'class' => WorldBankCountries::class,
                'type' => 'read',
                'name' => 'List Countries',
                'description' => 'List or search countries by name, region, or income level.',
                'icon' => 'ph:globe-hemisphere-west',
            ],
            'worldbank_country_info' => [
                'class' => WorldBankCountryInfo::class,
                'type' => 'read',
                'name' => 'Country Info',
                'description' => 'Get detailed metadata for a specific country or aggregate by ISO code.',
                'icon' => 'ph:flag',
            ],
            'worldbank_regions' => [
                'class' => WorldBankRegions::class,
                'type' => 'read',
                'name' => 'Regions',
                'description' => 'List World Bank region and aggregate codes.',
                'icon' => 'ph:map-trifold',
            ],
            'worldbank_income_levels' => [
                'class' => WorldBankIncomeLevels::class,
                'type' => 'read',
                'name' => 'Income Levels',
                'description' => 'List World Bank income-level codes.',
                'icon' => 'ph:ladder',
            ],
            'worldbank_lending_types' => [
                'class' => WorldBankLendingTypes::class,
                'type' => 'read',
                'name' => 'Lending Types',
                'description' => 'List World Bank lending-type codes.',
                'icon' => 'ph:bank',
            ],
            'worldbank_sources' => [
                'class' => WorldBankSources::class,
                'type' => 'read',
                'name' => 'Sources',
                'description' => 'List World Bank data sources.',
                'icon' => 'ph:database',
            ],
            'worldbank_source_indicators' => [
                'class' => WorldBankSourceIndicators::class,
                'type' => 'read',
                'name' => 'Source Indicators',
                'description' => 'List indicator series available in a specific World Bank source.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'worldbank_indicators' => [
                'class' => WorldBankIndicators::class,
                'type' => 'read',
                'name' => 'Search Indicators',
                'description' => 'Search economic indicators by keyword or list common indicators.',
                'icon' => 'ph:magnifying-glass',
            ],
            'worldbank_indicator_info' => [
                'class' => WorldBankIndicatorInfo::class,
                'type' => 'read',
                'name' => 'Indicator Info',
                'description' => 'Get metadata for one World Bank indicator code.',
                'icon' => 'ph:info',
            ],
            'worldbank_topics' => [
                'class' => WorldBankTopics::class,
                'type' => 'read',
                'name' => 'Topic Categories',
                'description' => 'List topic categories or indicators within a topic.',
                'icon' => 'ph:tag',
            ],
            'worldbank_languages' => [
                'class' => WorldBankLanguages::class,
                'type' => 'read',
                'name' => 'Languages',
                'description' => 'List language codes supported by the World Bank API.',
                'icon' => 'ph:translate',
            ],
            'worldbank_get_data' => [
                'class' => WorldBankGetData::class,
                'type' => 'read',
                'name' => 'Get Indicator Data',
                'description' => 'Fetch indicator data for countries, aggregates, date ranges, and most-recent-value queries.',
                'icon' => 'ph:chart-line-up',
            ],
            'worldbank_multi_indicator_data' => [
                'class' => WorldBankMultiIndicatorData::class,
                'type' => 'read',
                'name' => 'Multi-Indicator Data',
                'description' => 'Fetch multiple indicators from one source in a single World Bank V2 API query.',
                'icon' => 'ph:chart-scatter',
            ],
            'worldbank_compare_data' => [
                'class' => WorldBankCompareData::class,
                'type' => 'read',
                'name' => 'Compare Countries',
                'description' => 'Compare an indicator across multiple countries side by side.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/worldbank.md';
    }

    public function credentialFields(): array
    {
        return [];
    }

    /**
     * Create a tool instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context; public API requires no credentials.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(WorldBankService::class));
    }
}
