<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single PagerDuty user by ID.
 *
 * Returns full user details including name, email, role, job title,
 * team memberships, and contact methods.
 */
class PagerDutyGetUser implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_get_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a PagerDuty user by ID.
        Returns full user details including name, email, role, job title,
        teams, and contact methods.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'PagerDuty user ID (e.g., "PXPGF42").'],
        ];
    }

    /**
     * Retrieve a PagerDuty user by ID with full details.
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

            $result = $this->service->getUser($id);
            $user = $result['user'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'name' => $user['name'] ?? '',
                'email' => $user['email'] ?? '',
                'role' => $user['role'] ?? '',
                'title' => $user['job_title'] ?? null,
                'description' => $user['description'] ?? null,
                'time_zone' => $user['time_zone'] ?? null,
                'teams' => array_map(function (array $t) {
                    return [
                        'id' => $t['id'] ?? '',
                        'name' => $t['summary'] ?? '',
                    ];
                }, $user['teams'] ?? []),
                'contact_methods' => array_map(function (array $cm) {
                    return [
                        'id' => $cm['id'] ?? '',
                        'type' => $cm['type'] ?? '',
                        'label' => $cm['summary'] ?? '',
                    ];
                }, $user['contact_methods'] ?? []),
                'avatar_url' => $user['avatar_url'] ?? null,
                'html_url' => $user['html_url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
