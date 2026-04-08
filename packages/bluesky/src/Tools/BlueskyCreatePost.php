<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: bluesky_create_post
 *
 * Create a new post on Bluesky via the AT Protocol
 * {@link POST /xrpc/com.atproto.repo.createRecord} endpoint.
 *
 * The tool constructs an `app.bsky.feed.post` record with the given text and
 * optional language tag, then submits it to the authenticated user's repository.
 *
 * @see https://docs.bsky.app/docs/api/com-atproto-repo-create-record
 */
class BlueskyCreatePost implements Tool
{
    /**
     * @param  BlueskyService  $service  The Bluesky API client.
     */
    public function __construct(
        private BlueskyService $service,
    ) {}

    /**
     * Machine name of this tool.
     */
    public function name(): string
    {
        return 'bluesky_create_post';
    }

    /**
     * Human-readable description shown to the AI agent.
     */
    public function description(): string
    {
        return 'Create a new post on Bluesky. The post text is required and supports facets (mentions, links, tags) if provided.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the post (max 300 graphemes).'],
            'langs' => ['type' => 'array', 'description' => 'BCP-47 language tags (e.g. ["en", "nl"]). Defaults to ["en"].'],
            'facets' => ['type' => 'array', 'description' => 'Optional facets for rich text (mentions, links, tags). Each facet needs index.byteStart, index.byteEnd, and features array.'],
            'createdAt' => ['type' => 'string', 'description' => 'ISO 8601 timestamp. Defaults to now if omitted.'],
        ];
    }

    /**
     * Execute the tool — create the post.
     *
     * @param  array  $args  Tool arguments (see {@see parameters()}).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bluesky integration is not configured.');
            }

            $record = [
                '$type' => 'app.bsky.feed.post',
                'text' => $args['text'],
                'createdAt' => $args['createdAt'] ?? now()->toIso8601ZuluString(),
            ];

            if (isset($args['langs'])) {
                $record['langs'] = $args['langs'];
            }

            if (isset($args['facets'])) {
                $record['facets'] = $args['facets'];
            }

            $result = $this->service->createPost($record);

            return ToolResult::success([
                'message' => 'Post created successfully.',
                'uri' => $result['uri'] ?? null,
                'cid' => $result['cid'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
