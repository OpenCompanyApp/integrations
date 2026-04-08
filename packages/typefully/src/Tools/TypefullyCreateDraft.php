<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypefullyCreateDraft implements Tool
{
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_create_draft';
    }

    public function description(): string
    {
        return 'Create a new draft in Typefully. Supports tweets, threads, and newsletter drafts. Separate individual tweets in a thread with four newlines (\\\\n\\\\n\\\\n\\\\n).';
    }

    public function parameters(): array
    {
        return [
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The content of the draft. For threads, separate tweets with four newlines.'],
            'type' => ['type' => 'string', 'description' => 'The type of draft: "tweet", "thread", or "mail". Defaults to auto-detected based on content.'],
            'schedule_date' => ['type' => 'string', 'description' => 'ISO 8601 date to schedule the draft (e.g., "2026-04-10T09:00:00Z"). Omit to save as a draft without scheduling.'],
            'thread_connector' => ['type' => 'boolean', 'description' => 'Whether to add a "Show more" connector between tweets in a thread (default: true).'],
            'is_tweet_pin' => ['type' => 'boolean', 'description' => 'Pin the tweet after publishing (default: false).'],
            'is_tweet_reply' => ['type' => 'boolean', 'description' => 'Publish as a reply (requires reply_to, default: false).'],
            'reply_to' => ['type' => 'string', 'description' => 'Tweet ID to reply to (required if is_tweet_reply is true).'],
            'mail_subject' => ['type' => 'string', 'description' => 'Subject line for newsletter drafts (type "mail" only).'],
            'mail_subtitle' => ['type' => 'string', 'description' => 'Subtitle for newsletter drafts.'],
            'audience_id' => ['type' => 'string', 'description' => 'Typefully audience ID for newsletter drafts.'],
            'label_ids' => ['type' => 'array', 'description' => 'Array of label IDs to assign to the draft.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $content = $args['content'];
            $type = $args['type'] ?? null;

            // Build optional parameters
            $options = [];

            if (isset($args['schedule_date'])) {
                $options['schedule_date'] = $args['schedule_date'];
            }
            if (isset($args['thread_connector'])) {
                $options['thread_connector'] = (bool) $args['thread_connector'];
            }
            if (isset($args['is_tweet_pin'])) {
                $options['is_tweet_pin'] = (bool) $args['is_tweet_pin'];
            }
            if (isset($args['is_tweet_reply'])) {
                $options['is_tweet_reply'] = (bool) $args['is_tweet_reply'];
            }
            if (isset($args['reply_to'])) {
                $options['reply_to'] = $args['reply_to'];
            }
            if (isset($args['mail_subject'])) {
                $options['mail_subject'] = $args['mail_subject'];
            }
            if (isset($args['mail_subtitle'])) {
                $options['mail_subtitle'] = $args['mail_subtitle'];
            }
            if (isset($args['audience_id'])) {
                $options['audience_id'] = $args['audience_id'];
            }
            if (isset($args['label_ids'])) {
                $options['label_ids'] = $args['label_ids'];
            }

            $result = $this->service->createDraft($content, $type, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
