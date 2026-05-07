<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Webex team memberships.
 */
class WebexListTeamMemberships extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_team_memberships';
    }

    public function description(): string
    {
        return 'List Webex team memberships by team, person, email, or pagination filters.';
    }

    public function parameters(): array
    {
        return [
            'teamId' => ['type' => 'string', 'description' => 'Filter by team ID.'],
            'personId' => ['type' => 'string', 'description' => 'Filter by person ID.'],
            'personEmail' => ['type' => 'string', 'description' => 'Filter by person email.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum results to return.'],
        ];
    }

    /**
     * Fetch team memberships.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listTeamMemberships($this->only($args, ['teamId', 'personId', 'personEmail', 'max'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
