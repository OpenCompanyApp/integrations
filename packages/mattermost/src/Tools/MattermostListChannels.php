<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List channels the current user belongs to.
 *
 * Returns an array of channel objects including id, name, display_name,
 * type (O = public, P = private, D = direct), team_id, and other metadata.
 */
class MattermostListChannels implements Tool
{
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_list_channels';
    }

    public function description(): string
    {
        return 'List channels the current user belongs to in Mattermost. Returns channel IDs, names, types, and team associations. Use this to discover available channels before posting messages or reading posts.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (0-indexed). Default: 0.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of channels per page. Default: 60.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 60;

            $result = $this->service->listChannels($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
