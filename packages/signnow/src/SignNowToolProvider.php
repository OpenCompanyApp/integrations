<?php

namespace OpenCompany\Integrations\SignNow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SignNow\Tools\SignNowApiDelete;
use OpenCompany\Integrations\SignNow\Tools\SignNowApiGet;
use OpenCompany\Integrations\SignNow\Tools\SignNowApiPost;
use OpenCompany\Integrations\SignNow\Tools\SignNowApiPut;
use OpenCompany\Integrations\SignNow\Tools\SignNowCancelFieldInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowCancelFreeformInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowCreateDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowCreateTemplate;
use OpenCompany\Integrations\SignNow\Tools\SignNowDeleteDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowDeleteTemplate;
use OpenCompany\Integrations\SignNow\Tools\SignNowDownloadDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowDuplicateTemplate;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetCurrentUser;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetDocumentDownloadLink;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetDocumentHistory;
use OpenCompany\Integrations\SignNow\Tools\SignNowListDocuments;
use OpenCompany\Integrations\SignNow\Tools\SignNowListTemplates;
use OpenCompany\Integrations\SignNow\Tools\SignNowMergeDocuments;
use OpenCompany\Integrations\SignNow\Tools\SignNowSendFreeformInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowSendInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowUpdateDocument;

/**
 * Tool catalog and setup metadata for the SignNow integration.
 *
 * Exposes documents, templates, signing invites, downloads, and generic
 * relative API helpers.
 */
class SignNowToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Unique integration identifier.
     */
    public function appName(): string
    {
        return 'signnow';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'SignNow',
            'description' => 'E-sign documents, templates, and signing invites',
            'icon' => 'ph:signature',
            'logo' => 'simple-icons:signnow',
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
            'name' => 'SignNow',
            'description' => 'Electronic signature platform for documents, templates, and signing workflows',
            'icon' => 'ph:signature',
            'logo' => 'simple-icons:signnow',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.signnow.com/',
        ];
    }

    /**
     * Configuration schema for the integrations settings UI.
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
                'placeholder' => 'Enter your SignNow OAuth2 access token',
                'hint' => 'Generate an access token via OAuth2 or from your SignNow developer account',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.signnow.com',
                'hint' => 'Use <code>https://api.signnow.com</code> for production, or <code>https://api-eval.signnow.com</code> for sandbox',
                'default' => 'https://api.signnow.com',
            ],
        ];
    }

    /**
     * Test the connection to the SignNow API using the provided configuration.
     *
     * @param array<string, mixed> $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.signnow.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach SignNow API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';

                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to SignNow API at {$baseUrl}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for configuration values.
     *
     * @return array<string, string|string[]>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Registered tools keyed by tool name.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'signnow_list_documents' => [
                'class' => SignNowListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents accessible to the authenticated user.',
                'icon' => 'ph:files',
            ],
            'signnow_get_document' => [
                'class' => SignNowGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get details for a specific document.',
                'icon' => 'ph:file-text',
            ],
            'signnow_create_document' => [
                'class' => SignNowCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Upload a file to create a new document.',
                'icon' => 'ph:upload-simple',
            ],
            'signnow_update_document' => [
                'class' => SignNowUpdateDocument::class,
                'type' => 'write',
                'name' => 'Update Document',
                'description' => 'Update fields or metadata for a document.',
                'icon' => 'ph:pencil-simple',
            ],
            'signnow_delete_document' => [
                'class' => SignNowDeleteDocument::class,
                'type' => 'write',
                'name' => 'Delete Document',
                'description' => 'Delete a document.',
                'icon' => 'ph:trash',
            ],
            'signnow_download_document' => [
                'class' => SignNowDownloadDocument::class,
                'type' => 'read',
                'name' => 'Download Document',
                'description' => 'Download a document.',
                'icon' => 'ph:download-simple',
            ],
            'signnow_get_document_download_link' => [
                'class' => SignNowGetDocumentDownloadLink::class,
                'type' => 'read',
                'name' => 'Get Document Download Link',
                'description' => 'Get a temporary document download link.',
                'icon' => 'ph:link',
            ],
            'signnow_get_document_history' => [
                'class' => SignNowGetDocumentHistory::class,
                'type' => 'read',
                'name' => 'Get Document History',
                'description' => 'Get document event history.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'signnow_merge_documents' => [
                'class' => SignNowMergeDocuments::class,
                'type' => 'write',
                'name' => 'Merge Documents',
                'description' => 'Merge multiple documents into one document.',
                'icon' => 'ph:git-merge',
            ],
            'signnow_list_templates' => [
                'class' => SignNowListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available document templates.',
                'icon' => 'ph:copy',
            ],
            'signnow_create_template' => [
                'class' => SignNowCreateTemplate::class,
                'type' => 'write',
                'name' => 'Create Template',
                'description' => 'Create a template from an existing document.',
                'icon' => 'ph:copy-simple',
            ],
            'signnow_duplicate_template' => [
                'class' => SignNowDuplicateTemplate::class,
                'type' => 'write',
                'name' => 'Duplicate Template',
                'description' => 'Duplicate a template into a document.',
                'icon' => 'ph:copy',
            ],
            'signnow_delete_template' => [
                'class' => SignNowDeleteTemplate::class,
                'type' => 'write',
                'name' => 'Delete Template',
                'description' => 'Delete a template.',
                'icon' => 'ph:trash',
            ],
            'signnow_send_invite' => [
                'class' => SignNowSendInvite::class,
                'type' => 'write',
                'name' => 'Send Signing Invite',
                'description' => 'Send a signing invitation for a document.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'signnow_send_freeform_invite' => [
                'class' => SignNowSendFreeformInvite::class,
                'type' => 'write',
                'name' => 'Send Freeform Invite',
                'description' => 'Send a full official invite payload.',
                'icon' => 'ph:paper-plane-right',
            ],
            'signnow_cancel_field_invite' => [
                'class' => SignNowCancelFieldInvite::class,
                'type' => 'write',
                'name' => 'Cancel Field Invite',
                'description' => 'Cancel field invites for a document.',
                'icon' => 'ph:x-circle',
            ],
            'signnow_cancel_freeform_invite' => [
                'class' => SignNowCancelFreeformInvite::class,
                'type' => 'write',
                'name' => 'Cancel Freeform Invite',
                'description' => 'Cancel a free-form invite by invite ID.',
                'icon' => 'ph:x-circle',
            ],
            'signnow_get_current_user' => [
                'class' => SignNowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
            'signnow_api_get' => [
                'class' => SignNowApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative SignNow API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'signnow_api_post' => [
                'class' => SignNowApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative SignNow API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'signnow_api_put' => [
                'class' => SignNowApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative SignNow API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'signnow_api_delete' => [
                'class' => SignNowApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative SignNow API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/signnow.md';
    }

    /**
     * Credential fields required for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.signnow.com'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class, optionally with account-specific credentials.
     *
     * @param class-string<Tool> $class   Fully-qualified tool class name
     * @param array<string, mixed> $context Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new SignNowService(
                accessToken: $creds->get('signnow', 'access_token', '', $account),
                baseUrl: $creds->get('signnow', 'url', 'https://api.signnow.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(SignNowService::class));
    }
}
