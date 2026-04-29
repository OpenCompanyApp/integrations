<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Crisp\Tools\CrispListConversations;
use OpenCompany\Integrations\Crisp\Tools\CrispGetConversation;
use OpenCompany\Integrations\Crisp\Tools\CrispSendMessage;
use OpenCompany\Integrations\Crisp\Tools\CrispListContacts;
use OpenCompany\Integrations\Crisp\Tools\CrispGetContact;
use OpenCompany\Integrations\Crisp\Tools\CrispListCampaigns;
use OpenCompany\Integrations\Crisp\Tools\CrispGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * CrispToolProvider — registers Crisp tools and integration metadata.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * provides configuration schema for the OpenCompany Integrations UI.
 */
class CrispToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'crisp';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Crisp',
            'description' => 'Live chat & messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:crisp',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Crisp',
            'description' => 'Customer messaging platform — live chat, chatbots, and campaigns',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:crisp',
            'category' => 'messaging',
            'badge' => 'verified',
            'docs_url' => 'https://docs.crisp.chat/guides/rest-api/rate-limiting/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key (Token ID)',
                'placeholder' => 'Enter your Crisp API token identifier',
                'hint' => 'Generate an API token in your Crisp dashboard under <strong>Plugins → Marketplace → Custom API</strong>. Use the <strong>Token ID</strong> as the API key.',
                'required' => true,
            ],
            [
                'key' => 'website_id',
                'type' => 'string',
                'label' => 'Website ID',
                'placeholder' => 'e.g., a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'hint' => 'Find your Website ID in Crisp under <strong>Settings → Site Settings</strong>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.crisp.chat/v1',
                'hint' => 'Override only if using a custom Crisp API proxy.',
                'default' => 'https://api.crisp.chat/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $websiteId = $config['website_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.crisp.chat/v1', '/');

        if (empty($apiKey) || empty($websiteId)) {
            return ['success' => false, 'error' => 'API key and Website ID are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, $websiteId)
              ->timeout(10)
              ->get("{$baseUrl}/user");

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Crisp API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['reason'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Crisp API for website {$websiteId}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'website_id' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'crisp_list_conversations' => [
                'class' => CrispListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List chat conversations for the website.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'crisp_get_conversation' => [
                'class' => CrispGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get details and messages of a specific conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'crisp_send_message' => [
                'class' => CrispSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message in a conversation.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'crisp_list_contacts' => [
                'class' => CrispListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts for the website.',
                'icon' => 'ph:users',
            ],
            'crisp_get_contact' => [
                'class' => CrispGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'crisp_list_campaigns' => [
                'class' => CrispListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List marketing campaigns for the website.',
                'icon' => 'ph:megaphone',
            ],
            'crisp_get_current_user' => [
                'class' => CrispGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/crisp.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key (Token ID)', 'required' => true],
            ['key' => 'website_id', 'type' => 'string', 'label' => 'Website ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.crisp.chat/v1'],
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

            $service = new CrispService(
                apiKey: $creds->get('crisp', 'api_key', '', $account),
                websiteId: $creds->get('crisp', 'website_id', '', $account),
                baseUrl: $creds->get('crisp', 'url', 'https://api.crisp.chat/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CrispService::class));
    }
}
