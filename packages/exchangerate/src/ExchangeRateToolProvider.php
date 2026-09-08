<?php

namespace OpenCompany\Integrations\ExchangeRate;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateConvertCurrency;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateHistory;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateListCurrencies;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRatePairRate;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRatePopularCurrencies;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateRates;

/**
 * Exposes public Fawaz Ahmed exchange-api currency tools.
 *
 * No credentials are required; all rates are fetched from public static JSON datasets.
 */
class ExchangeRateToolProvider implements ToolProvider, HasIntegrationCapabilities
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
        return 'exchangerate';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'ExchangeRate',
            'description' => 'Currency exchange rates',
            'icon' => 'ph:currency-circle-dollar',
            'logo' => 'ph:currency-circle-dollar',
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
            'name' => 'ExchangeRate',
            'description' => 'Public currency exchange rates for fiat, crypto, and metals',
            'icon' => 'ph:currency-circle-dollar',
            'logo' => 'ph:currency-circle-dollar',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/fawazahmed0/exchange-api',
        ];
    }

    public function tools(): array
    {
        return [
            'exchangerate_list_currencies' => [
                'class' => ExchangeRateListCurrencies::class,
                'type' => 'read',
                'name' => 'List Currencies',
                'description' => 'List and search available currencies — fiat, crypto, and precious metals.',
                'icon' => 'ph:magnifying-glass',
            ],
            'exchangerate_popular_currencies' => [
                'class' => ExchangeRatePopularCurrencies::class,
                'type' => 'read',
                'name' => 'Popular Currencies',
                'description' => 'Show the most commonly used currency codes.',
                'icon' => 'ph:star',
            ],
            'exchangerate_convert_currency' => [
                'class' => ExchangeRateConvertCurrency::class,
                'type' => 'read',
                'name' => 'Convert Currency',
                'description' => 'Convert an amount from one currency to another.',
                'icon' => 'ph:arrows-left-right',
            ],
            'exchangerate_pair_rate' => [
                'class' => ExchangeRatePairRate::class,
                'type' => 'read',
                'name' => 'Pair Rate',
                'description' => 'Get the direct exchange rate for one currency pair.',
                'icon' => 'ph:equals',
            ],
            'exchangerate_rates' => [
                'class' => ExchangeRateRates::class,
                'type' => 'read',
                'name' => 'Exchange Rates',
                'description' => 'Get all exchange rates for a base currency.',
                'icon' => 'ph:list-numbers',
            ],
            'exchangerate_history' => [
                'class' => ExchangeRateHistory::class,
                'type' => 'read',
                'name' => 'Rate History',
                'description' => 'Compare a currency pair across multiple dates.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/exchangerate.md';
    }

    public function credentialFields(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $service = app(ExchangeRateService::class);

        return new $class($service);
    }
}
