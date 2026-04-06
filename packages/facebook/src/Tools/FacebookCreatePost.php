<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookCreatePost implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_create_post';
    }

    public function description(): string
    {
        return 'Publish a new post on a Facebook Page. The post will appear on the Page\'s timeline immediately unless scheduled.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Facebook Page ID to publish the post on.',
            ],
            'message' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The text content of the post.',
            ],
            'link' => [
                'type' => 'string',
                'description' => 'A URL to attach to the post (e.g. "https://example.com/article").',
            ],
            'scheduled_publish_time' => [
                'type' => 'string',
                'description' => 'UNIX timestamp to schedule the post for future publication. The post will be saved as a draft until this time.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Facebook integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            if (empty($args['message'])) {
                return ToolResult::error('message is required.');
            }

            $params = [];

            if (isset($args['link'])) {
                $params['link'] = $args['link'];
            }

            if (isset($args['scheduled_publish_time'])) {
                $params['scheduled_publish_time'] = $args['scheduled_publish_time'];
                $params['published'] = 'false';
            }

            $result = $this->service->createPost($args['page_id'], $args['message'], $params);

            $postId = $result['id'] ?? 'unknown';

            return ToolResult::success([
                'id' => $postId,
                'message' => isset($args['scheduled_publish_time'])
                    ? "Post scheduled successfully (ID: {$postId})."
                    : "Post published successfully (ID: {$postId}).",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
