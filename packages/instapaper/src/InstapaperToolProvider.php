<?php

namespace OpenCompany\Integrations\Instapaper;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Instapaper.
 *
 * Exposes the OAuth 1.0a Full API and the Basic-auth Simple API for agent
 * bookmark, folder, highlight, and text-extraction workflows.
 */
class InstapaperToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'instapaper_get_access_token' => ['InstapaperGetAccessToken', 'write', 'Get Access Token', 'Exchange xAuth username and password for an Instapaper OAuth access token.', 'ph:key'],
        'instapaper_verify_credentials' => ['InstapaperVerifyCredentials', 'read', 'Verify Credentials', 'Verify the Instapaper OAuth credentials.', 'ph:user-check'],
        'instapaper_list_bookmarks' => ['InstapaperListBookmarks', 'read', 'List Bookmarks', 'List Instapaper bookmarks.', 'ph:bookmarks'],
        'instapaper_update_read_progress' => ['InstapaperUpdateReadProgress', 'write', 'Update Read Progress', 'Update bookmark reading progress.', 'ph:percent'],
        'instapaper_add_bookmark' => ['InstapaperAddBookmark', 'write', 'Add Bookmark', 'Add a URL to Instapaper.', 'ph:bookmark-simple'],
        'instapaper_delete_bookmark' => ['InstapaperDeleteBookmark', 'write', 'Delete Bookmark', 'Delete an Instapaper bookmark.', 'ph:trash'],
        'instapaper_star_bookmark' => ['InstapaperStarBookmark', 'write', 'Star Bookmark', 'Star an Instapaper bookmark.', 'ph:star'],
        'instapaper_unstar_bookmark' => ['InstapaperUnstarBookmark', 'write', 'Unstar Bookmark', 'Remove a star from an Instapaper bookmark.', 'ph:star-half'],
        'instapaper_archive_bookmark' => ['InstapaperArchiveBookmark', 'write', 'Archive Bookmark', 'Archive an Instapaper bookmark.', 'ph:archive'],
        'instapaper_unarchive_bookmark' => ['InstapaperUnarchiveBookmark', 'write', 'Unarchive Bookmark', 'Move an archived bookmark back to unread.', 'ph:tray'],
        'instapaper_move_bookmark' => ['InstapaperMoveBookmark', 'write', 'Move Bookmark', 'Move a bookmark to a folder.', 'ph:folder-simple-plus'],
        'instapaper_get_bookmark_text' => ['InstapaperGetBookmarkText', 'read', 'Get Bookmark Text', 'Get readable HTML text for a bookmark.', 'ph:article'],
        'instapaper_list_folders' => ['InstapaperListFolders', 'read', 'List Folders', 'List Instapaper folders.', 'ph:folders'],
        'instapaper_add_folder' => ['InstapaperAddFolder', 'write', 'Add Folder', 'Create an Instapaper folder.', 'ph:folder-plus'],
        'instapaper_delete_folder' => ['InstapaperDeleteFolder', 'write', 'Delete Folder', 'Delete an Instapaper folder.', 'ph:folder-minus'],
        'instapaper_set_folder_order' => ['InstapaperSetFolderOrder', 'write', 'Set Folder Order', 'Set the order of Instapaper folders.', 'ph:list-numbers'],
        'instapaper_list_highlights' => ['InstapaperListHighlights', 'read', 'List Highlights', 'List highlights for a bookmark.', 'ph:highlighter'],
        'instapaper_create_highlight' => ['InstapaperCreateHighlight', 'write', 'Create Highlight', 'Create a bookmark highlight.', 'ph:marker-circle'],
        'instapaper_delete_highlight' => ['InstapaperDeleteHighlight', 'write', 'Delete Highlight', 'Delete an Instapaper highlight.', 'ph:eraser'],
        'instapaper_simple_authenticate' => ['InstapaperSimpleAuthenticate', 'read', 'Simple Authenticate', 'Validate Simple API credentials with HTTP Basic auth.', 'ph:lock-key'],
        'instapaper_simple_add_url' => ['InstapaperSimpleAddUrl', 'write', 'Simple Add URL', 'Save a URL through the Instapaper Simple API.', 'ph:link-simple'],
        'instapaper_api_post' => ['InstapaperApiPost', 'write', 'API POST', 'Call a safe relative Instapaper Full API path with OAuth signing.', 'ph:code'],
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
                'strategy' => 'oauth1',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret', 'xauth_exchange'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['consumer_key', 'consumer_secret', 'oauth_token', 'oauth_token_secret'],
                'notes' => ['Instapaper Full API requires OAuth 1.0a Authorization headers; Simple API tools may use optional Basic-auth credentials.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'instapaper'; }

    public function appMeta(): array
    {
        return ['label' => 'Instapaper', 'description' => 'Bookmarks, folders, highlights, article text, and Simple API saves', 'icon' => 'ph:bookmark-simple', 'logo' => 'ph:bookmark-simple'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Instapaper',
            'description' => 'Manage Instapaper bookmarks, folders, read progress, highlights, article text, OAuth access-token exchange, and Simple API saves.',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'ph:bookmark-simple',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.instapaper.com/developers/v1/full-api',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Instapaper OAuth credentials with the account endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            foreach (['consumer_key', 'consumer_secret', 'oauth_token', 'oauth_token_secret'] as $key) {
                if ((string) ($config[$key] ?? '') === '') {
                    return ['success' => false, 'error' => 'Instapaper '.$key.' is required.'];
                }
            }

            $service = new InstapaperService(
                consumerKey: (string) $config['consumer_key'],
                consumerSecret: (string) $config['consumer_secret'],
                oauthToken: (string) $config['oauth_token'],
                oauthTokenSecret: (string) $config['oauth_token_secret'],
                baseUrl: (string) ($config['url'] ?? 'https://www.instapaper.com'),
            );

            $service->call('verify_credentials');

            return ['success' => true, 'message' => 'Connected to Instapaper API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'consumer_key' => 'required|string',
            'consumer_secret' => 'required|string',
            'oauth_token' => 'nullable|string',
            'oauth_token_secret' => 'nullable|string',
            'simple_username' => 'nullable|string',
            'simple_password' => 'nullable|string',
            'url' => 'nullable|string',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'consumer_key', 'type' => 'secret', 'label' => 'Consumer Key', 'placeholder' => 'Instapaper consumer key', 'hint' => 'Required for OAuth 1.0a Full API calls and xAuth token exchange.', 'required' => true],
            ['key' => 'consumer_secret', 'type' => 'secret', 'label' => 'Consumer Secret', 'placeholder' => 'Instapaper consumer secret', 'hint' => 'Required for OAuth 1.0a request signing.', 'required' => true],
            ['key' => 'oauth_token', 'type' => 'secret', 'label' => 'OAuth Token', 'placeholder' => 'Instapaper OAuth token', 'hint' => 'Access token returned by the xAuth exchange.', 'required' => false],
            ['key' => 'oauth_token_secret', 'type' => 'secret', 'label' => 'OAuth Token Secret', 'placeholder' => 'Instapaper OAuth token secret', 'hint' => 'Access token secret returned by the xAuth exchange.', 'required' => false],
            ['key' => 'simple_username', 'type' => 'text', 'label' => 'Simple API Username', 'placeholder' => 'user@example.test', 'hint' => 'Optional Basic-auth username for Simple API tools.', 'required' => false],
            ['key' => 'simple_password', 'type' => 'secret', 'label' => 'Simple API Password', 'placeholder' => 'Instapaper password', 'hint' => 'Optional Basic-auth password for Simple API tools.', 'required' => false],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://www.instapaper.com', 'hint' => 'Optional Instapaper base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create an Instapaper tool instance.
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
    private function resolveService(array $context = []): InstapaperService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new InstapaperService(
                consumerKey: $creds->get('instapaper', 'consumer_key', '', $account),
                consumerSecret: $creds->get('instapaper', 'consumer_secret', '', $account),
                oauthToken: $creds->get('instapaper', 'oauth_token', '', $account),
                oauthTokenSecret: $creds->get('instapaper', 'oauth_token_secret', '', $account),
                simpleUsername: $creds->get('instapaper', 'simple_username', '', $account),
                simplePassword: $creds->get('instapaper', 'simple_password', '', $account),
                baseUrl: $creds->get('instapaper', 'url', 'https://www.instapaper.com', $account),
            );
        }

        return app(InstapaperService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/instapaper.md';
    }
}
