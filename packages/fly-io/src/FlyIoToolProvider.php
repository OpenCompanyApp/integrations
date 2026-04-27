<?php

namespace OpenCompany\Integrations\FlyIo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListApps;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoGetApp;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoCreateApp;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListMachines;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoGetMachine;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListVolumes;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FlyIoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string { return 'fly-io'; }

    public function appMeta(): array
    {
        return [
            'label' => 'apps, machines, volumes',
            'description' => 'Cloud platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:flyio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Fly.io',
            'description' => 'Cloud platform — deploy apps, manage machines, and persistent volumes',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:flyio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.machines.dev/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Fly.io API token',
                'hint' => 'Generate a token via <strong>fly auth token</strong> or in the Fly.io dashboard under <strong>Access Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.machines.dev/v1',
                'hint' => 'Override only if using a custom Fly.io-compatible endpoint',
                'default' => 'https://api.machines.dev/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.machines.dev/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return ['success' => false, 'error' => "Could not reach Fly.io API at {$baseUrl}. Check the URL."];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $json['error'] ?? $response->body();
                return ['success' => false, 'error' => "Fly.io API error ({$response->status()}): {$message}"];
            }

            $email = $json['email'] ?? 'unknown';

            return ['success' => true, 'message' => "Connected to Fly.io as {$email}."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'fly_io_list_apps' => [
                'class' => FlyIoListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all Fly.io apps in the organization.',
                'icon' => 'ph:folder',
            ],
            'fly_io_get_app' => [
                'class' => FlyIoGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details for a specific Fly.io app.',
                'icon' => 'ph:folder-open',
            ],
            'fly_io_create_app' => [
                'class' => FlyIoCreateApp::class,
                'type' => 'write',
                'name' => 'Create App',
                'description' => 'Create a new Fly.io app.',
                'icon' => 'ph:plus-circle',
            ],
            'fly_io_list_machines' => [
                'class' => FlyIoListMachines::class,
                'type' => 'read',
                'name' => 'List Machines',
                'description' => 'List all machines for a Fly.io app.',
                'icon' => 'ph:cpu',
            ],
            'fly_io_get_machine' => [
                'class' => FlyIoGetMachine::class,
                'type' => 'read',
                'name' => 'Get Machine',
                'description' => 'Get details for a specific machine.',
                'icon' => 'ph:cpu',
            ],
            'fly_io_list_volumes' => [
                'class' => FlyIoListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List all persistent volumes for a Fly.io app.',
                'icon' => 'ph:hard-drives',
            ],
            'fly_io_get_current_user' => [
                'class' => FlyIoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Fly.io user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fly-io.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.machines.dev/v1'],
        ];
    }

    public function isIntegration(): bool { return true; }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FlyIoService(
                accessToken: $creds->get('fly-io', 'access_token', '', $account),
                baseUrl: $creds->get('fly-io', 'url', 'https://api.machines.dev/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(FlyIoService::class));
    }
}
