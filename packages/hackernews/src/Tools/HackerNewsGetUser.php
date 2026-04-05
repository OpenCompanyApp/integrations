<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\Integrations\HackerNews\HackerNewsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a Hacker News user profile by username.
 *
 * Returns the user's about text, karma, submission and comment IDs,
 * account creation date, and other profile metadata.
 *
 * @see https://github.com/HackerNews/API#users
 */
class HackerNewsGetUser implements Tool
{
    /**
     * @param  HackerNewsService  $service  The HN API service instance
     */
    public function __construct(
        private HackerNewsService $service,
    ) {}

    /**
     * Tool slug used for routing.
     */
    public function name(): string
    {
        return 'hackernews_get_user';
    }

    /**
     * Human-readable description for tool catalogs.
     */
    public function description(): string
    {
        return 'Fetch a Hacker News user profile by username. Returns karma score, about text, account creation date, and lists of submitted item IDs (submissions) and comment IDs.';
    }

    /**
     * Parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Hacker News username (e.g., "pg", "dang").'],
        ];
    }

    /**
     * Execute the tool — fetch the user and return profile data.
     *
     * @param  array<string, mixed>  $args  Keyed arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            $id = $args['id'] ?? '';

            if (empty($id) || !is_string($id)) {
                return ToolResult::error('A valid Hacker News username is required.');
            }

            $user = $this->service->getUser($id);

            if ($user === null) {
                return ToolResult::error("User \"{$id}\" not found or the Hacker News API is unavailable.");
            }

            return ToolResult::success([
                'id' => $user['id'] ?? $id,
                'karma' => $user['karma'] ?? 0,
                'about' => $user['about'] ?? null,
                'created' => $user['created'] ?? null,
                'created_iso' => isset($user['created']) ? gmdate('c', $user['created']) : null,
                'submitted' => $user['submitted'] ?? [],
                'delay' => $user['delay'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
