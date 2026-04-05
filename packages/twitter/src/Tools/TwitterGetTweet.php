<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single tweet by ID.
 *
 * Calls `GET /tweets/{id}` on the Twitter API v2.
 */
class TwitterGetTweet implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_get_tweet';
    }

    public function description(): string
    {
        return 'Get a single tweet by its ID. Returns the tweet text, author ID, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'tweet_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The tweet ID.',
            ],
            'tweet_fields' => [
                'type' => 'array',
                'description' => 'Additional tweet fields to include: attachments, author_id, context_annotations, conversation_id, created_at, edit_controls, entities, geo, id, in_reply_to_user_id, lang, non_public_metrics, note_tweet, organic_metrics, possibly_sensitive, promoted_metrics, public_metrics, referenced_tweets, reply_settings, source, text, withheld.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $tweetFields = $args['tweet_fields'] ?? [];
            $result = $this->service->getTweet($args['tweet_id'], $tweetFields);

            if (!isset($result['data'])) {
                return ToolResult::error("Tweet '{$args['tweet_id']}' not found.");
            }

            return ToolResult::success($result['data']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
