<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ipstack\IpstackService;

/**
 * Look up geolocation data for the requesting IP address.
 *
 * Wraps the official IPstack requester lookup endpoint at /check.
 */
class IpstackLookupRequester implements Tool
{
    /**
     * @param  IpstackService  $service  The IPstack API service instance.
     */
    public function __construct(
        private IpstackService $service,
    ) {}

    public function name(): string
    {
        return 'ipstack_lookup_requester';
    }

    public function description(): string
    {
        return 'Detect and geolocate the IP address making the API request using the official IPstack /check endpoint.';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'array', 'required' => false, 'description' => 'Optional response fields, such as ["main", "location", "timezone", "currency", "connection", "security"].'],
            'hostname' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request hostname lookup.'],
            'security' => ['type' => 'boolean', 'required' => false, 'description' => 'Set true to request the paid security module.'],
            'language' => ['type' => 'string', 'required' => false, 'description' => 'Response language code (e.g., "en", "de", "fr"). Defaults to English.'],
        ];
    }

    /**
     * Execute the requester IP lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments (fields, language, hostname, security).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IPstack integration is not configured.');
            }

            $fields = $args['fields'] ?? [];
            if (is_string($fields)) {
                $fields = array_filter(array_map('trim', explode(',', $fields)));
            }

            return ToolResult::success($this->service->lookupRequester($fields, [
                'language' => $args['language'] ?? null,
                'hostname' => $args['hostname'] ?? false,
                'security' => $args['security'] ?? false,
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
