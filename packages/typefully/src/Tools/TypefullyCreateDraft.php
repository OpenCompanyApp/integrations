<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Create a Typefully v2 draft for a social set.
 *
 * Supports full platforms payloads or a simplified single-platform content shortcut.
 */
class TypefullyCreateDraft implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_create_draft';
    }

    public function description(): string
    {
        return 'Create a Typefully v2 draft for a social set. Use platforms for full multi-platform control, or content plus platform for a simple post.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID. Get it from typefully_list_social_sets.'],
            'platforms' => ['type' => 'object', 'description' => 'Full v2 platforms payload keyed by x, linkedin, threads, bluesky, or mastodon.'],
            'content' => ['type' => 'string', 'description' => 'Simple content shortcut when platforms is omitted.'],
            'platform' => ['type' => 'string', 'description' => 'Simple shortcut platform when platforms is omitted. Defaults to x.', 'enum' => ['x', 'linkedin', 'threads', 'bluesky', 'mastodon']],
            'posts' => ['type' => 'array', 'description' => 'Simple shortcut posts array. Each item may contain text and media_ids.', 'items' => ['type' => 'object']],
            'publish_at' => ['type' => 'string', 'description' => 'ISO 8601 datetime, "now", or "next-free-slot". Omit to save as draft.'],
            'title' => ['type' => 'string', 'description' => 'Optional internal draft title.'],
            'tags' => ['type' => 'array', 'description' => 'Tag slugs to assign to the draft.', 'items' => ['type' => 'string']],
            'share' => ['type' => 'boolean', 'description' => 'Whether to generate or enable public sharing for the draft.'],
            'reply_to' => ['type' => 'string', 'description' => 'Optional post URL or platform reference to publish as a reply.'],
        ];
    }

    /**
     * Create a Typefully v2 draft.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $socialSetId = $args['social_set_id'] ?? '';
            if ($socialSetId === '') {
                return ToolResult::error('social_set_id is required.');
            }

            $payload = [];
            if (isset($args['platforms']) && is_array($args['platforms'])) {
                $payload['platforms'] = $args['platforms'];
            } else {
                $posts = $args['posts'] ?? null;
                if ($posts === null && isset($args['content'])) {
                    $posts = [['text' => $args['content']]];
                }

                if (!is_array($posts) || $posts === []) {
                    return ToolResult::error('Provide either platforms, posts, or content.');
                }

                $platform = $args['platform'] ?? 'x';
                $payload['platforms'] = [
                    $platform => [
                        'enabled' => true,
                        'posts' => $posts,
                    ],
                ];
            }

            foreach (['publish_at', 'title', 'tags', 'share', 'reply_to'] as $field) {
                if (array_key_exists($field, $args)) {
                    $payload[$field] = $args[$field];
                }
            }

            return ToolResult::success($this->service->createDraft($socialSetId, $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
