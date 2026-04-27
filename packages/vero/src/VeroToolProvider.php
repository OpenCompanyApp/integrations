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
            'label' => 'identify, track, subscribe, unsubscribe',
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
    }public function credentialFields(): array
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
