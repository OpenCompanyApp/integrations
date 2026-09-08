<?php

namespace OpenCompany\Integrations\Zapier;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zapier\Tools\ZapierListZaps;
use OpenCompany\Integrations\Zapier\Tools\ZapierGetZap;
use OpenCompany\Integrations\Zapier\Tools\ZapierListExecutions;
use OpenCompany\Integrations\Zapier\Tools\ZapierGetExecution;
use OpenCompany\Integrations\Zapier\Tools\ZapierListConnections;
use OpenCompany\Integrations\Zapier\Tools\ZapierGetConnection;
use OpenCompany\Integrations\Zapier\Tools\ZapierGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Zapier tools and provides integration metadata.
 *
 * Exposes 7 tools covering zaps, executions, connections,
 * and the current user via the ToolProvider contract.
 */
class ZapierToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'zapier';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Zapier',
            'description' => 'Automation',
            'icon' => 'ph:lightning',
            'logo' => 'simple-icons:zapier',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zapier',
            'description' => 'Zaps, executions, connections, and automation workflows',
            'icon' => 'ph:lightning',
            'logo' => 'simple-icons:zapier',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zapier.com/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Your Zapier API Token',
                'hint' => 'Generate at <code>https://developer.zapier.com</code> under your app settings.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Zapier connection using the provided credentials.
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
            ])->timeout(10)->get('https://zapier.com/api/v1/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = $data['name'] ?? $data['first_name'] ?? 'Unknown';
                $email = $data['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Zapier as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Zapier API error (' . $response->status() . '): ' . $response->body(),
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
            'zapier_list_zaps' => [
                'class' => ZapierListZaps::class,
                'type' => 'read',
                'name' => 'List Zaps',
                'description' => 'List zaps in Zapier with optional filters.',
                'icon' => 'ph:list-bullets',
            ],
            'zapier_get_zap' => [
                'class' => ZapierGetZap::class,
                'type' => 'read',
                'name' => 'Get Zap',
                'description' => 'Get detailed information about a Zapier zap.',
                'icon' => 'ph:lightning',
            ],
            'zapier_list_executions' => [
                'class' => ZapierListExecutions::class,
                'type' => 'read',
                'name' => 'List Executions',
                'description' => 'List zap executions in Zapier with optional filters.',
                'icon' => 'ph:play',
            ],
            'zapier_get_execution' => [
                'class' => ZapierGetExecution::class,
                'type' => 'read',
                'name' => 'Get Execution',
                'description' => 'Get detailed information about a Zapier execution.',
                'icon' => 'ph:file-text',
            ],
            'zapier_list_connections' => [
                'class' => ZapierListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => 'List connections in Zapier with optional filters.',
                'icon' => 'ph:plugs',
            ],
            'zapier_get_connection' => [
                'class' => ZapierGetConnection::class,
                'type' => 'read',
                'name' => 'Get Connection',
                'description' => 'Get detailed information about a Zapier connection.',
                'icon' => 'ph:plug',
            ],
            'zapier_get_current_user' => [
                'class' => ZapierGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zapier user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/zapier.md';
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
     * Resolve the ZapierService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZapierService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZapierService(
                accessToken: $creds->get('zapier', 'access_token', '', $account),
            );
        }

        return app(ZapierService::class);
    }
}
