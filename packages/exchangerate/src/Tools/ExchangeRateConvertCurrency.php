<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ExchangeRateConvertCurrency implements Tool
{
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function name(): string
    {
        return 'exchangerate_convert_currency';
    }

    public function description(): string
    {
        return 'Convert an amount from one currency to another. Supports 340 fiat currencies, cryptocurrencies, and precious metals. Common codes: usd, eur, gbp, jpy, cny, chf, cad, aud, btc, eth, sol, xau, xag.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Source currency code (e.g. "usd", "btc", "xau").'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Target currency code (e.g. "eur", "jpy").'],
            'amount' => ['type' => 'string', 'description' => 'Amount to convert (default: "1").'],
            'date' => ['type' => 'string', 'description' => 'Date for the rate (default: "latest"). Format: "YYYY-MM-DD" or "latest".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $from = $args['from'] ?? null;
            $to = $args['to'] ?? null;

            if (! $from || ! $to) {
                return ToolResult::error('Both "from" and "to" currency codes are required (e.g. from: "usd", to: "eur").');
            }

            $amount = (float) ($args['amount'] ?? 1);
            $date = $args['date'] ?? 'latest';

            $result = $this->service->convert($from, $to, $amount, $date);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
