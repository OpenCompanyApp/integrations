<?php

namespace OpenCompany\Integrations\Pinboard;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Pinboard.
 *
 * Exposes Pinboard v1 bookmark, tag, user, and note endpoints as compact tools
 * that keep authentication and response parsing in the service layer.
 */
class PinboardToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'pinboard_posts_update' => ['PinboardPostsUpdate', 'read', 'Posts Update', 'Return the most recent bookmark add, update, or delete time.', 'ph:list'],
        'pinboard_posts_add' => ['PinboardPostsAdd', 'write', 'Add Bookmark', 'Add or update a bookmark.', 'ph:pencil-simple'],
        'pinboard_posts_delete' => ['PinboardPostsDelete', 'write', 'Delete Bookmark', 'Delete an existing bookmark.', 'ph:pencil-simple'],
        'pinboard_posts_get' => ['PinboardPostsGet', 'read', 'Get Posts', 'Return one or more posts for a date or URL.', 'ph:list'],
        'pinboard_posts_recent' => ['PinboardPostsRecent', 'read', 'Recent Posts', 'Return recent posts, optionally filtered by tag.', 'ph:list'],
        'pinboard_posts_all' => ['PinboardPostsAll', 'read', 'All Posts', 'Return all bookmarks in the account.', 'ph:list'],
        'pinboard_posts_dates' => ['PinboardPostsDates', 'read', 'Post Dates', 'Return dates with bookmark counts.', 'ph:list'],
        'pinboard_posts_suggest' => ['PinboardPostsSuggest', 'read', 'Suggest Tags', 'Return popular and recommended tags for a URL.', 'ph:list'],
        'pinboard_tags_get' => ['PinboardTagsGet', 'read', 'Get Tags', 'Return tags and usage counts.', 'ph:list'],
        'pinboard_tags_delete' => ['PinboardTagsDelete', 'write', 'Delete Tag', 'Delete all instances of a tag.', 'ph:pencil-simple'],
        'pinboard_tags_rename' => ['PinboardTagsRename', 'write', 'Rename Tag', 'Rename a tag or fold it into an existing tag.', 'ph:pencil-simple'],
        'pinboard_user_secret' => ['PinboardUserSecret', 'read', 'User Secret', 'Return the secret RSS key.', 'ph:list'],
        'pinboard_user_api_token' => ['PinboardUserApiToken', 'read', 'API Token', 'Return the user API token.', 'ph:list'],
        'pinboard_notes_list' => ['PinboardNotesList', 'read', 'List Notes', 'Return a list of notes without note text detail.', 'ph:list'],
        'pinboard_notes_get' => ['PinboardNotesGet', 'read', 'Get Note', 'Return an individual note.', 'ph:list'],
        'pinboard_api_get' => ['PinboardApiGet', 'read', 'API GET', 'Call a safe relative Pinboard GET path.', 'ph:code'],
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['auth_token'],
                'notes' => ['Pinboard uses an auth_token query parameter, usually username:token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'pinboard'; }

    public function appMeta(): array
    {
        return ['label' => 'Pinboard', 'description' => 'Bookmarks, tags, notes, user secret, and API token', 'icon' => 'ph:push-pin', 'logo' => 'ph:push-pin'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pinboard',
            'description' => 'Manage Pinboard bookmarks, tags, notes, user secret, and API token.',
            'icon' => 'ph:push-pin',
            'logo' => 'ph:push-pin',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://pinboard.in/api/',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Pinboard credentials with the posts/update endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $authToken = (string) ($config['auth_token'] ?? '');
            if ($authToken === '') {
                return ['success' => false, 'error' => 'Pinboard auth token is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.pinboard.in/v1';
            $response = Http::acceptJson()->timeout(20)->get($baseUrl.'/posts/update', [
                'format' => 'json',
                'auth_token' => $authToken,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Pinboard API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Pinboard API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['auth_token' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'placeholder' => 'username:token', 'hint' => 'Pinboard API token from settings/password.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.pinboard.in/v1', 'hint' => 'Optional Pinboard v1 base URL override.', 'required' => false],
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
     * Create a Pinboard tool instance.
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
    private function resolveService(array $context = []): PinboardService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PinboardService(
                authToken: $creds->get('pinboard', 'auth_token', '', $account),
                baseUrl: $creds->get('pinboard', 'url', 'https://api.pinboard.in/v1', $account),
            );
        }

        return app(PinboardService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/pinboard.md';
    }
}
