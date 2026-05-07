<?php

namespace OpenCompany\Integrations\RingCentral;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralApiDelete;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralApiGet;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralApiPost;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralApiPut;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralCreateContact;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralDeleteContact;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralDeleteMessage;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetAccount;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetCall;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetContact;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetCurrentUser;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetExtension;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetMessage;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetPresence;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListAccountCalls;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListAccountPhoneNumbers;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListCalls;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListContacts;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListExtensionPhoneNumbers;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListExtensions;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListMessages;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralSendSms;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralUpdateContact;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralUpdateMessage;

/**
 * Registers the integration provider and exposes its tools.
 */
class RingCentralToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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




/**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'ringcentral';
    }

/**
     * Get metadata for the app tile / display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'RingCentral',
            'description' => 'Business communication',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:ringcentral',
        ];
    }

/**
     * Get integration metadata for the marketplace / integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'RingCentral',
            'description' => 'Cloud business communications, SMS, calls, voicemail, phone numbers, and contacts',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:ringcentral',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.ringcentral.com/api-reference/',
        ];
    }/**
     * Get the configuration schema for the integration settings UI.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your RingCentral OAuth access token',
                'hint' => 'Generate an access token via OAuth 2.0 in your RingCentral developer console',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://platform.ringcentral.com',
                'hint' => 'Use <code>https://platform.ringcentral.com</code> for production, or <code>https://platform.devtest.ringcentral.com</code> for sandbox',
                'default' => 'https://platform.ringcentral.com',
            ],
        ];
    }

    /**
     * Test the connection to the RingCentral API using the provided config.
     *
     * @param  array  $config  The configuration values to test.
     * @return array Result with 'success' boolean and optional 'error' or 'message'.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://platform.ringcentral.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/restapi/v1.0/account/~/extension/~');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach RingCentral API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = trim(($json['name'] ?? '') . ' ' . ($json['loginName'] ?? ''));

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to RingCentral API at {$baseUrl}" . ($name ? " ({$name})" : '') . '.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'ringcentral_list_messages' => [
                'class' => RingCentralListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages from the RingCentral message store.',
                'icon' => 'ph:envelope',
            ],
            'ringcentral_get_message' => [
                'class' => RingCentralGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific message.',
                'icon' => 'ph:envelope-open',
            ],
            'ringcentral_update_message' => [
                'class' => RingCentralUpdateMessage::class,
                'type' => 'write',
                'name' => 'Update Message',
                'description' => 'Update a message store record, commonly read status.',
                'icon' => 'ph:envelope-simple-open',
            ],
            'ringcentral_delete_message' => [
                'class' => RingCentralDeleteMessage::class,
                'type' => 'write',
                'name' => 'Delete Message',
                'description' => 'Delete a message from the extension message store.',
                'icon' => 'ph:trash',
            ],
            'ringcentral_send_sms' => [
                'class' => RingCentralSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message via RingCentral.',
                'icon' => 'ph:chat-circle-text',
            ],
            'ringcentral_list_calls' => [
                'class' => RingCentralListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List call log records.',
                'icon' => 'ph:phone',
            ],
            'ringcentral_list_account_calls' => [
                'class' => RingCentralListAccountCalls::class,
                'type' => 'read',
                'name' => 'List Account Calls',
                'description' => 'List account-level call log records.',
                'icon' => 'ph:phone-call',
            ],
            'ringcentral_get_call' => [
                'class' => RingCentralGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get one extension call log record.',
                'icon' => 'ph:phone-incoming',
            ],
            'ringcentral_list_contacts' => [
                'class' => RingCentralListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from the address book.',
                'icon' => 'ph:address-book',
            ],
            'ringcentral_get_contact' => [
                'class' => RingCentralGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get one personal address book contact.',
                'icon' => 'ph:address-book',
            ],
            'ringcentral_create_contact' => [
                'class' => RingCentralCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a personal address book contact.',
                'icon' => 'ph:user-plus',
            ],
            'ringcentral_update_contact' => [
                'class' => RingCentralUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update a personal address book contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'ringcentral_delete_contact' => [
                'class' => RingCentralDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a personal address book contact.',
                'icon' => 'ph:user-minus',
            ],
            'ringcentral_get_account' => [
                'class' => RingCentralGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get RingCentral account metadata.',
                'icon' => 'ph:buildings',
            ],
            'ringcentral_list_extensions' => [
                'class' => RingCentralListExtensions::class,
                'type' => 'read',
                'name' => 'List Extensions',
                'description' => 'List users and extensions in the account.',
                'icon' => 'ph:users-three',
            ],
            'ringcentral_get_extension' => [
                'class' => RingCentralGetExtension::class,
                'type' => 'read',
                'name' => 'Get Extension',
                'description' => 'Get one RingCentral extension by ID.',
                'icon' => 'ph:user-circle',
            ],
            'ringcentral_list_account_phone_numbers' => [
                'class' => RingCentralListAccountPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Account Phone Numbers',
                'description' => 'List account phone numbers and assignment metadata.',
                'icon' => 'ph:phone-list',
            ],
            'ringcentral_list_extension_phone_numbers' => [
                'class' => RingCentralListExtensionPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Extension Phone Numbers',
                'description' => 'List phone numbers assigned to the authenticated extension.',
                'icon' => 'ph:phone-list',
            ],
            'ringcentral_get_presence' => [
                'class' => RingCentralGetPresence::class,
                'type' => 'read',
                'name' => 'Get Presence',
                'description' => 'Get presence for the authenticated extension.',
                'icon' => 'ph:broadcast',
            ],
            'ringcentral_get_current_user' => [
                'class' => RingCentralGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current user\'s extension information.',
                'icon' => 'ph:user-circle',
            ],
            'ringcentral_api_get' => [
                'class' => RingCentralApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative RingCentral API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'ringcentral_api_post' => [
                'class' => RingCentralApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative RingCentral API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'ringcentral_api_put' => [
                'class' => RingCentralApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative RingCentral API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'ringcentral_api_delete' => [
                'class' => RingCentralApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative RingCentral API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ringcentral.md';
    }

    /**
     * Get the credential fields for authentication.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://platform.ringcentral.com'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array               $context Optional context with 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new RingCentralService(
                accessToken: $creds->get('ringcentral', 'access_token', '', $account),
                baseUrl: $creds->get('ringcentral', 'url', 'https://platform.ringcentral.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(RingCentralService::class));
    }
}
