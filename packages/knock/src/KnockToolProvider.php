<?php

namespace OpenCompany\Integrations\Knock;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Knock\Tools\KnockListWorkflows;
use OpenCompany\Integrations\Knock\Tools\KnockGetWorkflow;
use OpenCompany\Integrations\Knock\Tools\KnockTriggerWorkflow;
use OpenCompany\Integrations\Knock\Tools\KnockListMessages;
use OpenCompany\Integrations\Knock\Tools\KnockGetMessage;
use OpenCompany\Integrations\Knock\Tools\KnockListRecipients;
use OpenCompany\Integrations\Knock\Tools\KnockGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KnockToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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
        return 'knock';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Knock',
            'description' => 'Notification engine',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:knock',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Knock',
            'description' => 'Notification engine for developers — trigger workflows, manage messages and recipients',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:knock',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.knock.app',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Knock API key',
                'hint' => 'Find your API key in the Knock dashboard under "Settings → API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.knock.app',
                'hint' => 'Use <code>https://api.knock.app</code> for the cloud API, or your self-hosted URL',
                'default' => 'https://api.knock.app',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.knock.app', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Knock API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Knock API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'knock_list_workflows' => [
                'class' => KnockListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List notification workflows.',
                'icon' => 'ph:flow-arrow',
            ],
            'knock_get_workflow' => [
                'class' => KnockGetWorkflow::class,
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Get details of a specific workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'knock_trigger_workflow' => [
                'class' => KnockTriggerWorkflow::class,
                'type' => 'write',
                'name' => 'Trigger Workflow',
                'description' => 'Trigger a notification workflow for recipients.',
                'icon' => 'ph:play',
            ],
            'knock_list_messages' => [
                'class' => KnockListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List notification messages.',
                'icon' => 'ph:envelope',
            ],
            'knock_get_message' => [
                'class' => KnockGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific message.',
                'icon' => 'ph:envelope',
            ],
            'knock_list_recipients' => [
                'class' => KnockListRecipients::class,
                'type' => 'read',
                'name' => 'List Recipients',
                'description' => 'List notification recipients.',
                'icon' => 'ph:users',
            ],
            'knock_get_current_user' => [
                'class' => KnockGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/knock.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Knock URL', 'required' => false, 'default' => 'https://api.knock.app'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new KnockService(
                apiKey: $creds->get('knock', 'api_key', '', $account),
                baseUrl: $creds->get('knock', 'url', 'https://api.knock.app', $account),
            );

            return new $class($service);
        }

        return new $class(app(KnockService::class));
    }
}
