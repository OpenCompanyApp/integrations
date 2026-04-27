<?php

namespace OpenCompany\Integrations\Ifttt;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ifttt\Tools\IftttListServices;
use OpenCompany\Integrations\Ifttt\Tools\IftttGetService;
use OpenCompany\Integrations\Ifttt\Tools\IftttListApplets;
use OpenCompany\Integrations\Ifttt\Tools\IftttGetApplet;
use OpenCompany\Integrations\Ifttt\Tools\IftttListConnections;
use OpenCompany\Integrations\Ifttt\Tools\IftttGetConnection;
use OpenCompany\Integrations\Ifttt\Tools\IftttGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all IFTTT tools and provides integration metadata.
 *
 * Exposes 7 tools covering services, applets, connections,
 * and the current user via the ToolProvider contract.
 */
class IftttToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'ifttt';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'services, applets, and connections',
            'description' => 'Automation',
            'icon' => 'ph:plugs-connected',
            'logo' => 'simple-icons:ifttt',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'IFTTT',
            'description' => 'Services, applets, connections, and automation workflows',
            'icon' => 'ph:plugs-connected',
            'logo' => 'simple-icons:ifttt',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://platform.ifttt.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Your IFTTT API Token',
                'hint' => 'Generate at <code>https://platform.ifttt.com</code> under your app settings.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the IFTTT connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access Token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.ifttt.com/v1/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = $data['name'] ?? $data['login'] ?? 'Unknown';
                $email = $data['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to IFTTT as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'IFTTT API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'ifttt_list_services' => [
                'class' => IftttListServices::class,
                'type' => 'read',
                'name' => 'List Services',
                'description' => 'List services in IFTTT with optional filters.',
                'icon' => 'ph:squares-four',
            ],
            'ifttt_get_service' => [
                'class' => IftttGetService::class,
                'type' => 'read',
                'name' => 'Get Service',
                'description' => 'Get detailed information about an IFTTT service.',
                'icon' => 'ph:square',
            ],
            'ifttt_list_applets' => [
                'class' => IftttListApplets::class,
                'type' => 'read',
                'name' => 'List Applets',
                'description' => 'List applets in IFTTT with optional filters.',
                'icon' => 'ph:list-bullets',
            ],
            'ifttt_get_applet' => [
                'class' => IftttGetApplet::class,
                'type' => 'read',
                'name' => 'Get Applet',
                'description' => 'Get detailed information about an IFTTT applet.',
                'icon' => 'ph:puzzle-piece',
            ],
            'ifttt_list_connections' => [
                'class' => IftttListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => 'List connections in IFTTT with optional filters.',
                'icon' => 'ph:plugs',
            ],
            'ifttt_get_connection' => [
                'class' => IftttGetConnection::class,
                'type' => 'read',
                'name' => 'Get Connection',
                'description' => 'Get detailed information about an IFTTT connection.',
                'icon' => 'ph:plug',
            ],
            'ifttt_get_current_user' => [
                'class' => IftttGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated IFTTT user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ifttt.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the IftttService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): IftttService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new IftttService(
                accessToken: $creds->get('ifttt', 'access_token', '', $account),
            );
        }

        return app(IftttService::class);
    }
}
