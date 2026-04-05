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

class WorldBankToolProvider implements ToolProvider
{
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
        return null;
    }

    public function credentialFields(): array
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
