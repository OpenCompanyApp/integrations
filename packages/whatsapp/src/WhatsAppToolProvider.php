<?php

namespace OpenCompany\Integrations\WhatsApp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for WhatsApp Business Platform.
 *
 * Exposes message, media, contact validation, template, phone number,
 * business profile, webhook subscription, and raw relative Graph API tools.
 */
class WhatsAppToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Most WABA management tools require whatsapp_business_account_id in addition to the access token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'whatsapp';
    }

    /**
     * Short metadata shown in tool chips and navigation.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'WhatsApp Business',
            'description' => 'WhatsApp Business messages, media, templates, phone numbers, and profiles',
            'icon' => 'logos:whatsapp-icon',
            'logo' => 'logos:whatsapp-icon',
        ];
    }

    /**
     * Full integration metadata for marketplace and settings UIs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'WhatsApp Business',
            'description' => 'WhatsApp Business Platform Graph API coverage for messages, media, contacts, templates, phone numbers, business profiles, subscriptions, and raw relative Graph calls.',
            'icon' => 'logos:whatsapp-icon',
            'logo' => 'logos:whatsapp-icon',
            'category' => 'productivity',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your WhatsApp access token', 'hint' => 'Generate a System User access token in Meta Business Manager or the Meta App Dashboard.', 'required' => true],
            ['key' => 'phone_number_id', 'type' => 'string', 'label' => 'Phone Number ID', 'placeholder' => '123456789012345', 'hint' => 'Required for messages, media, contacts, phone registration, and business profile tools.', 'required' => false],
            ['key' => 'whatsapp_business_account_id', 'type' => 'string', 'label' => 'WhatsApp Business Account ID', 'placeholder' => '123456789012345', 'hint' => 'Required for template management, phone-number listing, and webhook subscription tools.', 'required' => false],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://graph.facebook.com/v24.0', 'hint' => 'Defaults to https://graph.facebook.com/v24.0. Change only for testing or pinned Graph API versions.', 'default' => 'https://graph.facebook.com/v24.0'],
        ];
    }

    /**
     * Validate that the provided credentials can reach the WhatsApp Graph API.
     *
     * @param  array<string, mixed>  $config  User-supplied configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://graph.facebook.com/v24.0'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me', ['fields' => 'id,name']);

            $json = $response->json();
            if (! is_array($json)) {
                return ['success' => false, 'error' => "Could not reach WhatsApp Graph API at {$baseUrl}."];
            }

            if (isset($json['error'])) {
                return ['success' => false, 'error' => $json['error']['message'] ?? 'Unknown API error'];
            }

            $name = $json['name'] ?? $json['id'] ?? 'unknown';

            return ['success' => true, 'message' => "Connected to WhatsApp Graph API as {$name}."];
        } catch (\Throwable $e) {
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
            'whatsapp_business_account_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Declare every tool the integration provides.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'whatsapp_send_message' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppSendMessage', 'type' => 'write', 'name' => 'Send Text Message', 'description' => 'Send a text message via WhatsApp.', 'icon' => 'ph:paper-plane-tilt'],
            'whatsapp_send_template' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppSendTemplate', 'type' => 'write', 'name' => 'Send Template Message', 'description' => 'Send a pre-approved WhatsApp template message.', 'icon' => 'ph:paper-plane-tilt'],
            'whatsapp_send_message_payload' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppSendMessagePayload', 'type' => 'write', 'name' => 'Send Message Payload', 'description' => 'Send any supported Cloud API message payload.', 'icon' => 'ph:paper-plane-tilt'],
            'whatsapp_mark_message_read' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppMarkMessageRead', 'type' => 'write', 'name' => 'Mark Message Read', 'description' => 'Mark an inbound message as read.', 'icon' => 'ph:check-circle'],
            'whatsapp_get_message' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetMessage', 'type' => 'read', 'name' => 'Get Message Object', 'description' => 'Retrieve a message or Graph object by ID.', 'icon' => 'ph:chat-circle-text'],
            'whatsapp_check_contacts' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppCheckContacts', 'type' => 'read', 'name' => 'Check Contacts', 'description' => 'Validate WhatsApp contacts for supplied phone numbers.', 'icon' => 'ph:address-book'],
            'whatsapp_list_contacts' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppListContacts', 'type' => 'read', 'name' => 'Check Contacts Legacy', 'description' => 'Compatibility alias for contact validation.', 'icon' => 'ph:address-book'],
            'whatsapp_upload_media' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppUploadMedia', 'type' => 'write', 'name' => 'Upload Media', 'description' => 'Upload a local media file to WhatsApp.', 'icon' => 'ph:upload-simple'],
            'whatsapp_get_media' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetMedia', 'type' => 'read', 'name' => 'Get Media', 'description' => 'Get media metadata and temporary download URL.', 'icon' => 'ph:file'],
            'whatsapp_delete_media' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppDeleteMedia', 'type' => 'write', 'name' => 'Delete Media', 'description' => 'Delete uploaded WhatsApp media.', 'icon' => 'ph:trash'],
            'whatsapp_list_templates' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppListTemplates', 'type' => 'read', 'name' => 'List Templates', 'description' => 'List WABA message templates.', 'icon' => 'ph:files'],
            'whatsapp_get_template' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetTemplate', 'type' => 'read', 'name' => 'Get Template', 'description' => 'Get a message template by Graph ID.', 'icon' => 'ph:file-text'],
            'whatsapp_create_template' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppCreateTemplate', 'type' => 'write', 'name' => 'Create Template', 'description' => 'Create a WhatsApp message template.', 'icon' => 'ph:plus-circle'],
            'whatsapp_update_template' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppUpdateTemplate', 'type' => 'write', 'name' => 'Update Template', 'description' => 'Update a WhatsApp message template.', 'icon' => 'ph:pencil-simple'],
            'whatsapp_delete_template' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppDeleteTemplate', 'type' => 'write', 'name' => 'Delete Template', 'description' => 'Delete a WhatsApp message template.', 'icon' => 'ph:trash'],
            'whatsapp_get_phone_number' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetPhoneNumber', 'type' => 'read', 'name' => 'Get Phone Number', 'description' => 'Get metadata for a phone number.', 'icon' => 'ph:phone'],
            'whatsapp_list_phone_numbers' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppListPhoneNumbers', 'type' => 'read', 'name' => 'List Phone Numbers', 'description' => 'List WABA phone numbers.', 'icon' => 'ph:phone-list'],
            'whatsapp_request_verification_code' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppRequestVerificationCode', 'type' => 'write', 'name' => 'Request Verification Code', 'description' => 'Request a phone-number verification code.', 'icon' => 'ph:key'],
            'whatsapp_verify_code' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppVerifyCode', 'type' => 'write', 'name' => 'Verify Code', 'description' => 'Verify a phone-number registration code.', 'icon' => 'ph:check'],
            'whatsapp_register_phone_number' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppRegisterPhoneNumber', 'type' => 'write', 'name' => 'Register Phone Number', 'description' => 'Register a phone number for Cloud API use.', 'icon' => 'ph:phone-plus'],
            'whatsapp_deregister_phone_number' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppDeregisterPhoneNumber', 'type' => 'write', 'name' => 'Deregister Phone Number', 'description' => 'Deregister a phone number from Cloud API use.', 'icon' => 'ph:phone-x'],
            'whatsapp_get_business_profile' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetBusinessProfile', 'type' => 'read', 'name' => 'Get Business Profile', 'description' => 'Get the configured phone-number business profile.', 'icon' => 'ph:storefront'],
            'whatsapp_update_business_profile' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppUpdateBusinessProfile', 'type' => 'write', 'name' => 'Update Business Profile', 'description' => 'Update business profile fields.', 'icon' => 'ph:storefront'],
            'whatsapp_list_subscribed_apps' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppListSubscribedApps', 'type' => 'read', 'name' => 'List Subscribed Apps', 'description' => 'List apps subscribed to WABA webhooks.', 'icon' => 'ph:webhooks-logo'],
            'whatsapp_subscribe_app' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppSubscribeApp', 'type' => 'write', 'name' => 'Subscribe App', 'description' => 'Subscribe the app to WABA webhook events.', 'icon' => 'ph:webhooks-logo'],
            'whatsapp_unsubscribe_app' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppUnsubscribeApp', 'type' => 'write', 'name' => 'Unsubscribe App', 'description' => 'Unsubscribe the app from WABA webhook events.', 'icon' => 'ph:webhooks-logo'],
            'whatsapp_get_current_user' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Graph user.', 'icon' => 'ph:user-circle'],
            'whatsapp_api_get' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative Graph API path with GET.', 'icon' => 'ph:magnifying-glass'],
            'whatsapp_api_post' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative Graph API path with POST.', 'icon' => 'ph:pencil-simple'],
            'whatsapp_api_delete' => ['class' => 'OpenCompany\\Integrations\\WhatsApp\\Tools\\WhatsAppApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative Graph API path with DELETE.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/whatsapp.md';
    }

    /**
     * Credential fields exposed through the credential resolver.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'phone_number_id', 'type' => 'string', 'label' => 'Phone Number ID', 'required' => false],
            ['key' => 'whatsapp_business_account_id', 'type' => 'string', 'label' => 'WhatsApp Business Account ID', 'required' => false],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://graph.facebook.com/v24.0'],
        ];
    }

    /**
     * Confirm this provider is an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Fully-qualified tool class name.
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default account or a named account.
     *
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    private function resolveService(array $context = []): WhatsAppService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new WhatsAppService(
                accessToken: $creds->get('whatsapp', 'access_token', '', $account),
                phoneNumberId: $creds->get('whatsapp', 'phone_number_id', '', $account),
                whatsAppBusinessAccountId: $creds->get('whatsapp', 'whatsapp_business_account_id', '', $account),
                baseUrl: $creds->get('whatsapp', 'base_url', 'https://graph.facebook.com/v24.0', $account),
            );
        }

        return app(WhatsAppService::class);
    }
}
