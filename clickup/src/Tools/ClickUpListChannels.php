<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpListChannels implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_list_channels';
    }

    public function description(): string
    {
        return 'List all chat channels in the ClickUp workspace.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $params = [];
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->getChatChannels($workspaceId, $params);
            $channels = $result['channels'] ?? [];

            if (empty($channels)) {
                return ToolResult::success('No chat channels found.');
            }

            $output = array_map(fn (array $ch) => [
                'id' => $ch['id'] ?? '',
                'name' => $ch['name'] ?? '',
                'type' => $ch['type'] ?? '',
                'member_count' => $ch['member_count'] ?? 0,
            ], $channels);

            $response = ['count' => count($output), 'channels' => $output];
            if (! empty($result['next_cursor'])) {
                $response['next_cursor'] = $result['next_cursor'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
