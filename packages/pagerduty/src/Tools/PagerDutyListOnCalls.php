<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List current PagerDuty on-call entries.
 *
 * Returns who is currently on call, organized by escalation policy
 * and escalation level. Supports filtering by escalation policy IDs.
 */
class PagerDutyListOnCalls implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_list_on_calls';
    }

    public function description(): string
    {
        return <<<'MD'
        List current PagerDuty on-call entries.
        Returns who is currently on call, including user, escalation policy,
        escalation level, and schedule.
        Supports filtering by escalation policy IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of on-call entries to return (1–100, default 25).'],
            'escalation_policy_ids' => ['type' => 'array', 'description' => 'Filter by escalation policy IDs (array of escalation policy ID strings).'],
        ];
    }

    /**
     * List current PagerDuty on-call entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, escalation_policy_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['escalation_policy_ids']) && is_array($args['escalation_policy_ids'])) {
                foreach ($args['escalation_policy_ids'] as $i => $policyId) {
                    $params["escalation_policy_ids[]"][$i] = $policyId;
                }
            }

            $result = $this->service->listOnCalls($params);

            $onCalls = array_map(function (array $oc) {
                return [
                    'id' => $oc['id'] ?? '',
                    'escalation_level' => $oc['escalation_level'] ?? null,
                    'user' => [
                        'id' => $oc['user']['id'] ?? '',
                        'name' => $oc['user']['summary'] ?? '',
                        'email' => $oc['user']['email'] ?? null,
                    ],
                    'escalation_policy' => [
                        'id' => $oc['escalation_policy']['id'] ?? '',
                        'name' => $oc['escalation_policy']['summary'] ?? '',
                    ],
                    'schedule' => [
                        'id' => $oc['schedule']['id'] ?? '',
                        'name' => $oc['schedule']['summary'] ?? '',
                    ],
                    'start' => $oc['start'] ?? null,
                    'end' => $oc['end'] ?? null,
                ];
            }, $result['oncalls'] ?? []);

            return ToolResult::success([
                'on_calls' => $onCalls,
                'total' => $result['total'] ?? count($onCalls),
                'more' => $result['more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
