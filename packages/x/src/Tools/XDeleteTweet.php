<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\Integrations\X\XService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a tweet by ID.
 *
 * Calls `DELETE /tweets/{id}` on the Twitter API v2.
 */
class XDeleteTweet implements Tool
{
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_delete_tweet';
    }

    public function description(): string
    {
        return 'Delete a tweet by its ID. The tweet must belong to the authenticated user. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'tweet_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The ID of the tweet to delete.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $result = $this->service->deleteTweet($args['tweet_id']);

            $deleted = $result['data']['deleted'] ?? false;

            if (!$deleted) {
                return ToolResult::error("Tweet '{$args['tweet_id']}' could not be deleted. It may not exist or does not belong to the authenticated user.");
            }

            return ToolResult::success([
                'tweet_id' => $args['tweet_id'],
                'deleted' => true,
                'message' => "Tweet '{$args['tweet_id']}' has been deleted.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
