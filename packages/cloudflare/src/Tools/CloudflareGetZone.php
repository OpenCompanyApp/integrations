<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Cloudflare zone.
 *
 * Returns compact zone metadata for one zone identifier.
 */
class CloudflareGetZone implements Tool
{
    /**
     * @param  CloudflareService  $service  Cloudflare API client.
     */
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_get_zone';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Cloudflare zone, including its ID, name, status, nameservers, and plan.';
    }

    public function parameters(): array
    {
        return [
            'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'The zone identifier (e.g., "023e105f4ecef8ad9ca31a8372d0c353").'],
        ];
    }

    /**
     * Fetch a zone by identifier.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudflare integration is not configured.');
            }

            $zoneId = $args['zone_id'] ?? '';
            if (empty($zoneId)) {
                return ToolResult::error('zone_id is required.');
            }

            $result = $this->service->getZone($zoneId);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $zone = $result['result'] ?? [];

            return ToolResult::success([
                'id' => $zone['id'] ?? null,
                'name' => $zone['name'] ?? null,
                'status' => $zone['status'] ?? null,
                'paused' => $zone['paused'] ?? false,
                'type' => $zone['type'] ?? null,
                'development_mode' => $zone['development_mode'] ?? 0,
                'nameservers' => $zone['name_servers'] ?? [],
                'original_nameservers' => $zone['original_name_servers'] ?? [],
                'plan' => $zone['plan']['name'] ?? null,
                'created_on' => $zone['created_on'] ?? null,
                'modified_on' => $zone['modified_on'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
