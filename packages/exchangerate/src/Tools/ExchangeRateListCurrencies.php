<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ExchangeRateListCurrencies implements Tool
{
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function name(): string
    {
        return 'exchangerate_list_currencies';
    }

    public function description(): string
    {
        return 'List all available currencies (fiat, crypto, precious metals, stablecoins). Supports 340+ assets. Optionally filter by name or code.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Filter currencies by code or name (e.g. "dollar", "btc", "gold").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $currencies = $this->service->getCurrencies();
            $query = $args['query'] ?? null;

            if ($query) {
                $query = mb_strtolower($query);
                $currencies = array_filter($currencies, function (string $name, string $code) use ($query) {
                    return str_contains($code, $query)
                        || str_contains(mb_strtolower($name), $query);
                }, ARRAY_FILTER_USE_BOTH);
            }

            // Limit output
            $total = count($currencies);
            $currencies = array_slice($currencies, 0, 50, true);

            $items = array_map(fn (string $name, string $code) => [
                'code' => $code,
                'name' => $name,
            ], $currencies, array_keys($currencies));

            return ToolResult::success([
                'total' => $total,
                'showing' => count($items),
                'currencies' => array_values($items),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
