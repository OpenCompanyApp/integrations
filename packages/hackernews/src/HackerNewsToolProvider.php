<?php

namespace OpenCompany\Integrations\HackerNews;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetItem;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetUser;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListBestStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListNewStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListTopStories;

/**
 * Tool provider for the Hacker News integration.
 *
 * Exposes 5 read-only tools for fetching HN stories, items, and user profiles.
 * This is a public API — no authentication or ConfigurableIntegration is needed.
 */
class HackerNewsToolProvider implements ToolProvider
{
    /**
     * The app/group identifier.
     */
    public function appName(): string
    {
        return 'hackernews';
    }

    /**
     * App group metadata for system prompt catalog and UI.
     *
     * @return array{label: string, description: string, icon: string, logo?: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'stories, items, users',
            'description' => 'Tech news & discussion',
            'icon' => 'ph:fire',
            'logo' => 'simple-icons:ycombinator',
        ];
    }

    /**
     * Tool definitions with metadata.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'hackernews_get_item' => [
                'class' => HackerNewsGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Fetch a Hacker News item (story, comment, job, poll) by ID.',
                'icon' => 'ph:article',
            ],
            'hackernews_get_user' => [
                'class' => HackerNewsGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Fetch a Hacker News user profile by username.',
                'icon' => 'ph:user',
            ],
            'hackernews_list_top_stories' => [
                'class' => HackerNewsListTopStories::class,
                'type' => 'read',
                'name' => 'List Top Stories',
                'description' => 'Fetch the current top stories from Hacker News.',
                'icon' => 'ph:trend-up',
            ],
            'hackernews_list_new_stories' => [
                'class' => HackerNewsListNewStories::class,
                'type' => 'read',
                'name' => 'List New Stories',
                'description' => 'Fetch the newest stories from Hacker News.',
                'icon' => 'ph:clock',
            ],
            'hackernews_list_best_stories' => [
                'class' => HackerNewsListBestStories::class,
                'type' => 'read',
                'name' => 'List Best Stories',
                'description' => 'Fetch the best-scoring stories from Hacker News.',
                'icon' => 'ph:star',
            ],
        ];
    }

    /**
     * Whether this is an external integration. Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  class-string<Tool>  $class  The tool class FQCN
     * @param  array<string, mixed>  $context  Runtime context (e.g., account)
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(HackerNewsService::class));
    }

    /**
     * Path to supplementary Lua API documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hackernews.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * The Hacker News API is public — no credentials are needed.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool}>
     */
    public function credentialFields(): array
    {
        return [];
    }
}
