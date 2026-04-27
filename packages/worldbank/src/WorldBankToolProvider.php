<?php

namespace OpenCompany\Integrations\WorldBank;

use OpenCompany\Integrations\WorldBank\Tools\WorldBankCompareData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankCountries;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankCountryInfo;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankGetData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankIndicators;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankTopics;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
            'setup_flows' =>
            [
              0 => 'none',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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

    public function appMeta(): array
    {
        return [
            'label' => 'economics, GDP, inflation, population, countries, development, poverty',
            'description' => 'World Bank economic indicators',
            'icon' => 'ph:globe',
            'logo' => 'ph:globe',
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
            'worldbank_indicators' => [
                'class' => WorldBankIndicators::class,
                'type' => 'read',
                'name' => 'Search Indicators',
                'description' => 'Search economic indicators by keyword or list common indicators.',
                'icon' => 'ph:magnifying-glass',
            ],
            'worldbank_topics' => [
                'class' => WorldBankTopics::class,
                'type' => 'read',
                'name' => 'Topic Categories',
                'description' => 'List topic categories or indicators within a topic.',
                'icon' => 'ph:tag',
            ],
            'worldbank_country_info' => [
                'class' => WorldBankCountryInfo::class,
                'type' => 'read',
                'name' => 'Country Info',
                'description' => 'Get detailed info for a specific country by ISO code.',
                'icon' => 'ph:flag',
            ],
            'worldbank_get_data' => [
                'class' => WorldBankGetData::class,
                'type' => 'read',
                'name' => 'Get Indicator Data',
                'description' => 'Fetch indicator data for countries — GDP, inflation, population, etc.',
                'icon' => 'ph:chart-line-up',
            ],
            'worldbank_compare_data' => [
                'class' => WorldBankCompareData::class,
                'type' => 'read',
                'name' => 'Compare Countries',
                'description' => 'Compare an indicator across multiple countries side-by-side.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/worldbank.md';
    }    public function credentialFields(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $service = app(WorldBankService::class);

        return new $class($service);
    }
}
