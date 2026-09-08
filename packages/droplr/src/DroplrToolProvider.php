<?php

namespace OpenCompany\Integrations\Droplr;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Droplr\Tools\DroplrApiDelete;
use OpenCompany\Integrations\Droplr\Tools\DroplrApiGet;
use OpenCompany\Integrations\Droplr\Tools\DroplrApiPost;
use OpenCompany\Integrations\Droplr\Tools\DroplrApiPut;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateDropRaw;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateNote;
use OpenCompany\Integrations\Droplr\Tools\DroplrDeleteDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrGetCurrentUser;
use OpenCompany\Integrations\Droplr\Tools\DroplrGetDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrListBoards;
use OpenCompany\Integrations\Droplr\Tools\DroplrListDrops;
use OpenCompany\Integrations\Droplr\Tools\DroplrUpdateCurrentUser;
use OpenCompany\Integrations\Droplr\Tools\DroplrUpdateDrop;

/**
 * Exposes Droplr tools and credential metadata to host applications.
 */
class DroplrToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [
                    'Droplr public documentation also describes an older HMAC signature scheme. This package preserves bearer-token host behavior and exposes generic helpers for additional documented endpoints.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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
        return 'droplr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Droplr',
            'description' => 'Link shortening and file sharing',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:droplr',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Droplr',
            'description' => 'Link shortening, file sharing, and screenshot tool',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:droplr',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://droplr.github.io/docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Droplr access token',
                'hint' => 'Store the Droplr token used by your host API connection.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.droplr.com',
                'hint' => 'Use https://api.droplr.com unless you are targeting a Droplr-compatible environment.',
                'default' => 'https://api.droplr.com',
            ],
        ];
    }

    /**
     * Verify credentials with a lightweight profile request.
     *
     * @param  array<string, mixed>  $config  Droplr connection configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = trim((string) ($config['access_token'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $service = new DroplrService(
                accessToken: $accessToken,
                baseUrl: (string) ($config['url'] ?? 'https://api.droplr.com'),
            );
            $data = $service->getCurrentUser();
            $email = is_string($data['email'] ?? null) ? $data['email'] : 'Droplr';

            return [
                'success' => true,
                'message' => "Connected to Droplr API as {$email}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'droplr_list_drops' => ['class' => DroplrListDrops::class, 'type' => 'read', 'name' => 'List Drops', 'description' => 'List drops with filtering and sorting.', 'icon' => 'ph:list'],
            'droplr_get_drop' => ['class' => DroplrGetDrop::class, 'type' => 'read', 'name' => 'Get Drop', 'description' => 'Get one drop.', 'icon' => 'ph:link'],
            'droplr_create_drop' => ['class' => DroplrCreateDrop::class, 'type' => 'write', 'name' => 'Create Link Drop', 'description' => 'Create a short-link drop.', 'icon' => 'ph:plus'],
            'droplr_create_note' => ['class' => DroplrCreateNote::class, 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create a note drop.', 'icon' => 'ph:note-pencil'],
            'droplr_create_drop_raw' => ['class' => DroplrCreateDropRaw::class, 'type' => 'write', 'name' => 'Create Drop Raw', 'description' => 'Create a drop from a raw payload.', 'icon' => 'ph:brackets-curly'],
            'droplr_update_drop' => ['class' => DroplrUpdateDrop::class, 'type' => 'write', 'name' => 'Update Drop', 'description' => 'Update one drop.', 'icon' => 'ph:pencil-simple'],
            'droplr_delete_drop' => ['class' => DroplrDeleteDrop::class, 'type' => 'write', 'name' => 'Delete Drop', 'description' => 'Delete a drop.', 'icon' => 'ph:trash'],
            'droplr_list_boards' => ['class' => DroplrListBoards::class, 'type' => 'read', 'name' => 'List Boards', 'description' => 'List boards.', 'icon' => 'ph:folder'],
            'droplr_get_current_user' => ['class' => DroplrGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get current user profile.', 'icon' => 'ph:user'],
            'droplr_update_current_user' => ['class' => DroplrUpdateCurrentUser::class, 'type' => 'write', 'name' => 'Update Current User', 'description' => 'Update account fields.', 'icon' => 'ph:user-gear'],
            'droplr_api_get' => ['class' => DroplrApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a Droplr GET endpoint.', 'icon' => 'ph:terminal-window'],
            'droplr_api_post' => ['class' => DroplrApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a Droplr POST endpoint.', 'icon' => 'ph:terminal-window'],
            'droplr_api_put' => ['class' => DroplrApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a Droplr PUT endpoint.', 'icon' => 'ph:terminal-window'],
            'droplr_api_delete' => ['class' => DroplrApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a Droplr DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/droplr.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.droplr.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Droplr service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): DroplrService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DroplrService(
                accessToken: $creds->get('droplr', 'access_token', '', $account),
                baseUrl: $creds->get('droplr', 'url', 'https://api.droplr.com', $account),
            );
        }

        return app(DroplrService::class);
    }
}
