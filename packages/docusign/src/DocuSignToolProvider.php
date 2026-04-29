<?php

namespace OpenCompany\Integrations\DocuSign;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignCreateEnvelope;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignGetCurrentUser;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignGetDocument;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignGetEnvelope;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignGetTemplate;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignListDocuments;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignListEnvelopes;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignListTemplates;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DocuSignToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Unique identifier for this integration.
     */
    public function appName(): string
    {
        return 'docusign';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Docusign',
            'description' => 'DocuSign integration for Laravel — manage envelopes, templates, and documents.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
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
            'name' => 'Docusign',
            'description' => 'DocuSign integration for Laravel — manage envelopes, templates, and documents.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your DocuSign OAuth2 access token',
                'hint' => 'Generate an access token via OAuth2 in your DocuSign developer console or admin settings',
                'required' => true,
            ],
            [
                'key' => 'account_id',
                'type' => 'text',
                'label' => 'Account ID',
                'placeholder' => 'e.g., 12345678',
                'hint' => 'Your DocuSign account ID — found in Admin > Plan and Billing or via the <code>/oauth/userinfo</code> endpoint',
                'required' => true,
            ],
            [
                'key' => 'base_path',
                'type' => 'url',
                'label' => 'API Base Path',
                'placeholder' => 'https://demo.docusign.net/restapi',
                'hint' => 'Use <code>https://demo.docusign.net/restapi</code> for the developer sandbox, or <code>https://na3.docusign.net/restapi</code> for production (varies by region)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the DocuSign API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $accountId = $config['account_id'] ?? '';
        $basePath = rtrim($config['base_path'] ?? '', '/');

        if (empty($accessToken) || empty($accountId) || empty($basePath)) {
            return ['success' => false, 'error' => 'Access token, account ID, and base path are all required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($basePath . "/v2.1/accounts/{$accountId}/envelopes", [
                'count' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach DocuSign API at {$basePath}. Check the base path and credentials.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => "DocuSign API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to DocuSign API at {$basePath}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for stored configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'account_id' => 'nullable|string',
            'base_path' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'docusign_list_envelopes' => [
                'class' => DocuSignListEnvelopes::class,
                'type' => 'read',
                'name' => 'List Envelopes',
                'description' => 'List envelopes in the DocuSign account.',
                'icon' => 'ph:envelope',
            ],
            'docusign_get_envelope' => [
                'class' => DocuSignGetEnvelope::class,
                'type' => 'read',
                'name' => 'Get Envelope',
                'description' => 'Get details for a specific envelope.',
                'icon' => 'ph:envelope',
            ],
            'docusign_create_envelope' => [
                'class' => DocuSignCreateEnvelope::class,
                'type' => 'write',
                'name' => 'Create Envelope',
                'description' => 'Create and send a new envelope for signing.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'docusign_list_templates' => [
                'class' => DocuSignListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List templates available in the account.',
                'icon' => 'ph:files',
            ],
            'docusign_get_template' => [
                'class' => DocuSignGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details for a specific template.',
                'icon' => 'ph:files',
            ],
            'docusign_list_documents' => [
                'class' => DocuSignListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents in an envelope.',
                'icon' => 'ph:file-text',
            ],
            'docusign_get_document' => [
                'class' => DocuSignGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Download a document from an envelope.',
                'icon' => 'ph:download-simple',
            ],
            'docusign_get_current_user' => [
                'class' => DocuSignGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get info about the authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/docusign.md';
    }

    /**
     * Credential fields for multi-account resolution.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'account_id', 'type' => 'text', 'label' => 'Account ID', 'required' => true],
            ['key' => 'base_path', 'type' => 'url', 'label' => 'API Base Path', 'required' => true],
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
     * Instantiate a tool class, optionally using per-account credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new DocuSignService(
                accessToken: $creds->get('docusign', 'access_token', '', $account),
                accountId: $creds->get('docusign', 'account_id', '', $account),
                basePath: $creds->get('docusign', 'base_path', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(DocuSignService::class));
    }
}
