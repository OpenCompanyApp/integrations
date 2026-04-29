<?php

namespace OpenCompany\Integrations\MakeCom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MakeCom\Tools\MakeComListScenarios;
use OpenCompany\Integrations\MakeCom\Tools\MakeComGetScenario;
use OpenCompany\Integrations\MakeCom\Tools\MakeComListExecutions;
use OpenCompany\Integrations\MakeCom\Tools\MakeComGetExecution;
use OpenCompany\Integrations\MakeCom\Tools\MakeComListConnections;
use OpenCompany\Integrations\MakeCom\Tools\MakeComListTeams;
use OpenCompany\Integrations\MakeCom\Tools\MakeComGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Make.com tools and provides integration metadata.
 *
 * Exposes 7 tools covering scenarios, executions, connections,
 * teams, and user profile via the ToolProvider contract.
 */
class MakeComToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'make-com';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Make.com',
            'description' => 'Automation Platform',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:make',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Make.com',
            'description' => 'Scenarios, executions, connections, and teams',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:make',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.make.com/en/api-documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Your Make.com API Token',
                'hint' => 'Generate at <code>https://www.make.com/en/user/api</code> under "API Token".',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Make.com connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'API Token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.make.com/v1/users/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = $data['name'] ?? $data['username'] ?? 'Unknown';
                $email = $data['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Make.com as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Make.com API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Scenarios
            'make_com_list_scenarios' => [
                'class' => MakeComListScenarios::class,
                'type' => 'read',
                'name' => 'List Scenarios',
                'description' => 'List Make.com scenarios with optional filters.',
                'icon' => 'ph:list',
            ],
            'make_com_get_scenario' => [
                'class' => MakeComGetScenario::class,
                'type' => 'read',
                'name' => 'Get Scenario',
                'description' => 'Get detailed information about a Make.com scenario.',
                'icon' => 'ph:flow-arrow',
            ],
            // Executions
            'make_com_list_executions' => [
                'class' => MakeComListExecutions::class,
                'type' => 'read',
                'name' => 'List Executions',
                'description' => 'List Make.com scenario executions with optional filters.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'make_com_get_execution' => [
                'class' => MakeComGetExecution::class,
                'type' => 'read',
                'name' => 'Get Execution',
                'description' => 'Get detailed information about a Make.com scenario execution.',
                'icon' => 'ph:eye',
            ],
            // Connections
            'make_com_list_connections' => [
                'class' => MakeComListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => 'List Make.com connections.',
                'icon' => 'ph:plugs',
            ],
            // Teams
            'make_com_list_teams' => [
                'class' => MakeComListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List Make.com teams (organizations).',
                'icon' => 'ph:users-three',
            ],
            // User
            'make_com_get_current_user' => [
                'class' => MakeComGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Make.com user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/make-com.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
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
     * Resolve the MakeComService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): MakeComService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MakeComService(
                apiToken: $creds->get('make-com', 'api_token', '', $account),
            );
        }

        return app(MakeComService::class);
    }
}
