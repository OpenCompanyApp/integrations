<?php

namespace OpenCompany\Integrations\Feedbin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Feedbin.
 *
 * Exposes Feedbin API V2 subscriptions, entries, unread/starred state,
 * taggings, tags, saved searches, imports, icons, pages, and raw calls.
 */
class FeedbinToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'feedbin_authentication_check' => ['FeedbinAuthenticationCheck', 'read', 'Check Authentication', 'Verify Feedbin Basic auth credentials.', 'ph:list'],
        'feedbin_subscriptions_list' => ['FeedbinSubscriptionsList', 'read', 'List Subscriptions', 'List Feedbin subscriptions.', 'ph:list'],
        'feedbin_subscriptions_get' => ['FeedbinSubscriptionsGet', 'read', 'Get Subscription', 'Get one subscription.', 'ph:list'],
        'feedbin_subscriptions_create' => ['FeedbinSubscriptionsCreate', 'write', 'Create Subscription', 'Subscribe to a feed URL or website URL.', 'ph:pencil-simple'],
        'feedbin_subscriptions_update' => ['FeedbinSubscriptionsUpdate', 'write', 'Update Subscription', 'Set a custom subscription title.', 'ph:pencil-simple'],
        'feedbin_subscriptions_update_post' => ['FeedbinSubscriptionsUpdatePost', 'write', 'Update Subscription POST', 'POST fallback for subscription updates.', 'ph:pencil-simple'],
        'feedbin_subscriptions_delete' => ['FeedbinSubscriptionsDelete', 'write', 'Delete Subscription', 'Delete a subscription.', 'ph:pencil-simple'],
        'feedbin_feeds_get' => ['FeedbinFeedsGet', 'read', 'Get Feed', 'Get one Feedbin feed.', 'ph:list'],
        'feedbin_entries_list' => ['FeedbinEntriesList', 'read', 'List Entries', 'List entries with filters and pagination.', 'ph:list'],
        'feedbin_feed_entries_list' => ['FeedbinFeedEntriesList', 'read', 'List Feed Entries', 'List entries for one feed.', 'ph:list'],
        'feedbin_entries_get' => ['FeedbinEntriesGet', 'read', 'Get Entry', 'Get one entry.', 'ph:list'],
        'feedbin_unread_entries_list' => ['FeedbinUnreadEntriesList', 'read', 'List Unread Entry IDs', 'List unread entry IDs.', 'ph:list'],
        'feedbin_unread_entries_create' => ['FeedbinUnreadEntriesCreate', 'write', 'Mark Unread', 'Mark entry IDs as unread.', 'ph:pencil-simple'],
        'feedbin_unread_entries_delete' => ['FeedbinUnreadEntriesDelete', 'write', 'Mark Read', 'Mark entry IDs as read.', 'ph:pencil-simple'],
        'feedbin_unread_entries_delete_post' => ['FeedbinUnreadEntriesDeletePost', 'write', 'Mark Read POST', 'POST fallback for marking read.', 'ph:pencil-simple'],
        'feedbin_starred_entries_list' => ['FeedbinStarredEntriesList', 'read', 'List Starred Entry IDs', 'List starred entry IDs.', 'ph:list'],
        'feedbin_starred_entries_create' => ['FeedbinStarredEntriesCreate', 'write', 'Star Entries', 'Star entry IDs.', 'ph:pencil-simple'],
        'feedbin_starred_entries_delete' => ['FeedbinStarredEntriesDelete', 'write', 'Unstar Entries', 'Unstar entry IDs.', 'ph:pencil-simple'],
        'feedbin_starred_entries_delete_post' => ['FeedbinStarredEntriesDeletePost', 'write', 'Unstar Entries POST', 'POST fallback for unstarring.', 'ph:pencil-simple'],
        'feedbin_taggings_list' => ['FeedbinTaggingsList', 'read', 'List Taggings', 'List taggings.', 'ph:list'],
        'feedbin_taggings_get' => ['FeedbinTaggingsGet', 'read', 'Get Tagging', 'Get one tagging.', 'ph:list'],
        'feedbin_taggings_create' => ['FeedbinTaggingsCreate', 'write', 'Create Tagging', 'Create a tagging for a feed.', 'ph:pencil-simple'],
        'feedbin_taggings_delete' => ['FeedbinTaggingsDelete', 'write', 'Delete Tagging', 'Delete one tagging.', 'ph:pencil-simple'],
        'feedbin_tags_create' => ['FeedbinTagsCreate', 'write', 'Rename Tag', 'Rename a tag.', 'ph:pencil-simple'],
        'feedbin_tags_delete' => ['FeedbinTagsDelete', 'write', 'Delete Tag', 'Delete a tag.', 'ph:pencil-simple'],
        'feedbin_saved_searches_list' => ['FeedbinSavedSearchesList', 'read', 'List Saved Searches', 'List saved searches.', 'ph:list'],
        'feedbin_saved_searches_get' => ['FeedbinSavedSearchesGet', 'read', 'Get Saved Search', 'Get matching entry IDs or entries for a saved search.', 'ph:list'],
        'feedbin_saved_searches_create' => ['FeedbinSavedSearchesCreate', 'write', 'Create Saved Search', 'Create a saved search.', 'ph:pencil-simple'],
        'feedbin_saved_searches_update' => ['FeedbinSavedSearchesUpdate', 'write', 'Update Saved Search', 'Update a saved search.', 'ph:pencil-simple'],
        'feedbin_saved_searches_update_post' => ['FeedbinSavedSearchesUpdatePost', 'write', 'Update Saved Search POST', 'POST fallback for saved-search updates.', 'ph:pencil-simple'],
        'feedbin_saved_searches_delete' => ['FeedbinSavedSearchesDelete', 'write', 'Delete Saved Search', 'Delete a saved search.', 'ph:pencil-simple'],
        'feedbin_recently_read_entries_list' => ['FeedbinRecentlyReadEntriesList', 'read', 'List Recently Read Entry IDs', 'List recently read entry IDs.', 'ph:list'],
        'feedbin_recently_read_entries_create' => ['FeedbinRecentlyReadEntriesCreate', 'write', 'Create Recently Read Entries', 'Create recently-read records.', 'ph:pencil-simple'],
        'feedbin_updated_entries_list' => ['FeedbinUpdatedEntriesList', 'read', 'List Updated Entry IDs', 'List updated entry IDs.', 'ph:list'],
        'feedbin_updated_entries_delete' => ['FeedbinUpdatedEntriesDelete', 'write', 'Clear Updated Entries', 'Mark updated entries as read.', 'ph:pencil-simple'],
        'feedbin_updated_entries_delete_post' => ['FeedbinUpdatedEntriesDeletePost', 'write', 'Clear Updated Entries POST', 'POST fallback for clearing updated entries.', 'ph:pencil-simple'],
        'feedbin_icons_list' => ['FeedbinIconsList', 'read', 'List Icons', 'List feed icons.', 'ph:list'],
        'feedbin_imports_create' => ['FeedbinImportsCreate', 'write', 'Create Import', 'Import OPML XML subscriptions.', 'ph:pencil-simple'],
        'feedbin_imports_list' => ['FeedbinImportsList', 'read', 'List Imports', 'List imports.', 'ph:list'],
        'feedbin_imports_get' => ['FeedbinImportsGet', 'read', 'Get Import', 'Get import status.', 'ph:list'],
        'feedbin_pages_create' => ['FeedbinPagesCreate', 'write', 'Create Page', 'Save a page to Feedbin.', 'ph:pencil-simple'],
        'feedbin_pages_delete' => ['FeedbinPagesDelete', 'write', 'Delete Page', 'Delete a saved page.', 'ph:pencil-simple'],
        'feedbin_api_get' => ['FeedbinApiGet', 'read', 'API GET', 'Call a safe relative Feedbin API GET path.', 'ph:code'],
        'feedbin_api_post' => ['FeedbinApiPost', 'write', 'API POST', 'Call a safe relative Feedbin API POST path.', 'ph:code'],
        'feedbin_api_patch' => ['FeedbinApiPatch', 'write', 'API PATCH', 'Call a safe relative Feedbin API PATCH path.', 'ph:code'],
        'feedbin_api_delete' => ['FeedbinApiDelete', 'write', 'API DELETE', 'Call a safe relative Feedbin API DELETE path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'basic',
                'legacy_auth_type' => 'basic',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['username', 'password'],
                'notes' => ['Feedbin API V2 uses HTTP Basic authentication.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'feedbin'; }

    public function appMeta(): array
    {
        return ['label' => 'Feedbin', 'description' => 'RSS subscriptions, entries, state, tags, saved searches, imports, and pages', 'icon' => 'ph:rss', 'logo' => 'ph:rss'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Feedbin',
            'description' => 'Manage Feedbin subscriptions, entries, unread/starred state, taggings, tags, saved searches, imports, icons, and pages.',
            'icon' => 'ph:rss',
            'logo' => 'ph:rss',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/feedbin/feedbin-api',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Feedbin Basic auth credentials.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $username = (string) ($config['username'] ?? '');
            $password = (string) ($config['password'] ?? '');
            if ($username === '' || $password === '') {
                return ['success' => false, 'error' => 'Feedbin username and password are required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.feedbin.com/v2';
            $response = Http::withBasicAuth($username, $password)->acceptJson()->timeout(20)->get($baseUrl.'/authentication.json');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Feedbin API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Feedbin API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['username' => 'required|string', 'password' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'text', 'label' => 'Email', 'placeholder' => 'reader@example.test', 'hint' => 'Feedbin account email.', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'placeholder' => 'Feedbin password', 'hint' => 'Feedbin password for Basic authentication.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.feedbin.com/v2', 'hint' => 'Optional Feedbin API base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Feedbin tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): FeedbinService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FeedbinService(
                username: $creds->get('feedbin', 'username', '', $account),
                password: $creds->get('feedbin', 'password', '', $account),
                baseUrl: $creds->get('feedbin', 'url', 'https://api.feedbin.com/v2', $account),
            );
        }

        return app(FeedbinService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/feedbin.md';
    }
}
