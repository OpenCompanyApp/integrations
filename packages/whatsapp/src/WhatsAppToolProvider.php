<?php

namespace OpenCompany\Integrations\WhatsApp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppSendMessage;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppGetMessage;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppListTemplates;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppListContacts;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppSendTemplate;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppGetCurrentUser;

/**
 * Tool provider for the WhatsApp Business API integration.
 *
 * Implements {@see ConfigurableIntegration} so the OpenCompany platform can
 * render configuration UI, test connections, and manage multi-account
 * credentials automatically.
 */
class WhatsAppToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name used as the integration key.
     */
    public function appName(): string
    {
        return 'whatsapp';
    }

    /**
     * Short metadata shown in tool-chips and navigation.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'send, templates, contacts',
            'description' => 'WhatsApp Business messaging',
            'icon' => 'logos:whatsapp-icon',
            'logo' => 'logos:whatsapp-icon',
        ];
    }

    /**
     * Full integration metadata for the marketplace / settings UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'WhatsApp Business',
            'description' => 'Send messages, manage templates and contacts via the WhatsApp Cloud API.',
            'icon' => 'logos:whatsapp-icon',
            'logo' => 'logos:whatsapp-icon',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.facebook.com/docs/whatsapp/cloud-api',
        ];
    }

    /**
     * Schema describing every configuration field the integration needs.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your WhatsApp access token',
                'hint' => 'Generate a System User access token in the Meta App Dashboard under WhatsApp > API Setup',
                'required' => true,
            ],
            [
                'key' => 'phone_number_id',
                'type' => 'string',
                'label' => 'Phone Number ID',
                'placeholder' => 'e.g. 123456789012345',
                'hint' => 'Found in Meta App Dashboard under WhatsApp > API Setup > Phone Number ID',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://graph.facebook.com/v21.0',
                'hint' => 'Defaults to <code>https://graph.facebook.com/v21.0</code>. Change only for testing or regional endpoints.',
                'default' => 'https://graph.facebook.com/v21.0',
            ],
        ];
    }

    /**
     * Validate that the provided credentials can reach the WhatsApp API.
     *
     * @param  array<string, mixed>  $config  User-supplied configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://graph.facebook.com/v21.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me', [
                'fields' => 'id,name',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach WhatsApp API at {$baseUrl}. Check the URL and token.",
                ];
            }

            if (isset($json['error'])) {
                return [
                    'success' => false,
                    'error' => $json['error']['message'] ?? 'Unknown API error',
                ];
            }

            $name = $json['name'] ?? $json['id'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to WhatsApp API as \"{$name}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel-style validation rules for the config fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'phone_number_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Declare every tool the integration provides.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'whatsapp_send_message' => [
                'class' => WhatsAppSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a text message via WhatsApp.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'whatsapp_get_message' => [
                'class' => WhatsAppGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Retrieve a specific message by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'whatsapp_list_templates' => [
                'class' => WhatsAppListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List approved message templates.',
                'icon' => 'ph:files',
            ],
            'whatsapp_list_contacts' => [
                'class' => WhatsAppListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List WhatsApp contacts for the business number.',
                'icon' => 'ph:address-book',
            ],
            'whatsapp_send_template' => [
                'class' => WhatsAppSendTemplate::class,
                'type' => 'write',
                'name' => 'Send Template',
                'description' => 'Send a template-based message via WhatsApp.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'whatsapp_get_current_user' => [
                'class' => WhatsAppGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated WhatsApp Business user info.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/whatsapp.md';
    }

    /**
     * Credential fields exposed through the credential resolver.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'phone_number_id', 'type' => 'string', 'label' => 'Phone Number ID', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://graph.facebook.com/v21.0'],
        ];
    }

    /**
     * Confirm this provider is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool — optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Fully-qualified tool class name.
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WhatsAppService(
                accessToken: $creds->get('whatsapp', 'access_token', '', $account),
                phoneNumberId: $creds->get('whatsapp', 'phone_number_id', '', $account),
                baseUrl: $creds->get('whatsapp', 'base_url', 'https://graph.facebook.com/v21.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(WhatsAppService::class));
    }
}
