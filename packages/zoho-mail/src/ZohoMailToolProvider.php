<?php

namespace OpenCompany\Integrations\ZohoMail;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Zoho Mail.
 *
 * Exposes accounts, folders, messages, attachments, labels, tasks, send/reply,
 * message updates, and safe raw relative Zoho Mail API tools.
 */
class ZohoMailToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Token acquisition happens outside this package; store the resulting Zoho OAuth access token.'],
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
        return 'zoho-mail';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Zoho Mail',
            'description' => 'Mailbox accounts, folders, messages, labels, attachments, tasks, and sending',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zoho',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Mail',
            'description' => 'Zoho Mail API coverage for accounts, folders, messages, attachments, labels, tasks, sending, replies, message updates, and raw relative API calls.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zoho',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/mail/help/api/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your Zoho Mail OAuth access token', 'hint' => 'Generate an OAuth access token with Zoho Mail scopes in the Zoho developer console.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://mail.zoho.com/api', 'hint' => 'Use https://mail.zoho.com/api for global, or the matching regional endpoint such as https://mail.zoho.eu/api.', 'default' => 'https://mail.zoho.com/api'],
        ];
    }

    /**
     * Test the connection to the Zoho Mail API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://mail.zoho.com/api'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/accounts');

            $json = $response->json();

            if (! is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Zoho Mail API at {$baseUrl}. Check the regional URL."];
            }

            if (! $response->successful()) {
                return ['success' => false, 'error' => $json['data']['errorMessage'] ?? $json['message'] ?? "Zoho Mail API returned HTTP {$response->status()}."];
            }

            return ['success' => true, 'message' => "Connected to Zoho Mail API at {$baseUrl}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string>
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
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'zohomail_get_current_user' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetCurrentUser', 'type' => 'read', 'name' => 'List Accounts', 'description' => 'List current user account information.', 'icon' => 'ph:user'],
            'zohomail_get_account' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetAccount', 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get one account by ID.', 'icon' => 'ph:user'],
            'zohomail_list_messages' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailListMessages', 'type' => 'read', 'name' => 'List Messages', 'description' => 'List email messages with messages/view.', 'icon' => 'ph:envelope'],
            'zohomail_search_messages' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailSearchMessages', 'type' => 'read', 'name' => 'Search Messages', 'description' => 'Search email messages.', 'icon' => 'ph:magnifying-glass'],
            'zohomail_get_message' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetMessage', 'type' => 'read', 'name' => 'Get Message Content', 'description' => 'Get message content by account, folder, and message ID.', 'icon' => 'ph:envelope-open'],
            'zohomail_get_message_details' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetMessageDetails', 'type' => 'read', 'name' => 'Get Message Details', 'description' => 'Get message metadata.', 'icon' => 'ph:info'],
            'zohomail_get_message_headers' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetMessageHeaders', 'type' => 'read', 'name' => 'Get Message Headers', 'description' => 'Get message headers.', 'icon' => 'ph:file-text'],
            'zohomail_get_original_message' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetOriginalMessage', 'type' => 'read', 'name' => 'Get Original Message', 'description' => 'Get original MIME message.', 'icon' => 'ph:file'],
            'zohomail_get_attachment_info' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetAttachmentInfo', 'type' => 'read', 'name' => 'Get Attachment Info', 'description' => 'Get attachment metadata.', 'icon' => 'ph:paperclip'],
            'zohomail_get_attachment_content' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetAttachmentContent', 'type' => 'read', 'name' => 'Get Attachment Content', 'description' => 'Get attachment content.', 'icon' => 'ph:paperclip'],
            'zohomail_send_message' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailSendMessage', 'type' => 'write', 'name' => 'Send Message', 'description' => 'Send a new email message.', 'icon' => 'ph:paper-plane-tilt'],
            'zohomail_reply_message' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailReplyMessage', 'type' => 'write', 'name' => 'Reply Message', 'description' => 'Reply to an existing message.', 'icon' => 'ph:arrow-bend-up-left'],
            'zohomail_update_messages' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailUpdateMessages', 'type' => 'write', 'name' => 'Update Messages', 'description' => 'Run an updatemessage action.', 'icon' => 'ph:pencil-simple'],
            'zohomail_delete_message' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailDeleteMessage', 'type' => 'write', 'name' => 'Delete Message', 'description' => 'Delete a message.', 'icon' => 'ph:trash'],
            'zohomail_list_folders' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailListFolders', 'type' => 'read', 'name' => 'List Folders', 'description' => 'List email folders.', 'icon' => 'ph:folder'],
            'zohomail_get_folder' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetFolder', 'type' => 'read', 'name' => 'Get Folder', 'description' => 'Get one folder.', 'icon' => 'ph:folder'],
            'zohomail_create_folder' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailCreateFolder', 'type' => 'write', 'name' => 'Create Folder', 'description' => 'Create a folder.', 'icon' => 'ph:folder-plus'],
            'zohomail_update_folder' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailUpdateFolder', 'type' => 'write', 'name' => 'Update Folder', 'description' => 'Update a folder.', 'icon' => 'ph:pencil-simple'],
            'zohomail_delete_folder' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailDeleteFolder', 'type' => 'write', 'name' => 'Delete Folder', 'description' => 'Delete a folder.', 'icon' => 'ph:trash'],
            'zohomail_list_labels' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailListLabels', 'type' => 'read', 'name' => 'List Labels', 'description' => 'List labels.', 'icon' => 'ph:tag'],
            'zohomail_get_label' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailGetLabel', 'type' => 'read', 'name' => 'Get Label', 'description' => 'Get a label.', 'icon' => 'ph:tag'],
            'zohomail_create_label' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailCreateLabel', 'type' => 'write', 'name' => 'Create Label', 'description' => 'Create a label.', 'icon' => 'ph:tag'],
            'zohomail_update_label' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailUpdateLabel', 'type' => 'write', 'name' => 'Update Label', 'description' => 'Update a label.', 'icon' => 'ph:pencil-simple'],
            'zohomail_delete_label' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailDeleteLabel', 'type' => 'write', 'name' => 'Delete Label', 'description' => 'Delete a label.', 'icon' => 'ph:trash'],
            'zohomail_list_tasks' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List Zoho Mail tasks.', 'icon' => 'ph:list-checks'],
            'zohomail_api_get' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative Zoho Mail API path with GET.', 'icon' => 'ph:magnifying-glass'],
            'zohomail_api_post' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative Zoho Mail API path with POST.', 'icon' => 'ph:pencil-simple'],
            'zohomail_api_put' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailApiPut', 'type' => 'write', 'name' => 'Api Put', 'description' => 'Call a safe relative Zoho Mail API path with PUT.', 'icon' => 'ph:pencil-simple'],
            'zohomail_api_delete' => ['class' => 'OpenCompany\\Integrations\\ZohoMail\\Tools\\ZohoMailApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative Zoho Mail API path with DELETE.', 'icon' => 'ph:trash'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-mail.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://mail.zoho.com/api'],
        ];
    }

    /**
     * Confirm this class is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific context.
     *
     * @param  class-string<Tool>  $class  Fully-qualified tool class name.
     * @param  array{account?: mixed}  $context  Optional context with an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZohoMailService, with optional account-specific credentials.
     *
     * @param  array{account?: mixed}  $context  Optional account context.
     */
    private function resolveService(array $context = []): ZohoMailService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ZohoMailService(
                accessToken: $creds->get('zoho-mail', 'access_token', '', $account),
                baseUrl: $creds->get('zoho-mail', 'url', 'https://mail.zoho.com/api', $account),
            );
        }

        return app(ZohoMailService::class);
    }
}
