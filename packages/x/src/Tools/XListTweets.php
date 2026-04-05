<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Look up multiple tweets by their IDs.
 *
 * Accepts a comma-separated string or an array of tweet IDs (max 100)
 * and returns their full data in a single API call.
 */
class XListTweets implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_list_tweets';
    }

    public function description(): string
    {
        return 'Look up multiple tweets by their IDs. Pass up to 100 tweet IDs and receive their text, metrics, and metadata in one call.';
    }

    public function parameters(): array
    {
        return [
            'ids' => [
                'type' => 'array',
                'required' => true,
                'items' => ['type' => 'string'],
                'description' => 'Array of tweet IDs to look up (maximum 100).',
            ],
            'tweet_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Additional tweet fields to request (e.g. "created_at", "public_metrics", "entities"). Default: id, text.',
            ],
            'expansions' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Expansions to include (e.g. "author_id" to get the author user objects).',
            ],
            'user_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'User fields to include when author_id expansion is requested.',
            ],
        ];
    }

    /**
     * Execute the tool: fetch multiple tweets by IDs.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $ids = $args['ids'] ?? [];
            if (empty($ids)) {
                return ToolResult::error('At least one tweet ID is required.');
            }

            if (is_string($ids)) {
                $ids = array_map('trim', explode(',', $ids));
            }

            if (count($ids) > 100) {
                return ToolResult::error('Maximum of 100 tweet IDs allowed per request.');
            }

            $params = [];

            if (!empty($args['tweet_fields']) && is_array($args['tweet_fields'])) {
                $params['tweet.fields'] = implode(',', $args['tweet_fields']);
            }

            if (!empty($args['expansions']) && is_array($args['expansions'])) {
                $params['expansions'] = implode(',', $args['expansions']);
            }

            if (!empty($args['user_fields']) && is_array($args['user_fields'])) {
                $params['user.fields'] = implode(',', $args['user_fields']);
            }

            $result = $this->service->listTweets($ids, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
