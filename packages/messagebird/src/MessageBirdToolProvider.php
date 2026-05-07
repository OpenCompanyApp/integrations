<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdAddContactToGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdCreateContact;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdCreateGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdCreateVerify;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdDeleteContact;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdDeleteGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdDeleteMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdDeleteVerify;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdDeleteVoiceMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetContact;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetCurrentUser;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetHlrLookup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetNumber;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetVerify;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdGetVoiceMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListBalance;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListContactGroups;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListContactMessages;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListContacts;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListGroupContacts;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListGroups;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListMessages;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListNumbers;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListVoiceMessages;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdLookupPhoneNumber;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdRemoveContactFromGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdRequestHlrLookup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendSms;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendVoiceMessage;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdUpdateContact;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdUpdateGroup;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdUpdateNumber;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdVerifyToken;

/**
 * Tool provider for the MessageBird REST API integration.
 *
 * Exposes SMS, voice message, contact, group, lookup, HLR, verify, balance, and number tools.
 */
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
            'label' => 'MessageBird',
            'description' => 'SMS, voice, contacts, and verification',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:messagebird',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'MessageBird',
            'description' => 'Send SMS and voice messages, manage contacts and groups, look up numbers, run HLR checks, verify recipients, and inspect balance and numbers',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:messagebird',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.messagebird.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Enter your MessageBird API key', 'hint' => 'Generate an API key in the MessageBird dashboard.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://rest.messagebird.com', 'hint' => 'Use the official REST API host unless testing against a fake endpoint.', 'default' => 'https://rest.messagebird.com'],
        ];
    }

    /**
     * Test the API connection with the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://rest.messagebird.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'AccessKey ' . $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/balance');

            if (! $response->successful()) {
                return ['success' => false, 'error' => "MessageBird API returned HTTP {$response->status()}. Check the API key and base URL."];
            }

            return ['success' => true, 'message' => "Connected to MessageBird REST API at {$baseUrl}."];
        } catch (\Throwable $e) {
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
            'messagebird_send_sms' => ['class' => MessageBirdSendSms::class, 'type' => 'write', 'name' => 'Send SMS', 'description' => 'Send an SMS message.', 'icon' => 'ph:paper-plane-tilt'],
            'messagebird_list_messages' => ['class' => MessageBirdListMessages::class, 'type' => 'read', 'name' => 'List Messages', 'description' => 'List SMS messages.', 'icon' => 'ph:list-bullets'],
            'messagebird_get_message' => ['class' => MessageBirdGetMessage::class, 'type' => 'read', 'name' => 'Get Message', 'description' => 'Get SMS message details.', 'icon' => 'ph:envelope'],
            'messagebird_delete_message' => ['class' => MessageBirdDeleteMessage::class, 'type' => 'write', 'name' => 'Delete Message', 'description' => 'Delete a scheduled SMS message.', 'icon' => 'ph:trash'],
            'messagebird_send_voice_message' => ['class' => MessageBirdSendVoiceMessage::class, 'type' => 'write', 'name' => 'Send Voice Message', 'description' => 'Send a voice message.', 'icon' => 'ph:phone-call'],
            'messagebird_list_voice_messages' => ['class' => MessageBirdListVoiceMessages::class, 'type' => 'read', 'name' => 'List Voice Messages', 'description' => 'List voice messages.', 'icon' => 'ph:list-bullets'],
            'messagebird_get_voice_message' => ['class' => MessageBirdGetVoiceMessage::class, 'type' => 'read', 'name' => 'Get Voice Message', 'description' => 'Get voice message details.', 'icon' => 'ph:phone'],
            'messagebird_delete_voice_message' => ['class' => MessageBirdDeleteVoiceMessage::class, 'type' => 'write', 'name' => 'Delete Voice Message', 'description' => 'Delete a scheduled voice message.', 'icon' => 'ph:phone-x'],
            'messagebird_list_contacts' => ['class' => MessageBirdListContacts::class, 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List contacts.', 'icon' => 'ph:address-book'],
            'messagebird_create_contact' => ['class' => MessageBirdCreateContact::class, 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a contact.', 'icon' => 'ph:user-plus'],
            'messagebird_get_contact' => ['class' => MessageBirdGetContact::class, 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get a contact.', 'icon' => 'ph:user'],
            'messagebird_update_contact' => ['class' => MessageBirdUpdateContact::class, 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a contact.', 'icon' => 'ph:user-gear'],
            'messagebird_delete_contact' => ['class' => MessageBirdDeleteContact::class, 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a contact.', 'icon' => 'ph:user-minus'],
            'messagebird_list_contact_groups' => ['class' => MessageBirdListContactGroups::class, 'type' => 'read', 'name' => 'List Contact Groups', 'description' => 'List groups for a contact.', 'icon' => 'ph:users-three'],
            'messagebird_list_contact_messages' => ['class' => MessageBirdListContactMessages::class, 'type' => 'read', 'name' => 'List Contact Messages', 'description' => 'List messages for a contact.', 'icon' => 'ph:chat-text'],
            'messagebird_list_groups' => ['class' => MessageBirdListGroups::class, 'type' => 'read', 'name' => 'List Groups', 'description' => 'List contact groups.', 'icon' => 'ph:users'],
            'messagebird_create_group' => ['class' => MessageBirdCreateGroup::class, 'type' => 'write', 'name' => 'Create Group', 'description' => 'Create a contact group.', 'icon' => 'ph:users-three-plus'],
            'messagebird_get_group' => ['class' => MessageBirdGetGroup::class, 'type' => 'read', 'name' => 'Get Group', 'description' => 'Get a contact group.', 'icon' => 'ph:users-four'],
            'messagebird_update_group' => ['class' => MessageBirdUpdateGroup::class, 'type' => 'write', 'name' => 'Update Group', 'description' => 'Update a contact group.', 'icon' => 'ph:users-three'],
            'messagebird_delete_group' => ['class' => MessageBirdDeleteGroup::class, 'type' => 'write', 'name' => 'Delete Group', 'description' => 'Delete a contact group.', 'icon' => 'ph:users-three-minus'],
            'messagebird_list_group_contacts' => ['class' => MessageBirdListGroupContacts::class, 'type' => 'read', 'name' => 'List Group Contacts', 'description' => 'List contacts in a group.', 'icon' => 'ph:address-book-tabs'],
            'messagebird_add_contact_to_group' => ['class' => MessageBirdAddContactToGroup::class, 'type' => 'write', 'name' => 'Add Contact To Group', 'description' => 'Add a contact to a group.', 'icon' => 'ph:user-list'],
            'messagebird_remove_contact_from_group' => ['class' => MessageBirdRemoveContactFromGroup::class, 'type' => 'write', 'name' => 'Remove Contact From Group', 'description' => 'Remove a contact from a group.', 'icon' => 'ph:user-minus'],
            'messagebird_lookup_phone_number' => ['class' => MessageBirdLookupPhoneNumber::class, 'type' => 'read', 'name' => 'Lookup Phone Number', 'description' => 'Validate and look up a phone number.', 'icon' => 'ph:magnifying-glass'],
            'messagebird_get_hlr_lookup' => ['class' => MessageBirdGetHlrLookup::class, 'type' => 'read', 'name' => 'Get HLR Lookup', 'description' => 'Get HLR lookup information.', 'icon' => 'ph:cell-signal-full'],
            'messagebird_request_hlr_lookup' => ['class' => MessageBirdRequestHlrLookup::class, 'type' => 'write', 'name' => 'Request HLR Lookup', 'description' => 'Request an HLR lookup.', 'icon' => 'ph:cell-signal-high'],
            'messagebird_create_verify' => ['class' => MessageBirdCreateVerify::class, 'type' => 'write', 'name' => 'Create Verify', 'description' => 'Send a verification token.', 'icon' => 'ph:password'],
            'messagebird_get_verify' => ['class' => MessageBirdGetVerify::class, 'type' => 'read', 'name' => 'Get Verify', 'description' => 'Get verification status.', 'icon' => 'ph:shield-check'],
            'messagebird_verify_token' => ['class' => MessageBirdVerifyToken::class, 'type' => 'write', 'name' => 'Verify Token', 'description' => 'Verify a token.', 'icon' => 'ph:check-circle'],
            'messagebird_delete_verify' => ['class' => MessageBirdDeleteVerify::class, 'type' => 'write', 'name' => 'Delete Verify', 'description' => 'Delete a verification.', 'icon' => 'ph:shield-slash'],
            'messagebird_list_balance' => ['class' => MessageBirdListBalance::class, 'type' => 'read', 'name' => 'Get Balance', 'description' => 'Get account balance.', 'icon' => 'ph:wallet'],
            'messagebird_list_numbers' => ['class' => MessageBirdListNumbers::class, 'type' => 'read', 'name' => 'List Numbers', 'description' => 'List purchased numbers.', 'icon' => 'ph:phone'],
            'messagebird_get_number' => ['class' => MessageBirdGetNumber::class, 'type' => 'read', 'name' => 'Get Number', 'description' => 'Get a purchased number.', 'icon' => 'ph:phone-list'],
            'messagebird_update_number' => ['class' => MessageBirdUpdateNumber::class, 'type' => 'write', 'name' => 'Update Number', 'description' => 'Update purchased number settings.', 'icon' => 'ph:phone-gear'],
            'messagebird_get_current_user' => ['class' => MessageBirdGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get account balance summary.', 'icon' => 'ph:user-circle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/messagebird.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://rest.messagebird.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MessageBird service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): MessageBirdService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MessageBirdService(
                apiKey: $creds->get('messagebird', 'api_key', '', $account),
                baseUrl: $creds->get('messagebird', 'url', 'https://rest.messagebird.com', $account),
            );
        }

        return app(MessageBirdService::class);
    }
}
