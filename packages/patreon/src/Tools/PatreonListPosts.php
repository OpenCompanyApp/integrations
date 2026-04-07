<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonListPosts implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_list_posts';
    }

    public function description(): string
    {
        return 'List posts for a Patreon campaign. Returns post IDs, titles, publication dates, and content metadata.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the campaign to list posts for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Patreon integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $result = $this->service->listPosts($args['campaign_id']);

            $posts = $result['data'] ?? [];

            return ToolResult::success([
                'posts' => $posts,
                'totalCount' => count($posts),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
