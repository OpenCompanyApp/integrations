<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Compare a currency pair across multiple historical dates.
 */
class ExchangeRateHistory implements Tool
{
    /**
     * @param  ExchangeRateService  $service  The exchange-rate API client.
     */
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function name(): string
    {
        return 'exchangerate_history';
    }

    public function description(): string
    {
        return 'Compare a currency pair across multiple dates to see rate changes over time. Returns each date\'s rate and the overall change.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Source currency code (e.g. "usd", "btc", "xau").'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Target currency code (e.g. "eur", "jpy").'],
            'dates' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated dates to compare (e.g. "2026-01-01,2026-02-01,2026-02-20").'],
        ];
    }

    /**
     * Fetch rate history for a comma-separated date list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from, to, dates).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $from = $args['from'] ?? null;
            $to = $args['to'] ?? null;

            if (! $from || ! $to) {
                return ToolResult::error('Both "from" and "to" currency codes are required for history.');
            }

            $dates = $args['dates'] ?? null;
            if (! $dates) {
                return ToolResult::error('dates is required — comma-separated dates (e.g. "2026-01-01,2026-02-01,2026-02-20").');
            }

            $dateList = array_map('trim', explode(',', $dates));
            $from = strtolower($from);
            $to = strtolower($to);

            $history = [];
            foreach ($dateList as $date) {
                try {
                    $rate = $this->service->getRate($from, $to, $date);
                    $history[] = [
                        'date' => $date,
                        'rate' => $rate,
                    ];
                } catch (\Throwable $e) {
                    $history[] = [
                        'date' => $date,
                        'rate' => null,
                        'error' => $e->getMessage(),
                    ];
                }
            }

            $validRates = array_filter(array_column($history, 'rate'));
            $change = null;
            if (count($validRates) >= 2) {
                $first = reset($validRates);
                $last = end($validRates);
                $change = [
                    'absolute' => round($last - $first, 8),
                    'percentage' => $first > 0 ? round((($last - $first) / $first) * 100, 4) : null,
                ];
            }

            return ToolResult::success([
                'from' => $from,
                'to' => $to,
                'history' => $history,
                'change' => $change,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
