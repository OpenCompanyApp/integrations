<?php

namespace OpenCompany\Integrations\Pocket;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Pocket.
 *
 * Exposes Pocket v3 OAuth setup, add, retrieve, and modify endpoints with
 * focused agent tools for common list and tag actions.
 */
class PocketToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'pocket_request_token' => ['PocketRequestToken', 'write', 'Request Token', 'Create a Pocket OAuth request token for an authorization redirect.', 'ph:key'],
        'pocket_authorize_url' => ['PocketAuthorizeUrl', 'read', 'Authorize URL', 'Build the Pocket web authorization URL for a request token.', 'ph:link'],
        'pocket_access_token' => ['PocketAccessToken', 'write', 'Access Token', 'Exchange an approved request token for a Pocket access token.', 'ph:lock-key'],
        'pocket_add_item' => ['PocketAddItem', 'write', 'Add Item', 'Save one URL to Pocket.', 'ph:bookmark-simple'],
        'pocket_retrieve_items' => ['PocketRetrieveItems', 'read', 'Retrieve Items', 'Retrieve Pocket list items with filtering and pagination.', 'ph:list-magnifying-glass'],
        'pocket_send_actions' => ['PocketSendActions', 'write', 'Send Actions', 'Send one or more raw Pocket modify actions.', 'ph:stack'],
        'pocket_archive_item' => ['PocketArchiveItem', 'write', 'Archive Item', 'Move a Pocket item to archive.', 'ph:archive'],
        'pocket_readd_item' => ['PocketReaddItem', 'write', 'Readd Item', 'Move an archived Pocket item back to unread.', 'ph:tray'],
        'pocket_favorite_item' => ['PocketFavoriteItem', 'write', 'Favorite Item', 'Mark a Pocket item as favorite.', 'ph:star'],
        'pocket_unfavorite_item' => ['PocketUnfavoriteItem', 'write', 'Unfavorite Item', 'Remove favorite status from a Pocket item.', 'ph:star-half'],
        'pocket_delete_item' => ['PocketDeleteItem', 'write', 'Delete Item', 'Permanently delete a Pocket item.', 'ph:trash'],
        'pocket_add_tags' => ['PocketAddTags', 'write', 'Add Tags', 'Add tags to a Pocket item.', 'ph:tag-simple'],
        'pocket_remove_tags' => ['PocketRemoveTags', 'write', 'Remove Tags', 'Remove tags from a Pocket item.', 'ph:tag-chevron'],
        'pocket_replace_tags' => ['PocketReplaceTags', 'write', 'Replace Tags', 'Replace all tags on a Pocket item.', 'ph:tags'],
        'pocket_clear_tags' => ['PocketClearTags', 'write', 'Clear Tags', 'Clear all tags from a Pocket item.', 'ph:eraser'],
        'pocket_rename_tag' => ['PocketRenameTag', 'write', 'Rename Tag', 'Rename a Pocket tag across the account.', 'ph:pencil-simple'],
        'pocket_delete_tag' => ['PocketDeleteTag', 'write', 'Delete Tag', 'Delete a Pocket tag across the account.', 'ph:tag'],
        'pocket_api_post' => ['PocketApiPost', 'write', 'API POST', 'Call a safe relative Pocket v3 POST path.', 'ph:code'],
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
                'strategy' => 'oauth2_variant',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret', 'oauth_request_token'],
                'requires_browser_for_setup' => true,
                'refreshable' => false,
                'token_keys' => ['consumer_key', 'access_token'],
                'notes' => ['Pocket v3 uses a consumer key plus user access token in JSON request bodies.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'oauth_manual_exchange'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'oauth_manual_exchange', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'pocket'; }

    public function appMeta(): array
    {
        return ['label' => 'Pocket', 'description' => 'Saved articles, retrieval, archive, favorites, deletion, and tags', 'icon' => 'ph:pocket-logo', 'logo' => 'ph:pocket-logo'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pocket',
            'description' => 'Manage Pocket OAuth setup, saves, retrieval, archive, favorites, deletion, and tag actions.',
            'icon' => 'ph:pocket-logo',
            'logo' => 'ph:pocket-logo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://getpocket.com/developer/docs/v3/retrieve',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Pocket credentials with a small retrieve request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            if ((string) ($config['consumer_key'] ?? '') === '') {
                return ['success' => false, 'error' => 'Pocket consumer key is required.'];
            }

            if ((string) ($config['access_token'] ?? '') === '') {
                return ['success' => false, 'error' => 'Pocket access token is required.'];
            }

            $service = new PocketService(
                consumerKey: (string) $config['consumer_key'],
                accessToken: (string) $config['access_token'],
                baseUrl: (string) ($config['url'] ?? 'https://getpocket.com'),
            );
            $service->retrieve(['count' => 1, 'detailType' => 'simple']);

            return ['success' => true, 'message' => 'Connected to Pocket API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['consumer_key' => 'required|string', 'access_token' => 'nullable|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'consumer_key', 'type' => 'secret', 'label' => 'Consumer Key', 'placeholder' => '1234-abcd1234abcd1234abcd1234', 'hint' => 'Pocket platform consumer key.', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Pocket user access token', 'hint' => 'User access token returned by the Pocket OAuth authorize step.', 'required' => false],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://getpocket.com', 'hint' => 'Optional Pocket base URL override.', 'required' => false],
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
     * Create a Pocket tool instance.
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
    private function resolveService(array $context = []): PocketService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PocketService(
                consumerKey: $creds->get('pocket', 'consumer_key', '', $account),
                accessToken: $creds->get('pocket', 'access_token', '', $account),
                baseUrl: $creds->get('pocket', 'url', 'https://getpocket.com', $account),
            );
        }

        return app(PocketService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/pocket.md';
    }
}
