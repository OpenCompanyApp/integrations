<?php

namespace OpenCompany\Integrations\Vero;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vero\Tools\VeroAliasUser;
use OpenCompany\Integrations\Vero\Tools\VeroApiDelete;
use OpenCompany\Integrations\Vero\Tools\VeroApiGet;
use OpenCompany\Integrations\Vero\Tools\VeroApiPost;
use OpenCompany\Integrations\Vero\Tools\VeroApiPut;
use OpenCompany\Integrations\Vero\Tools\VeroDeleteUser;
use OpenCompany\Integrations\Vero\Tools\VeroEditTags;
use OpenCompany\Integrations\Vero\Tools\VeroGetCurrentUser;
use OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser;
use OpenCompany\Integrations\Vero\Tools\VeroResubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;
use OpenCompany\Integrations\Vero\Tools\VeroUnsubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroUpdateUser;

/**
 * Tool provider for the Vero Track REST API integration.
 *
 * Exposes user, tag, event, and generic API tools with multi-account credential
 * resolution for OpenCompany and KosmoKrator hosts.
 */
class VeroToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Vero Track API expects auth_token as a query parameter.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
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
        return 'vero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Vero',
            'description' => 'Email marketing automation and tracking',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vero',
            'description' => 'Email marketing automation with user identity, tag, event, and subscription tools',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://vero-c561507b.mintlify.app/api-reference/track/overview',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']).' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. Vero API access is verified when a tool sends data.',
        ];
    }

    public function validationRules(): array
    {
        return [
            'auth_token' => 'required|string',
            'url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'vero_get_current_user' => [
                'class' => VeroGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Vero Get Current User',
                'description' => 'Return local Vero Track API configuration status. Vero does not expose a current-user endpoint.',
                'icon' => 'ph:plug',
            ],
            'vero_identify_user' => [
                'class' => VeroIdentifyUser::class,
                'type' => 'write',
                'name' => 'Vero Identify User',
                'description' => 'Create or update a user profile via POST /users/track, including custom attributes and channel records.',
                'icon' => 'ph:user-plus',
            ],
            'vero_update_user' => [
                'class' => VeroUpdateUser::class,
                'type' => 'write',
                'name' => 'Vero Update User',
                'description' => 'Compatibility profile update tool backed by Vero identify, because updates use POST /users/track.',
                'icon' => 'ph:user-circle-gear',
            ],
            'vero_alias_user' => [
                'class' => VeroAliasUser::class,
                'type' => 'write',
                'name' => 'Vero Alias User',
                'description' => 'Change a user identifier through PUT /users/reidentify and merge identities.',
                'icon' => 'ph:git-merge',
            ],
            'vero_unsubscribe' => [
                'class' => VeroUnsubscribe::class,
                'type' => 'write',
                'name' => 'Vero Unsubscribe',
                'description' => 'Globally unsubscribe a user from Vero email communication.',
                'icon' => 'ph:envelope-simple-x',
            ],
            'vero_resubscribe' => [
                'class' => VeroResubscribe::class,
                'type' => 'write',
                'name' => 'Vero Resubscribe',
                'description' => 'Globally resubscribe a previously unsubscribed user.',
                'icon' => 'ph:envelope-simple',
            ],
            'vero_delete_user' => [
                'class' => VeroDeleteUser::class,
                'type' => 'write',
                'name' => 'Vero Delete User',
                'description' => 'Permanently delete a Vero user profile and activity.',
                'icon' => 'ph:trash',
            ],
            'vero_edit_tags' => [
                'class' => VeroEditTags::class,
                'type' => 'write',
                'name' => 'Vero Edit Tags',
                'description' => 'Add or remove tags from a Vero user profile via PUT /users/tags/edit.',
                'icon' => 'ph:tag',
            ],
            'vero_track_event' => [
                'class' => VeroTrackEvent::class,
                'type' => 'write',
                'name' => 'Vero Track Event',
                'description' => 'Track a behavioral event through POST /events/track, with identity, data, and extras.',
                'icon' => 'ph:activity',
            ],
            'vero_api_get' => [
                'class' => VeroApiGet::class,
                'type' => 'read',
                'name' => 'Vero API GET',
                'description' => 'Call a relative Vero API GET path for documented endpoints without a first-class tool.',
                'icon' => 'ph:brackets-curly',
            ],
            'vero_api_post' => [
                'class' => VeroApiPost::class,
                'type' => 'write',
                'name' => 'Vero API POST',
                'description' => 'Call a relative Vero API POST path for documented endpoints without a first-class tool.',
                'icon' => 'ph:brackets-curly',
            ],
            'vero_api_put' => [
                'class' => VeroApiPut::class,
                'type' => 'write',
                'name' => 'Vero API PUT',
                'description' => 'Call a relative Vero API PUT path for documented endpoints without a first-class tool.',
                'icon' => 'ph:brackets-curly',
            ],
            'vero_api_delete' => [
                'class' => VeroApiDelete::class,
                'type' => 'write',
                'name' => 'Vero API DELETE',
                'description' => 'Call a relative Vero API DELETE path for documented endpoints without a first-class tool.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__).'/script-docs/vero.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getvero.com/api/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context (may contain account).
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Vero service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context (may contain account).
     */
    private function resolveService(array $context = []): VeroService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new VeroService(
                authToken: $creds->get('vero', 'auth_token', '', $account),
                baseUrl: $creds->get('vero', 'url', 'https://api.getvero.com/api/v2', $account),
            );
        }

        return app(VeroService::class);
    }
}
