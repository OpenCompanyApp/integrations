<?php

namespace OpenCompany\Integrations\Front;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Front\Tools\FrontListConversations;
use OpenCompany\Integrations\Front\Tools\FrontGetConversation;
use OpenCompany\Integrations\Front\Tools\FrontListMessages;
use OpenCompany\Integrations\Front\Tools\FrontSendMessage;
use OpenCompany\Integrations\Front\Tools\FrontListContacts;
use OpenCompany\Integrations\Front\Tools\FrontGetContact;
use OpenCompany\Integrations\Front\Tools\FrontGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FrontToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'front';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'conversations, messages, contacts',
            'description' => 'Customer communication platform',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:front',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Front',
            'description' => 'Customer communication platform — manage conversations, messages, and contacts',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:front',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://dev.frontapp.com/docs/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Front API access token',
                'hint' => 'Generate an API token in Front under Settings → Plugins & API → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api2.frontapp.com',
                'hint' => 'Use the default <code>https://api2.frontapp.com</code> unless using a custom API endpoint',
                'default' => 'https://api2.frontapp.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api2.frontapp.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Front API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to Front API as {$name}.",
            ];
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
            'front_list_conversations' => [
                'class' => FrontListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List and search conversations in Front.',
                'icon' => 'ph:list-dashes',
            ],
            'front_get_conversation' => [
                'class' => FrontGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get details of a specific conversation.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'front_list_messages' => [
                'class' => FrontListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a conversation.',
                'icon' => 'ph:envelope',
            ],
            'front_send_message' => [
                'class' => FrontSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a reply to a conversation.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'front_list_contacts' => [
                'class' => FrontListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List and search contacts in Front.',
                'icon' => 'ph:address-book',
            ],
            'front_get_contact' => [
                'class' => FrontGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'front_get_current_user' => [
                'class' => FrontGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/front.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api2.frontapp.com'],
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

            $service = new FrontService(
                accessToken: $creds->get('front', 'access_token', '', $account),
                baseUrl: $creds->get('front', 'url', 'https://api2.frontapp.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(FrontService::class));
    }
}
