<?php

namespace OpenCompany\Integrations\RestCountries;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAll;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAlpha;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAlphaCodes;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesCapital;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesCurrency;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesDemonym;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesIndependent;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesLanguage;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesName;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesRegion;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesSubregion;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesTranslation;

/**
 * Tool catalog and metadata for REST Countries.
 *
 * Exposes the current v3.1 public lookup endpoints with optional field
 * filtering for compact agent-facing responses.
 */
class RestCountriesToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['REST Countries v3.1 is public and requires no API key.'],
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
        return 'rest-countries';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'REST Countries',
            'description' => 'Country names, codes, regions, currencies, languages, flags, and geography data',
            'icon' => 'ph:globe-hemisphere-west',
            'logo' => 'ph:globe-hemisphere-west',
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
            'name' => 'REST Countries',
            'description' => 'REST Countries v3.1 API for country lookup by name, code, currency, language, capital, region, subregion, demonym, translation, and independence status.',
            'icon' => 'ph:globe-hemisphere-west',
            'logo' => 'ph:globe-hemisphere-west',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://restcountries.com/',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'rest_countries_all' => ['class' => RestCountriesAll::class, 'type' => 'read', 'name' => 'All Countries', 'description' => 'Retrieve all countries with selected fields.', 'icon' => 'ph:globe'],
            'rest_countries_name' => ['class' => RestCountriesName::class, 'type' => 'read', 'name' => 'By Name', 'description' => 'Search countries by common or official name.', 'icon' => 'ph:text-aa'],
            'rest_countries_alpha' => ['class' => RestCountriesAlpha::class, 'type' => 'read', 'name' => 'By Code', 'description' => 'Retrieve one country by alpha, numeric, or IOC code.', 'icon' => 'ph:hash'],
            'rest_countries_alpha_codes' => ['class' => RestCountriesAlphaCodes::class, 'type' => 'read', 'name' => 'By Codes', 'description' => 'Retrieve multiple countries by code list.', 'icon' => 'ph:list-numbers'],
            'rest_countries_currency' => ['class' => RestCountriesCurrency::class, 'type' => 'read', 'name' => 'By Currency', 'description' => 'Search countries by currency code or name.', 'icon' => 'ph:currency-dollar'],
            'rest_countries_language' => ['class' => RestCountriesLanguage::class, 'type' => 'read', 'name' => 'By Language', 'description' => 'Search countries by language code or name.', 'icon' => 'ph:translate'],
            'rest_countries_capital' => ['class' => RestCountriesCapital::class, 'type' => 'read', 'name' => 'By Capital', 'description' => 'Search countries by capital city.', 'icon' => 'ph:buildings'],
            'rest_countries_region' => ['class' => RestCountriesRegion::class, 'type' => 'read', 'name' => 'By Region', 'description' => 'Filter countries by region.', 'icon' => 'ph:map-trifold'],
            'rest_countries_subregion' => ['class' => RestCountriesSubregion::class, 'type' => 'read', 'name' => 'By Subregion', 'description' => 'Filter countries by subregion.', 'icon' => 'ph:map-pin-area'],
            'rest_countries_demonym' => ['class' => RestCountriesDemonym::class, 'type' => 'read', 'name' => 'By Demonym', 'description' => 'Search countries by demonym.', 'icon' => 'ph:users'],
            'rest_countries_translation' => ['class' => RestCountriesTranslation::class, 'type' => 'read', 'name' => 'By Translation', 'description' => 'Search countries by translated country name.', 'icon' => 'ph:language'],
            'rest_countries_independent' => ['class' => RestCountriesIndependent::class, 'type' => 'read', 'name' => 'Independent', 'description' => 'List independent or non-independent countries.', 'icon' => 'ph:flag'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a REST Countries tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(RestCountriesService::class));
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/rest-countries.md';
    }
}
