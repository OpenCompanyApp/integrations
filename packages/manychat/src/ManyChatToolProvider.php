<?php

namespace OpenCompany\Integrations\ManyChat;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListFlows;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetFlow;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendMessage;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListTags;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatCreateTag;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ManyChatToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'manychat';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'flows, messages, tags, user',
            'description' => 'Chat marketing automation',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:manychat',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ManyChat',
            'description' => 'Chat marketing and automation platform for Instagram, Messenger, WhatsApp, and SMS',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:manychat',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://api.manychat.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ManyChat API key',
                'hint' => 'Find your API key in ManyChat under Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.manychat.com',
                'hint' => 'Default: <code>https://api.manychat.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.manychat.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.manychat.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach ManyChat API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to ManyChat API at {$baseUrl}.",
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
            'manychat_list_flows' => [
                'class' => ManyChatListFlows::class,
                'type' => 'read',
                'name' => 'List Flows',
                'description' => 'List all flows (pages) in your ManyChat account.',
                'icon' => 'ph:list',
            ],
            'manychat_get_flow' => [
                'class' => ManyChatGetFlow::class,
                'type' => 'read',
                'name' => 'Get Flow',
                'description' => 'Get details of a specific flow (page) by ID.',
                'icon' => 'ph:flow-arrow',
            ],
            'manychat_send_message' => [
                'class' => ManyChatSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message via Instagram, Messenger, or WhatsApp through ManyChat.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'manychat_list_tags' => [
                'class' => ManyChatListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List all tags in your ManyChat account.',
                'icon' => 'ph:tag',
            ],
            'manychat_create_tag' => [
                'class' => ManyChatCreateTag::class,
                'type' => 'write',
                'name' => 'Create Tag',
                'description' => 'Create a new tag in ManyChat.',
                'icon' => 'ph:tag',
            ],
            'manychat_get_current_user' => [
                'class' => ManyChatGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated ManyChat user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/manychat.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.manychat.com'],
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

            $service = new ManyChatService(
                apiKey: $creds->get('manychat', 'api_key', '', $account),
                baseUrl: $creds->get('manychat', 'url', 'https://api.manychat.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ManyChatService::class));
    }
}
