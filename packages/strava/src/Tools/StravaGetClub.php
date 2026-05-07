<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Strava club.
 */
class StravaGetClub implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_get_club';
    }

    public function description(): string
    {
        return 'Get details about a specific Strava club, including name, description, member count, and sport types.';
    }

    public function parameters(): array
    {
        return [
            'club_id' => ['type' => 'integer', 'required' => true, 'description' => 'The club ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            if (!isset($args['club_id'])) {
                return ToolResult::error('Club ID is required.');
            }

            $result = $this->service->getClub((int) $args['club_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
