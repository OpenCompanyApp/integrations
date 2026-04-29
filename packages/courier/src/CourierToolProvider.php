<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Courier\Tools\CourierSendMessage;
use OpenCompany\Integrations\Courier\Tools\CourierListMessages;
use OpenCompany\Integrations\Courier\Tools\CourierGetMessage;
use OpenCompany\Integrations\Courier\Tools\CourierListRecipients;
use OpenCompany\Integrations\Courier\Tools\CourierGetRecipient;
use OpenCompany\Integrations\Courier\Tools\CourierListTemplates;
use OpenCompany\Integrations\Courier\Tools\CourierGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CourierToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'courier';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Courier',
            'description' => 'Notifications & messaging',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:courier',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Courier',
            'description' => 'Programmable notifications and messaging platform',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:courier',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://www.courier.com/docs/reference/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Courier API key',
                'hint' => 'Generate an API key in your Courier account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.courier.com',
                'hint' => 'Use <code>https://api.courier.com</code> for the default Courier API, or a custom endpoint',
                'default' => 'https://api.courier.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.courier.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Courier API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Courier API as " . ($json['user']['name'] ?? 'unknown user') . ".",
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
            'courier_send_message' => [
                'class' => CourierSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a notification message via Courier.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'courier_list_messages' => [
                'class' => CourierListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages with optional filtering and pagination.',
                'icon' => 'ph:envelope',
            ],
            'courier_get_message' => [
                'class' => CourierGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific message.',
                'icon' => 'ph:envelope-open',
            ],
            'courier_list_recipients' => [
                'class' => CourierListRecipients::class,
                'type' => 'read',
                'name' => 'List Recipients',
                'description' => 'List notification recipients.',
                'icon' => 'ph:users',
            ],
            'courier_get_recipient' => [
                'class' => CourierGetRecipient::class,
                'type' => 'read',
                'name' => 'Get Recipient',
                'description' => 'Get details of a specific recipient.',
                'icon' => 'ph:user',
            ],
            'courier_list_templates' => [
                'class' => CourierListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List notification templates.',
                'icon' => 'ph:file-text',
            ],
            'courier_get_current_user' => [
                'class' => CourierGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Courier user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/courier.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Courier API URL', 'required' => false, 'default' => 'https://api.courier.com'],
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

            $service = new CourierService(
                apiKey: $creds->get('courier', 'api_key', '', $account),
                baseUrl: $creds->get('courier', 'url', 'https://api.courier.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(CourierService::class));
    }
}
