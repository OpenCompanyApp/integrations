<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MastodonCreateStatus — publish a new status (toot) on Mastodon.
 *
 * Supports content warnings (spoiler text), visibility settings,
 * replies, language tagging, and sensitive content flags.
 */
class MastodonCreateStatus implements Tool
{
    public function __construct(
        private MastodonService $service,
    ) {}

    public function name(): string
    {
        return 'mastodon_create_status';
    }

    public function description(): string
    {
        return 'Publish a new status (toot) on Mastodon. Supports content warnings, visibility controls (public, unlisted, private, direct), replies, and language settings.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the status.'],
            'visibility' => ['type' => 'string', 'description' => 'Visibility: "public" (default), "unlisted", "private", or "direct".'],
            'in_reply_to_id' => ['type' => 'string', 'description' => 'ID of the status to reply to.'],
            'spoiler_text' => ['type' => 'string', 'description' => 'Content warning text (marks the status as sensitive).'],
            'sensitive' => ['type' => 'boolean', 'description' => 'Whether the status contains sensitive media.'],
            'language' => ['type' => 'string', 'description' => 'ISO 639-1 language code (e.g., "en", "nl", "fr").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            $statusText = $args['status'];
            $inReplyToId = $args['in_reply_to_id'] ?? null;
            $sensitive = ($args['sensitive'] ?? false) === true;
            $spoilerText = $args['spoiler_text'] ?? null;
            $visibility = $args['visibility'] ?? null;
            $language = $args['language'] ?? null;

            $result = $this->service->createStatus(
                status: $statusText,
                inReplyToId: $inReplyToId,
                sensitive: $sensitive,
                spoilerText: $spoilerText,
                visibility: $visibility,
                language: $language,
            );

            $account = $result['account'] ?? [];

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'created_at' => $result['created_at'] ?? null,
                'content' => $result['content'] ?? '',
                'visibility' => $result['visibility'] ?? $visibility,
                'spoiler_text' => $result['spoiler_text'] ?? '',
                'uri' => $result['uri'] ?? null,
                'url' => $result['url'] ?? null,
                'account' => [
                    'id' => $account['id'] ?? null,
                    'username' => $account['username'] ?? null,
                    'display_name' => $account['display_name'] ?? null,
                    'acct' => $account['acct'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
