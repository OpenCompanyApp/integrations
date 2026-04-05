<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Retrieve a single tweet by its ID.
 *
 * Returns tweet text, creation date, and optional metrics
 * depending on the requested `tweet.fields`.
 */
class XGetTweet implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_get_tweet';
    }

    public function description(): string
    {
        return 'Get a single tweet by ID. Returns the tweet text, author ID, creation date, and public metrics (likes, retweets, replies).';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The tweet ID to look up.',
            ],
            'tweet_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Additional tweet fields to request (e.g. "created_at", "public_metrics", "entities"). Default: id, text.',
            ],
            'expansions' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Expansions to include (e.g. "author_id" to get the author user object).',
            ],
            'user_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'User fields to include when author_id expansion is requested.',
            ],
        ];
    }

    /**
     * Execute the tool: fetch a tweet by ID.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Tweet ID is required.');
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

            $result = $this->service->getTweet($id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
