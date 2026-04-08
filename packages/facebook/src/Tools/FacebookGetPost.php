<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookGetPost implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_get_post';
    }

    public function description(): string
    {
        return 'Get details for a specific Facebook post by its ID. Returns the post content, creation time, and engagement metrics.';
    }

    public function parameters(): array
    {
        return [
            'post_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Facebook Post ID.',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,message,created_time,attachments,shares,likes.summary(true)"). Defaults to "id,message,created_time,attachments".',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Facebook integration is not configured.');
            }

            if (empty($args['post_id'])) {
                return ToolResult::error('post_id is required.');
            }

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            } else {
                $params['fields'] = 'id,message,created_time,attachments';
            }

            $result = $this->service->getPost($args['post_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
