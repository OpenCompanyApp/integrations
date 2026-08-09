<?php

namespace OpenCompany\Integrations\Intercom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Intercom\Tools\IntercomGetContact;
use OpenCompany\Integrations\Intercom\Tools\IntercomGetCurrentUser;
use OpenCompany\Integrations\Intercom\Tools\IntercomListContacts;
use OpenCompany\Integrations\Intercom\Tools\IntercomListCompanies;
use OpenCompany\Integrations\Intercom\Tools\IntercomCreateConversation;
use OpenCompany\Integrations\Intercom\Tools\IntercomListConversations;
use OpenCompany\Integrations\Intercom\Tools\IntercomGetConversation;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Intercom tools and provides integration metadata, configuration schema, and connection testing.
 */
class IntercomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'intercom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Intercom',
            'description' => 'Customer messaging platform',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:intercom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Intercom',
            'description' => 'Customer messaging platform – contacts, conversations, and companies',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:intercom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.intercom.com/docs/references/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'dG9rZW4...',
                'hint' => 'Create a personal access token in Intercom Settings → Developers → Your App → Configure → Authentication.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.intercom.io/v1',
                'hint' => 'Override only if using a custom Intercom API endpoint. Defaults to <code>https://api.intercom.io/v1</code>.',
                'default' => 'https://api.intercom.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.intercom.io/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Create one in Intercom Settings → Developers.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Intercom-Version' => '2.11',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = trim(($data['name'] ?? '') . ' ' . ($data['email'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Intercom as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['errors'] ?? $body['message'] ?? $response->body();

            if (is_array($error)) {
                $error = collect($error)->map(fn ($e) => ($e['message'] ?? json_encode($e)))->implode('; ');
            }

            return [
                'success' => false,
                'error' => 'Intercom API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Conversations
            'intercom_list_conversations' => [
                'class' => IntercomListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List Intercom conversations with pagination and status filter.',
                'icon' => 'ph:list',
            ],
            'intercom_get_conversation' => [
                'class' => IntercomGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Retrieve an Intercom conversation by ID.',
                'icon' => 'ph:chat-circle',
            ],
            'intercom_create_conversation' => [
                'class' => IntercomCreateConversation::class,
                'type' => 'write',
                'name' => 'Create Conversation',
                'description' => 'Create a new Intercom conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            // Contacts
            'intercom_list_contacts' => [
                'class' => IntercomListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List Intercom contacts with pagination.',
                'icon' => 'ph:users',
            ],
            'intercom_get_contact' => [
                'class' => IntercomGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve an Intercom contact by ID.',
                'icon' => 'ph:user',
            ],
            // Companies
            'intercom_list_companies' => [
                'class' => IntercomListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List Intercom companies with pagination.',
                'icon' => 'ph:buildings',
            ],
            'intercom_get_current_user' => [
                'class' => IntercomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Intercom admin.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/intercom.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.intercom.io/v1'],
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
     * Resolve the IntercomService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): IntercomService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new IntercomService(
                accessToken: $creds->get('intercom', 'access_token', '', $account),
                baseUrl: $creds->get('intercom', 'base_url', 'https://api.intercom.io/v1', $account),
            );
        }

        return app(IntercomService::class);
    }
}
