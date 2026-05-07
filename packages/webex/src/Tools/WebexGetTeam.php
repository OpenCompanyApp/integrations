<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Webex team by ID.
 */
class WebexGetTeam extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_get_team';
    }

    public function description(): string
    {
        return 'Get details for a Webex team by team ID.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        ];
    }

    /**
     * Fetch one team.
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

            return ToolResult::success($this->service->getTeam((string) $args['team_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
