<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Post a new tweet (status update).
 *
 * Accepts the tweet text along with optional reply settings and media
 * attachments. Returns the created tweet ID and text on success.
 */
class XCreateTweet implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_create_tweet';
    }

    public function description(): string
    {
        return 'Post a new tweet. Supports text only, replies, and media attachments. The tweet text must not exceed 280 characters.';
    }

    public function parameters(): array
    {
        return [
            'text' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The text content of the tweet (max 280 characters).',
            ],
            'reply_settings' => [
                'type' => 'string',
                'enum' => ['everyone', 'mentionedUsers', 'following'],
                'description' => 'Who can reply to this tweet. "everyone" (default), "mentionedUsers", or "following".',
            ],
            'media_ids' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Array of media IDs (pre-uploaded via the media upload endpoint) to attach. Max 4 for images, 1 for video.',
            ],
            'reply_to' => [
                'type' => 'string',
                'description' => 'Tweet ID to reply to. When set, the new tweet will be threaded as a reply.',
            ],
        ];
    }

    /**
     * Execute the tool: create a new tweet.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $text = $args['text'] ?? '';
            if (empty($text)) {
                return ToolResult::error('Tweet text is required.');
            }

            if (mb_strlen($text) > 280) {
                return ToolResult::error('Tweet text exceeds the 280-character limit (' . mb_strlen($text) . ' characters).');
            }

            $data = ['text' => $text];

            if (isset($args['reply_settings']) && in_array($args['reply_settings'], ['everyone', 'mentionedUsers', 'following'], true)) {
                $data['reply_settings'] = $args['reply_settings'];
            }

            if (!empty($args['media_ids']) && is_array($args['media_ids'])) {
                $data['media'] = [
                    'media_ids' => $args['media_ids'],
                ];
            }

            if (!empty($args['reply_to'])) {
                $data['reply'] = [
                    'in_reply_to_tweet_id' => $args['reply_to'],
                ];
            }

            $result = $this->service->createTweet($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
