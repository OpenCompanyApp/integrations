<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a DNS record in a Cloudflare zone.
 *
 * Shapes common DNS record arguments into Cloudflare's DNS record create body.
 */
class CloudflareCreateDnsRecord implements Tool
{
    /**
     * @param  CloudflareService  $service  Cloudflare API client.
     */
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_create_dns_record';
    }

    public function description(): string
    {
        return 'Create a new DNS record in a Cloudflare zone. Supports A, AAAA, CNAME, MX, TXT, NS, SRV, and other record types.';
    }

    public function parameters(): array
    {
        return [
            'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'The zone identifier.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'DNS record type: A, AAAA, CNAME, MX, TXT, NS, SRV, etc.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'DNS record name (e.g., "www.example.com" or "@" for the zone root).'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'DNS record content (e.g., "192.0.2.1" for an A record).'],
            'ttl' => ['type' => 'integer', 'description' => 'Time to live in seconds. Use 1 for automatic ("Auto" TTL). Default: 1.'],
            'proxied' => ['type' => 'boolean', 'description' => 'Whether the record is proxied through Cloudflare (orange cloud). Default: false.'],
        ];
    }

    /**
     * Create a DNS record.
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

            $required = ['type', 'name', 'content'];
            foreach ($required as $field) {
                if (empty($args[$field])) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            $data = [
                'type' => strtoupper($args['type']),
                'name' => $args['name'],
                'content' => $args['content'],
                'ttl' => isset($args['ttl']) ? (int) $args['ttl'] : 1,
                'proxied' => isset($args['proxied']) ? (bool) $args['proxied'] : false,
            ];

            $result = $this->service->createDnsRecord($zoneId, $data);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['code'] ?? 0) . ': ' . ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $record = $result['result'] ?? [];

            return ToolResult::success([
                'id' => $record['id'] ?? null,
                'type' => $record['type'] ?? null,
                'name' => $record['name'] ?? null,
                'content' => $record['content'] ?? null,
                'ttl' => $record['ttl'] ?? null,
                'proxied' => $record['proxied'] ?? false,
                'message' => "DNS {$data['type']} record for {$data['name']} created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
