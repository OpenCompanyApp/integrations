<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vero\Tools\VeroGetCurrentUser;
use OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser;
use OpenCompany\Integrations\Vero\Tools\VeroResubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;
use OpenCompany\Integrations\Vero\Tools\VeroUnsubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroUpdateUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Vero',
            'description' => 'Email marketing — user identity, event tracking, and subscription management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://developers.getvero.com/rest-api/',
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
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
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
                'description' => 'Get the profile of the currently authenticated Vero user. Useful for verifying API connectivity and checking account details.',
                'icon' => 'ph:wrench',
            ],
            'vero_identify_user' => [
                'class' => VeroIdentifyUser::class,
                'type' => 'read',
                'name' => 'Vero Identify User',
                'description' => 'Identify (create or update) a user in Vero. Pass a unique user ID, email, optional name, and any custom attributes in the data object. This creates the user if they don\'t exist, or updates their profile if they do.',
                'icon' => 'ph:wrench',
            ],
            'vero_resubscribe' => [
                'class' => VeroResubscribe::class,
                'type' => 'read',
                'name' => 'Vero Resubscribe',
                'description' => 'Resubscribe a previously unsubscribed user to Vero email campaigns. The user will start receiving emails again.',
                'icon' => 'ph:wrench',
            ],
            'vero_track_event' => [
                'class' => VeroTrackEvent::class,
                'type' => 'read',
                'name' => 'Vero Track Event',
                'description' => 'Track a behavioral event for a user in Vero. Events can trigger automated email campaigns. Pass a user identity (ID or email), event name, and optional event data.',
                'icon' => 'ph:wrench',
            ],
            'vero_unsubscribe' => [
                'class' => VeroUnsubscribe::class,
                'type' => 'read',
                'name' => 'Vero Unsubscribe',
                'description' => 'Unsubscribe a user from all Vero email campaigns. The user will no longer receive any email communication.',
                'icon' => 'ph:wrench',
            ],
            'vero_update_user' => [
                'class' => VeroUpdateUser::class,
                'type' => 'write',
                'name' => 'Vero Update User',
                'description' => 'Update a user\'s profile in Vero. Pass the user ID, an optional new email, and a data object with attributes to update.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/vero.md';
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
     * @param  array<string, mixed>  $context  Runtime context (may contain 'account' key).
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new VeroService(
                authToken: $creds->get('vero', 'auth_token', '', $account),
                baseUrl: $creds->get('vero', 'url', 'https://api.getvero.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(VeroService::class));
    }
}
