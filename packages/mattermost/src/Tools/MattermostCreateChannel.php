<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a channel in a Mattermost team.
 *
 * Supports open (O), private (P), and direct (D) channel types.
 */
class MattermostCreateChannel implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_create_channel';
    }

    public function description(): string
    {
        return 'Create a channel in a Mattermost team. Supports open (O), private (P), and direct (D) channel types.';
    }

    public function parameters(): array
    {
        return [
            'team_id'      => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team to create the channel in.'],
            'name'         => ['type' => 'string', 'required' => true, 'description' => 'The unique URL-friendly name of the channel (lowercase, no spaces).'],
            'display_name' => ['type' => 'string', 'description' => 'The display name of the channel.'],
            'type'         => ['type' => 'string', 'description' => 'Channel type: "O" for open, "P" for private. Defaults to "O".'],
            'purpose'      => ['type' => 'string', 'description' => 'A brief description of the channel purpose.'],
        ];
    }

    /**
     * Create a channel in a Mattermost team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, name, display_name, type, purpose)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = [
                'team_id' => $teamId,
                'name' => $name,
            ];

            if (isset($args['display_name'])) {
                $data['display_name'] = $args['display_name'];
            }

            if (isset($args['type'])) {
                $data['type'] = $args['type'];
            }

            if (isset($args['purpose'])) {
                $data['purpose'] = $args['purpose'];
            }

            $result = $this->service->createChannel($data);

            return ToolResult::success([
                'ok' => true,
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? $name,
                'display_name' => $result['display_name'] ?? '',
                'type' => $result['type'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
