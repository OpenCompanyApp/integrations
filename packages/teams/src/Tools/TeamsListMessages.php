<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List messages in a Microsoft Teams channel.
 *
 * Supports pagination via top and skip parameters.
 */
class TeamsListMessages implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a Microsoft Teams channel.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team.'],
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel.'],
            'top' => ['type' => 'integer', 'description' => 'Number of messages to return (default 20, max 50).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of messages to skip for pagination.'],
        ];
    }

    /**
     * List messages in a channel with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, channel_id, top, skip)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            $channelId = $args['channel_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }
            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $params = [];

            if (isset($args['top'])) {
                $params['$top'] = (int) $args['top'];
            }
            if (isset($args['skip'])) {
                $params['$skip'] = (int) $args['skip'];
            }

            $result = $this->service->listMessages($teamId, $channelId, $params);

            return ToolResult::success([
                'ok' => true,
                'messages' => $result['value'] ?? [],
                '@odata.nextLink' => $result['@odata.nextLink'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
