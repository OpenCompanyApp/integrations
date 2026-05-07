<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Revolut\RevolutService;

/**
 * List Revolut Business team members.
 *
 * Supports Revolut's time-based pagination fields.
 */
class RevolutListTeamMembers implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut Business API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_list_team_members';
    }

    public function description(): string
    {
        return <<<'MD'
        List Revolut Business team members.
        Use limit and created_before for pagination; Revolut returns members in reverse creation order.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of team members to return per page. Revolut allows 1-1000.'],
            'created_before' => ['type' => 'string', 'description' => 'Return team members created before this ISO 8601 date/time for pagination.'],
        ];
    }

    /**
     * List Revolut Business team members.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, created_before)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = max(1, min(1000, (int) $args['limit']));
            }
            if (isset($args['created_before'])) {
                $params['created_before'] = $args['created_before'];
            }

            $members = $this->service->listTeamMembers($params);

            return ToolResult::success([
                'team_members' => is_array($members) ? $members : [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
