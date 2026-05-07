<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List members of a Strava club.
 */
class StravaListClubMembers extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_list_club_members';
    }

    public function description(): string
    {
        return 'List athletes who are members of a Strava club.';
    }

    public function parameters(): array
    {
        return [
            'club_id' => ['type' => 'integer', 'required' => true, 'description' => 'Club ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        ];
    }

    /**
     * List club members.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['club_id'])) {
                return ToolResult::error('club_id is required.');
            }

            return ToolResult::success($this->service->listClubMembers(
                (int) $args['club_id'],
                isset($args['page']) ? (int) $args['page'] : 1,
                isset($args['per_page']) ? (int) $args['per_page'] : 30,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
