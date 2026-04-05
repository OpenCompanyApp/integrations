<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create (post) a new tweet.
 *
 * Calls `POST /tweets` on the Twitter API v2.
 */
class TwitterCreateTweet implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_create_tweet';
    }

    public function description(): string
    {
        return 'Post a new tweet. The tweet text must be 280 characters or fewer. Returns the created tweet ID.';
    }

    public function parameters(): array
    {
        return [
            'text' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The text content of the tweet (max 280 characters).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $text = $args['text'] ?? '';

            if (empty(trim($text))) {
                return ToolResult::error('Tweet text cannot be empty.');
            }

            if (mb_strlen($text) > 280) {
                return ToolResult::error('Tweet text exceeds the 280 character limit (' . mb_strlen($text) . ' characters).');
            }

            $result = $this->service->createTweet($text);

            if (!isset($result['data']['id'])) {
                return ToolResult::error('Tweet was not created. Unexpected response from Twitter API.');
            }

            return ToolResult::success([
                'id' => $result['data']['id'],
                'text' => $result['data']['text'] ?? $text,
                'message' => 'Tweet posted successfully.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
