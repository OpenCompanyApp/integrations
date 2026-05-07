<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List page rules in a Cloudflare zone.
 *
 * Returns compact metadata for legacy Cloudflare page rules.
 */
class CloudflareListPageRules implements Tool
{
    /**
     * @param  CloudflareService  $service  Cloudflare API client.
     */
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_list_page_rules';
    }

    public function description(): string
    {
        return 'List page rules for a Cloudflare zone. Returns rule IDs, targets, actions, and priority.';
    }

    public function parameters(): array
    {
        return [
            'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'The zone identifier.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, disabled.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of rules per page (default: 20).'],
        ];
    }

    /**
     * List page rules for a zone.
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
            foreach (['status', 'page', 'per_page'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $key === 'page' || $key === 'per_page' ? (int) $args[$key] : $args[$key];
                }
            }

            $result = $this->service->listPageRules($zoneId, $params);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $rules = $result['result'] ?? [];
            $summary = array_map(function (array $rule): array {
                $targets = array_map(fn (array $t) => $t['target'] ?? null . ': ' . ($t['constraint']['operator'] ?? '') . ' ' . ($t['constraint']['value'] ?? ''), $rule['targets'] ?? []);

                $actions = array_map(function (array $a): string {
                    $value = $a['value'] ?? '';
                    if (is_array($value)) {
                        $value = json_encode($value);
                    }
                    return ($a['id'] ?? 'unknown') . ': ' . $value;
                }, $rule['actions'] ?? []);

                return [
                    'id' => $rule['id'] ?? null,
                    'priority' => $rule['priority'] ?? null,
                    'status' => $rule['status'] ?? null,
                    'targets' => $rule['targets'] ?? [],
                    'actions' => $rule['actions'] ?? [],
                ];
            }, $rules);

            return ToolResult::success([
                'rules' => $summary,
                'total' => $result['result_info']['total_count'] ?? count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
