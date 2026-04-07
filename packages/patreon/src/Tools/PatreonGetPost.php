<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonGetPost implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_get_post';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Patreon post by its ID. Returns full post data including title, content, publish date, and tier access.';
    }

    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the post to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Patreon integration is not configured.');
            }

            if (empty($args['post_id'])) {
                return ToolResult::error('post_id is required.');
            }

            $result = $this->service->getPost($args['post_id']);

            $post = $result['data'] ?? $result;

            return ToolResult::success($post);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
