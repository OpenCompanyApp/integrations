<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Webex team.
 */
class WebexUpdateTeam extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_update_team';
    }

    public function description(): string
    {
        return 'Update a Webex team, such as renaming it.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
            'name' => ['type' => 'string', 'description' => 'Team name.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official team fields.'],
        ];
    }

    /**
     * Update a team.
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

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['name']));
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateTeam((string) $args['team_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
