<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_lookup_bulk
 *
 * Looks up geolocation data for multiple IP addresses in a single request
 * using the IPstack bulk lookup endpoint. Supports up to 50 IPs at once.
 *
 * Endpoint: GET /{ip1},{ip2}
 */
class IpstackLookupBulk implements Tool
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
        return 'ipstack_lookup_bulk';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Look up geolocation data for multiple IP addresses at once (up to 50). Returns an array of geolocation results.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ips' => ['type' => 'array', 'required' => true, 'description' => 'Array of IPv4 or IPv6 addresses or domains to look up (max 50, e.g., ["134.201.250.155", "72.229.28.185"]).'],
            'fields' => ['type' => 'array', 'required' => false, 'description' => 'Optional response fields, such as ["main", "location", "timezone", "currency", "connection", "security"].'],
            'hostname' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request hostname lookup.'],
            'security' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request the paid security module.'],
            'language' => ['type' => 'string', 'required' => false, 'description' => 'Response language code (e.g., "en", "de", "fr"). Defaults to English.'],
        ];
    }

    /**
     * Execute the bulk IP lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ips'.
     * @return ToolResult The array of geolocation results or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IPstack integration is not configured.');
            }

            $ips = $args['ips'] ?? [];
            if (empty($ips) || !is_array($ips)) {
                return ToolResult::error('An array of IP addresses is required.');
            }

            if (count($ips) > 50) {
                return ToolResult::error('Maximum 50 IP addresses allowed per bulk request.');
            }

            $fields = $args['fields'] ?? [];
            if (is_string($fields)) {
                $fields = array_filter(array_map('trim', explode(',', $fields)));
            }

            $result = $this->service->lookupBulk($ips, $fields, [
                'language' => $args['language'] ?? null,
                'hostname' => $args['hostname'] ?? false,
                'security' => $args['security'] ?? false,
            ]);

            if (empty($result)) {
                return ToolResult::success([
                    'ips' => $ips,
                    'found' => false,
                    'message' => 'No geolocation data found for the provided IP addresses.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
