<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Mattermost post by ID.
 */
class MattermostGetPost implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_post';
    }

    public function description(): string
    {
        return 'Get a Mattermost post by its ID.';
    }

    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the post to retrieve.'],
        ];
    }

    /**
     * Get a Mattermost post by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (post_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $postId = $args['post_id'] ?? '';

            if (empty($postId)) {
                return ToolResult::error('post_id is required.');
            }

            $result = $this->service->getPost($postId);

            return ToolResult::success([
                'ok' => true,
                'post' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
