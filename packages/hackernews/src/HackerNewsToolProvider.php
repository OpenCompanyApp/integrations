<?php

namespace OpenCompany\Integrations\HackerNews;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetItem;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetMaxItem;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetUpdates;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetUser;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListAskStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListBestStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListJobStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListNewStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListShowStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListTopStories;

/**
 * Exposes the public Hacker News Firebase API as agent-callable tools.
 *
 * No credentials are required; all tools read from the official v0 API.
 */
class HackerNewsToolProvider implements ToolProvider, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'none',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'none',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'hackernews';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Hacker News',
            'description' => 'Tech news & discussion',
            'icon' => 'ph:fire',
            'logo' => 'simple-icons:ycombinator',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Hacker News',
            'description' => 'Tech news, discussions, users, live story feeds, and changed item/profile IDs',
            'icon' => 'ph:fire',
            'logo' => 'simple-icons:ycombinator',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/HackerNews/API',
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
            'hackernews_get_max_item' => [
                'class' => HackerNewsGetMaxItem::class,
                'type' => 'read',
                'name' => 'Get Max Item',
                'description' => 'Fetch the current largest Hacker News item ID.',
                'icon' => 'ph:number-circle-one',
            ],
            'hackernews_get_updates' => [
                'class' => HackerNewsGetUpdates::class,
                'type' => 'read',
                'name' => 'Get Updates',
                'description' => 'Fetch recently changed Hacker News item IDs and profile IDs.',
                'icon' => 'ph:arrows-clockwise',
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
            'hackernews_list_ask_stories' => [
                'class' => HackerNewsListAskStories::class,
                'type' => 'read',
                'name' => 'List Ask Stories',
                'description' => 'Fetch the latest Ask HN stories from Hacker News.',
                'icon' => 'ph:question',
            ],
            'hackernews_list_show_stories' => [
                'class' => HackerNewsListShowStories::class,
                'type' => 'read',
                'name' => 'List Show Stories',
                'description' => 'Fetch the latest Show HN stories from Hacker News.',
                'icon' => 'ph:rocket-launch',
            ],
            'hackernews_list_job_stories' => [
                'class' => HackerNewsListJobStories::class,
                'type' => 'read',
                'name' => 'List Job Stories',
                'description' => 'Fetch the latest Hacker News job stories.',
                'icon' => 'ph:briefcase',
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
