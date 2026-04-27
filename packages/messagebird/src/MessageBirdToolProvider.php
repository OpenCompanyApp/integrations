<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendSms;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListMessages;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListBalance;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListNumbers;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MessageBirdToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'messagebird';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sms, messages, balance, numbers',
            'description' => 'SMS & messaging',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:messagebird',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'MessageBird',
            'description' => 'SMS, voice, and messaging platform',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:messagebird',
            'category' => 'messaging',
            'badge' => 'verified',
            'docs_url' => 'https://developers.messagebird.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your MessageBird API key',
                'hint' => 'Generate an API key in your MessageBird dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.messagebird.com',
                'hint' => 'Use <code>https://api.messagebird.com</code> for the live API, or a custom endpoint',
                'default' => 'https://api.messagebird.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.messagebird.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Access-Key ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/balance');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach MessageBird API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to MessageBird API at {$baseUrl}.",
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
            'messagebird_send_sms' => [
                'class' => MessageBirdSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message to one or more recipients.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'messagebird_get_message' => [
                'class' => MessageBirdGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Retrieve details of a specific message.',
                'icon' => 'ph:envelope',
            ],
            'messagebird_list_messages' => [
                'class' => MessageBirdListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List sent and received messages with filters.',
                'icon' => 'ph:list-bullets',
            ],
            'messagebird_list_balance' => [
                'class' => MessageBirdListBalance::class,
                'type' => 'read',
                'name' => 'List Balance',
                'description' => 'Check your MessageBird account balance.',
                'icon' => 'ph:wallet',
            ],
            'messagebird_list_numbers' => [
                'class' => MessageBirdListNumbers::class,
                'type' => 'read',
                'name' => 'List Numbers',
                'description' => 'List purchased phone numbers.',
                'icon' => 'ph:phone',
            ],
            'messagebird_get_current_user' => [
                'class' => MessageBirdGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current account information and balance.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/messagebird.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.messagebird.com'],
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

            $service = new MessageBirdService(
                apiKey: $creds->get('messagebird', 'api_key', '', $account),
                baseUrl: $creds->get('messagebird', 'url', 'https://api.messagebird.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(MessageBirdService::class));
    }
}
