<?php

namespace OpenCompany\Integrations\Wallabag;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for wallabag.
 *
 * Exposes wallabag OAuth token, entry, tag, export, annotation, and guarded raw
 * API calls for self-hosted or hosted wallabag instances.
 */
class WallabagToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'wallabag_token_password' => ['WallabagTokenPassword', 'write', 'Password Token', 'Exchange wallabag client and user credentials for an access token.', 'ph:pencil-simple'],
        'wallabag_token_refresh' => ['WallabagTokenRefresh', 'write', 'Refresh Token', 'Refresh a wallabag access token.', 'ph:pencil-simple'],
        'wallabag_entries_list' => ['WallabagEntriesList', 'read', 'List Entries', 'List wallabag entries with filters and pagination.', 'ph:list'],
        'wallabag_entries_create' => ['WallabagEntriesCreate', 'write', 'Create Entry', 'Create a wallabag entry from a URL.', 'ph:pencil-simple'],
        'wallabag_entries_exists' => ['WallabagEntriesExists', 'read', 'Entry Exists', 'Check whether a URL already exists in wallabag.', 'ph:list'],
        'wallabag_entries_get' => ['WallabagEntriesGet', 'read', 'Get Entry', 'Get one wallabag entry.', 'ph:list'],
        'wallabag_entries_update' => ['WallabagEntriesUpdate', 'write', 'Update Entry', 'Update title, archived/starred state, tags, or other entry fields.', 'ph:pencil-simple'],
        'wallabag_entries_delete' => ['WallabagEntriesDelete', 'write', 'Delete Entry', 'Delete one wallabag entry.', 'ph:pencil-simple'],
        'wallabag_entries_reload' => ['WallabagEntriesReload', 'write', 'Reload Entry', 'Refetch and reload a wallabag entry.', 'ph:pencil-simple'],
        'wallabag_entries_export' => ['WallabagEntriesExport', 'read', 'Export Entry', 'Export an entry as epub, mobi, pdf, txt, csv, json, or xml.', 'ph:list'],
        'wallabag_tags_list' => ['WallabagTagsList', 'read', 'List Tags', 'List wallabag tags.', 'ph:list'],
        'wallabag_entry_tags_add' => ['WallabagEntryTagsAdd', 'write', 'Add Entry Tags', 'Add comma-separated tags to an entry.', 'ph:pencil-simple'],
        'wallabag_entry_tag_delete' => ['WallabagEntryTagDelete', 'write', 'Delete Entry Tag', 'Remove one tag from an entry.', 'ph:pencil-simple'],
        'wallabag_annotations_list' => ['WallabagAnnotationsList', 'read', 'List Annotations', 'List annotations for a wallabag entry.', 'ph:list'],
        'wallabag_annotations_create' => ['WallabagAnnotationsCreate', 'write', 'Create Annotation', 'Create an annotation for a wallabag entry.', 'ph:pencil-simple'],
        'wallabag_annotations_update' => ['WallabagAnnotationsUpdate', 'write', 'Update Annotation', 'Update a wallabag annotation.', 'ph:pencil-simple'],
        'wallabag_annotations_delete' => ['WallabagAnnotationsDelete', 'write', 'Delete Annotation', 'Delete a wallabag annotation.', 'ph:pencil-simple'],
        'wallabag_api_get' => ['WallabagApiGet', 'read', 'API GET', 'Call a safe relative wallabag API GET path.', 'ph:code'],
        'wallabag_api_post' => ['WallabagApiPost', 'write', 'API POST', 'Call a safe relative wallabag API POST path.', 'ph:code'],
        'wallabag_api_patch' => ['WallabagApiPatch', 'write', 'API PATCH', 'Call a safe relative wallabag API PATCH path.', 'ph:code'],
        'wallabag_api_delete' => ['WallabagApiDelete', 'write', 'API DELETE', 'Call a safe relative wallabag API DELETE path.', 'ph:code'],
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
                'strategy' => 'oauth2_password',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret', 'password_grant', 'refresh_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => true,
                'token_keys' => ['access_token', 'refresh_token', 'client_id', 'client_secret'],
                'notes' => ['wallabag uses OAuth2 bearer tokens from /oauth/v2/token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'wallabag'; }

    public function appMeta(): array
    {
        return ['label' => 'wallabag', 'description' => 'Saved articles, entries, tags, exports, and annotations', 'icon' => 'ph:bookmark-simple', 'logo' => 'ph:bookmark-simple'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'wallabag',
            'description' => 'Manage wallabag OAuth tokens, entries, tags, exports, and annotations.',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'ph:bookmark-simple',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://doc.wallabag.org/developer/api/',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify wallabag credentials with the entries endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $accessToken = (string) ($config['access_token'] ?? '');
            if ($accessToken === '') {
                return ['success' => false, 'error' => 'wallabag access token is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://app.wallabag.it';
            $response = Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/api/entries.json', ['perPage' => 1]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'wallabag API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to wallabag API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'refresh_token' => 'nullable|string',
            'url' => 'nullable|string',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'wallabag bearer token', 'hint' => 'OAuth access token used for API calls.', 'required' => false],
            ['key' => 'refresh_token', 'type' => 'secret', 'label' => 'Refresh Token', 'placeholder' => 'wallabag refresh token', 'hint' => 'Optional token for refresh-token grants.', 'required' => false],
            ['key' => 'client_id', 'type' => 'secret', 'label' => 'Client ID', 'placeholder' => 'wallabag client ID', 'hint' => 'OAuth client ID from the wallabag developer client page.', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'placeholder' => 'wallabag client secret', 'hint' => 'OAuth client secret from the wallabag developer client page.', 'required' => false],
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'placeholder' => 'wallabag username', 'hint' => 'Optional username for password-grant token exchange.', 'required' => false],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'placeholder' => 'wallabag password', 'hint' => 'Optional password for password-grant token exchange.', 'required' => false],
            ['key' => 'url', 'type' => 'text', 'label' => 'Instance URL', 'placeholder' => 'https://app.wallabag.it', 'hint' => 'wallabag instance root URL.', 'required' => false],
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
     * Create a wallabag tool instance.
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
    private function resolveService(array $context = []): WallabagService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new WallabagService(
                accessToken: $creds->get('wallabag', 'access_token', '', $account),
                clientId: $creds->get('wallabag', 'client_id', '', $account),
                clientSecret: $creds->get('wallabag', 'client_secret', '', $account),
                username: $creds->get('wallabag', 'username', '', $account),
                password: $creds->get('wallabag', 'password', '', $account),
                refreshToken: $creds->get('wallabag', 'refresh_token', '', $account),
                baseUrl: $creds->get('wallabag', 'url', 'https://app.wallabag.it', $account),
            );
        }

        return app(WallabagService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/wallabag.md';
    }
}
