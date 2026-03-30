<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ExchangeRatePopularCurrencies implements Tool
{
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function description(): string
    {
        $popular = collect(ExchangeRateService::POPULAR_CURRENCIES)
            ->map(fn (string $name, string $code) => "  - `{$code}` — {$name}")
            ->implode("\n");

        return <<<MD
        Show the most commonly used currency codes (no API call needed). Use these codes directly with exchangerate_convert_currency.

        Popular codes:
        {$popular}
        MD;
    }

    public function name(): string
    {
        return 'exchangerate_popular_currencies';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        $items = array_map(fn (string $name, string $code) => [
            'code' => $code,
            'name' => $name,
        ], ExchangeRateService::POPULAR_CURRENCIES, array_keys(ExchangeRateService::POPULAR_CURRENCIES));

        return ToolResult::success([
            'currencies' => array_values($items),
        ]);
    }
}
