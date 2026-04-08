<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_check_location
 *
 * Checks if an IP address is located in a specific country or region.
 * Returns the full geolocation result along with a location_match boolean.
 *
 * Uses the IPstack standard lookup endpoint with location fields.
 */
class IpstackCheckLocation implements Tool
{
    /**
     * @param  IpstackService  $service  The IPstack API service instance.
     */
    public function __construct(
        private IpstackService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'ipstack_check_location';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Check if an IP address is located in a specific country or region. Returns geolocation data with a location match indicator.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'The IP address to check (e.g., "134.201.250.155").'],
            'country_code' => ['type' => 'string', 'required' => false, 'description' => 'ISO 3166-1 alpha-2 country code to match (e.g., "US", "DE", "JP").'],
            'region_code' => ['type' => 'string', 'required' => false, 'description' => 'Region or state code to match (e.g., "CA", "TX").'],
        ];
    }

    /**
     * Execute the location check.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ip'.
     * @return ToolResult The geolocation data with location_match or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IPstack integration is not configured.');
            }

            $ip = $args['ip'] ?? '';
            if (empty($ip)) {
                return ToolResult::error('An IP address is required.');
            }

            $countryCode = $args['country_code'] ?? null;
            $regionCode = $args['region_code'] ?? null;

            if ($countryCode === null && $regionCode === null) {
                return ToolResult::error('At least one of country_code or region_code must be provided.');
            }

            $result = $this->service->checkLocation($ip, $countryCode, $regionCode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
