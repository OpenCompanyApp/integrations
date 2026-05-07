<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_lookup_ip
 *
 * Looks up geolocation data for a single IPv4 or IPv6 address using the
 * IPstack standard lookup endpoint. Returns country, region, city,
 * latitude/longitude, and other location data.
 *
 * Endpoint: GET /{ip}
 */
class IpstackLookupIp implements Tool
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
        return 'ipstack_lookup_ip';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Look up geolocation data for a single IP address using IPstack. Returns country, region, city, coordinates, and more.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'The IPv4 or IPv6 address or domain to look up (e.g., "134.201.250.155").'],
            'fields' => ['type' => 'array', 'required' => false, 'description' => 'Optional response fields, such as ["main", "location", "timezone", "currency", "connection", "security"].'],
            'hostname' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request hostname lookup.'],
            'security' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request the paid security module.'],
            'language' => ['type' => 'string', 'required' => false, 'description' => 'Response language code (e.g., "en", "de", "fr"). Defaults to English.'],
        ];
    }

    /**
     * Execute the IP lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ip'.
     * @return ToolResult The geolocation data or an error message.
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

            $fields = $args['fields'] ?? [];
            if (is_string($fields)) {
                $fields = array_filter(array_map('trim', explode(',', $fields)));
            }

            $result = $this->service->lookupIp($ip, $fields, [
                'language' => $args['language'] ?? null,
                'hostname' => $args['hostname'] ?? false,
                'security' => $args['security'] ?? false,
            ]);

            if (empty($result)) {
                return ToolResult::success([
                    'ip' => $ip,
                    'found' => false,
                    'message' => 'No geolocation data found for this IP address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
