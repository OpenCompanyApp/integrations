<?php

namespace OpenCompany\Integrations\ExchangeRate;

use Illuminate\Support\Facades\Http;

/**
 * HTTP client for the Fawaz Ahmed exchange-api static currency datasets.
 *
 * Uses the documented jsDelivr endpoint first and the Cloudflare Pages mirror as fallback.
 */
class ExchangeRateService
{
    private const PRIMARY_URL = 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@{date}/v1/currencies';

    private const FALLBACK_URL = 'https://{date}.currency-api.pages.dev/v1/currencies';

    /** Popular currencies for quick reference in tool descriptions. */
    public const POPULAR_CURRENCIES = [
        'usd' => 'US Dollar',
        'eur' => 'Euro',
        'gbp' => 'British Pound',
        'jpy' => 'Japanese Yen',
        'cny' => 'Chinese Yuan',
        'chf' => 'Swiss Franc',
        'cad' => 'Canadian Dollar',
        'aud' => 'Australian Dollar',
        'inr' => 'Indian Rupee',
        'krw' => 'South Korean Won',
        'brl' => 'Brazilian Real',
        'mxn' => 'Mexican Peso',
        'btc' => 'Bitcoin',
        'eth' => 'Ethereum',
        'sol' => 'Solana',
        'xrp' => 'XRP',
        'xau' => 'Gold (troy ounce)',
        'xag' => 'Silver (troy ounce)',
        'xpt' => 'Platinum (troy ounce)',
    ];

    /** @return array<string, string> Currency code => name */
    public function getCurrencies(): array
    {
        return $this->get('', 'latest');
    }

    /**
     * Get all exchange rates for a base currency.
     *
     * @return array{date: string, rates: array<string, float>}
     */
    public function getRates(string $base, string $date = 'latest'): array
    {
        $base = strtolower($base);
        $data = $this->get("/{$base}", $date);

        return [
            'date' => $data['date'] ?? $date,
            'rates' => $data[$base] ?? [],
        ];
    }

    /** Get a single exchange rate between two currencies. */
    public function getRate(string $from, string $to, string $date = 'latest'): ?float
    {
        $result = $this->getPairRate($from, $to, $date);

        return $result['rate'];
    }

    /**
     * Get a direct exchange rate between two currencies.
     *
     * Uses the upstream pair endpoint instead of fetching the full base-currency matrix.
     *
     * @return array{from: string, to: string, rate: float|null, date: string}
     */
    public function getPairRate(string $from, string $to, string $date = 'latest'): array
    {
        $from = strtolower($from);
        $to = strtolower($to);
        $data = $this->get("/{$from}/{$to}", $date);

        return [
            'from' => $from,
            'to' => $to,
            'rate' => $data[$to] ?? null,
            'date' => $data['date'] ?? $date,
        ];
    }

    /**
     * Convert an amount from one currency to another.
     *
     * @return array{from: string, to: string, amount: float, rate: float, result: float, date: string}
     */
    public function convert(string $from, string $to, float $amount, string $date = 'latest'): array
    {
        $result = $this->getPairRate($from, $to, $date);
        $from = strtolower($from);
        $to = strtolower($to);
        $rate = $result['rate'];

        if ($rate === null) {
            throw new \RuntimeException("Exchange rate not found for {$from} -> {$to}");
        }

        return [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
            'rate' => $rate,
            'result' => round($amount * $rate, 8),
            'date' => $result['date'],
        ];
    }

    /** @return array<string, mixed> */
    private function get(string $endpoint, string $date = 'latest'): array
    {
        $primaryUrl = str_replace('{date}', $date, self::PRIMARY_URL) . $endpoint . '.json';
        $fallbackUrl = str_replace('{date}', $date, self::FALLBACK_URL) . $endpoint . '.json';

        // Try primary CDN first
        try {
            $response = Http::timeout(10)->get($primaryUrl);

            if ($response->successful()) {
                return $response->json() ?? [];
            }
        } catch (\Exception) {
            // Fall through to fallback
        }

        // Try Cloudflare fallback
        $response = Http::timeout(10)->get($fallbackUrl);

        if (! $response->successful()) {
            throw new \RuntimeException(
                "Exchange rate API error ({$response->status()}): Could not fetch rates."
            );
        }

        return $response->json() ?? [];
    }
}
