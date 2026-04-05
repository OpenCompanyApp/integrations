<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single PagerDuty service by ID.
 *
 * Returns full service details including status, escalation policy,
 * integrations, teams, and incident counts.
 */
class PagerDutyGetService implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_get_service';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a PagerDuty service by ID.
        Returns full service details including status, escalation policy,
        integrations, teams, and incident counts.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'PagerDuty service ID (e.g., "PIJ90N7").'],
        ];
    }

    /**
     * Retrieve a PagerDuty service by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getService($id);
            $svc = $result['service'] ?? $result;

            return ToolResult::success([
                'id' => $svc['id'] ?? '',
                'name' => $svc['name'] ?? '',
                'status' => $svc['status'] ?? '',
                'description' => $svc['description'] ?? null,
                'created_at' => $svc['created_at'] ?? null,
                'updated_at' => $svc['updated_at'] ?? null,
                'escalation_policy' => [
                    'id' => $svc['escalation_policy']['id'] ?? '',
                    'name' => $svc['escalation_policy']['summary'] ?? '',
                ],
                'teams' => array_map(function (array $t) {
                    return [
                        'id' => $t['id'] ?? '',
                        'name' => $t['summary'] ?? '',
                    ];
                }, $svc['teams'] ?? []),
                'integrations' => array_map(function (array $int) {
                    return [
                        'id' => $int['id'] ?? '',
                        'name' => $int['summary'] ?? '',
                        'type' => $int['type'] ?? '',
                    ];
                }, $svc['integrations'] ?? []),
                'html_url' => $svc['html_url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
