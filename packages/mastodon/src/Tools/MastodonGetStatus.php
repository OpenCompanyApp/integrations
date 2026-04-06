<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MastodonGetStatus — retrieve a single status (toot) by its ID.
 *
 * Returns the full status object including author info, content,
 * engagement metrics, and visibility.
 */
class MastodonGetStatus implements Tool
{
    public function __construct(
        private MastodonService $service,
    ) {}

    public function name(): string
    {
        return 'mastodon_get_status';
    }

    public function description(): string
    {
        return 'Retrieve a single Mastodon status (toot) by its ID. Returns the full post content, author details, and engagement metrics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the status to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            $status = $this->service->getStatus($args['id']);

            return ToolResult::success($this->formatStatus($status));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a status for a cleaner response.
     *
     * @param  array<string, mixed>  $status
     * @return array<string, mixed>
     */
    private function formatStatus(array $status): array
    {
        $account = $status['account'] ?? [];
        $mediaAttachments = $status['media_attachments'] ?? [];

        return [
            'id' => $status['id'] ?? null,
            'created_at' => $status['created_at'] ?? null,
            'content' => $status['content'] ?? '',
            'spoiler_text' => $status['spoiler_text'] ?? '',
            'sensitive' => $status['sensitive'] ?? false,
            'visibility' => $status['visibility'] ?? null,
            'uri' => $status['uri'] ?? null,
            'url' => $status['url'] ?? null,
            'reblogs_count' => $status['reblogs_count'] ?? 0,
            'favourites_count' => $status['favourites_count'] ?? 0,
            'replies_count' => $status['replies_count'] ?? 0,
            'account' => [
                'id' => $account['id'] ?? null,
                'username' => $account['username'] ?? null,
                'display_name' => $account['display_name'] ?? null,
                'acct' => $account['acct'] ?? null,
                'url' => $account['url'] ?? null,
            ],
            'in_reply_to_id' => $status['in_reply_to_id'] ?? null,
            'language' => $status['language'] ?? null,
            'media_attachments' => array_map(function (array $media): array {
                return [
                    'id' => $media['id'] ?? null,
                    'type' => $media['type'] ?? null,
                    'url' => $media['url'] ?? null,
                    'description' => $media['description'] ?? null,
                ];
            }, $mediaAttachments),
            'tags' => array_map(function (array $tag): string {
                return $tag['name'] ?? '';
            }, $status['tags'] ?? []),
        ];
    }
}
