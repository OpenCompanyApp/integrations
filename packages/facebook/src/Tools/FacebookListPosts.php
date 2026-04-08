<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookListPosts implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_list_posts';
    }

    public function description(): string
    {
        return 'List posts published by a Facebook Page. Returns post IDs, messages, creation times, and engagement metrics.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Facebook Page ID.',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return per post (e.g. "id,message,created_time,attachments,insights"). Defaults to "id,message,created_time".',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of posts to return per request.',
            ],
            'since' => [
                'type' => 'string',
                'description' => 'Only return posts created after this UNIX timestamp or ISO date.',
            ],
            'until' => [
                'type' => 'string',
                'description' => 'Only return posts created before this UNIX timestamp or ISO date.',
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

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            } else {
                $params['fields'] = 'id,message,created_time';
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['since'])) {
                $params['since'] = $args['since'];
            }

            if (isset($args['until'])) {
                $params['until'] = $args['until'];
            }

            $result = $this->service->listPosts($args['page_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
