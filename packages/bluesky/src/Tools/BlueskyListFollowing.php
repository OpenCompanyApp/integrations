<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: bluesky_list_following
 *
 * List the accounts that a Bluesky user follows via the
 * {@link GET /xrpc/app.bsky.graph.getFollows} endpoint.
 *
 * Supports pagination with a cursor and configurable page size.
 *
 * @see https://docs.bsky.app/docs/api/app-bsky-graph-get-follows
 */
class BlueskyListFollowing implements Tool
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
        return 'bluesky_list_following';
    }

    /**
     * Human-readable description shown to the AI agent.
     */
    public function description(): string
    {
        return 'List the accounts that a Bluesky user follows. Returns profiles with handles, display names, and avatars.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'actor' => ['type' => 'string', 'required' => true, 'description' => 'Handle or DID of the user whose follows to list.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (1–100, default 50).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    /**
     * Execute the tool — list following.
     *
     * @param  array  $args  Tool arguments (see {@see parameters()}).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bluesky integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listFollowing($args['actor'], $limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
