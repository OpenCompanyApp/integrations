<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch detailed World Bank country metadata.
 */
class WorldBankCountryInfo implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_country_info';
    }

    public function description(): string
    {
        return 'Get detailed information for a specific country by ISO code, including region, income level, lending type, capital city, and coordinates.';
    }

    public function parameters(): array
    {
        return [
            'code' => ['type' => 'string', 'required' => true, 'description' => 'ISO country code (e.g. "US", "CN", "DE").'],
        ];
    }

    /**
     * Get country metadata by code.
     *
     * @param  array<string, mixed>  $args  Tool arguments (code).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $code = $args['code'] ?? null;
            if (! $code) {
                return ToolResult::error('code is required — provide an ISO country code (e.g. "US", "CN", "DE").');
            }

            $result = $this->service->getCountry(strtoupper($code));
            $countries = $result['data'] ?? [];

            if (empty($countries)) {
                return ToolResult::error("No country found for code: {$code}");
            }

            $c = $countries[0];

            return ToolResult::success([
                'id' => $c['id'] ?? null,
                'iso2Code' => $c['iso2Code'] ?? null,
                'name' => $c['name'] ?? null,
                'region' => $c['region']['value'] ?? null,
                'incomeLevel' => $c['incomeLevel']['value'] ?? null,
                'lendingType' => $c['lendingType']['value'] ?? null,
                'capitalCity' => $c['capitalCity'] ?? null,
                'longitude' => $c['longitude'] ?? null,
                'latitude' => $c['latitude'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
