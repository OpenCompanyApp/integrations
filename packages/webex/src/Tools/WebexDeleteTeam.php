<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex team.
 */
class WebexDeleteTeam extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_team';
    }

    public function description(): string
    {
        return 'Delete a Webex team by team ID.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        ];
    }

    /**
     * Delete a team.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['team_id'])) {
                return ToolResult::error('team_id is required.');
            }

            return ToolResult::success($this->service->deleteTeam((string) $args['team_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
