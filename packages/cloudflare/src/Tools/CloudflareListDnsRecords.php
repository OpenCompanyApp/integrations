<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List DNS records in a Cloudflare zone.
 *
 * Applies common DNS record filters and returns compact record summaries.
 */
class CloudflareListDnsRecords implements Tool
{
    /**
     * @param  CloudflareService  $service  Cloudflare API client.
     */
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_list_dns_records';
    }

    public function description(): string
    {
        return 'List DNS records for a Cloudflare zone. Returns record IDs, types, names, content, TTL, and proxy status.';
    }

    public function parameters(): array
    {
        return [
            'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'The zone identifier.'],
            'type' => ['type' => 'string', 'description' => 'Filter by record type: A, AAAA, CNAME, MX, TXT, NS, SRV, etc.'],
            'name' => ['type' => 'string', 'description' => 'Filter by record name (e.g., "www.example.com").'],
            'content' => ['type' => 'string', 'description' => 'Filter by record content (e.g., an IP address).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page (default: 20, max: 100).'],
        ];
    }

    /**
     * List DNS records for a zone.
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

            $params = [];
            foreach (['type', 'name', 'content', 'page', 'per_page'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $key === 'page' || $key === 'per_page' ? (int) $args[$key] : $args[$key];
                }
            }

            $result = $this->service->listDnsRecords($zoneId, $params);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $records = $result['result'] ?? [];
            $summary = array_map(function (array $record): array {
                return [
                    'id' => $record['id'] ?? null,
                    'type' => $record['type'] ?? null,
                    'name' => $record['name'] ?? null,
                    'content' => $record['content'] ?? null,
                    'ttl' => $record['ttl'] ?? null,
                    'proxied' => $record['proxied'] ?? false,
                    'locked' => $record['locked'] ?? false,
                ];
            }, $records);

            return ToolResult::success([
                'records' => $summary,
                'total' => $result['result_info']['total_count'] ?? count($summary),
                'page' => $result['result_info']['page'] ?? 1,
                'per_page' => $result['result_info']['per_page'] ?? count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
