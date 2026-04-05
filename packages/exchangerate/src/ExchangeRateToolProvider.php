<?php

namespace OpenCompany\Integrations\ExchangeRate;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateConvertCurrency;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateHistory;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateRates;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRateListCurrencies;
use OpenCompany\Integrations\ExchangeRate\Tools\ExchangeRatePopularCurrencies;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

class ExchangeRateToolProvider implements ToolProvider
{
    public function appName(): string
    {
        return 'exchangerate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'currency, exchange rate, forex, conversion, USD, EUR, crypto',
            'description' => 'Currency exchange rates',
            'icon' => 'ph:currency-circle-dollar',
            'logo' => 'ph:currency-circle-dollar',
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

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/exchangerate.md';
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
