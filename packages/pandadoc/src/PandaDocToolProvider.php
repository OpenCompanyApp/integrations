<?php

namespace OpenCompany\Integrations\PandaDoc;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocListDocuments;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocGetDocument;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocCreateDocument;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocSendDocument;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocListTemplates;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocGetTemplate;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocDownloadDocument;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocCreateLink;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PandaDocToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'pandadoc';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'PandaDoc',
            'description' => 'Document management and e-signatures',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:pandadoc',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'PandaDoc',
            'description' => 'Document management and e-signature platform',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:pandadoc',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.pandadoc.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your PandaDoc OAuth2 access token',
                'hint' => 'Generate an access token via OAuth2 in your PandaDoc developer settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pandadoc.com/public/v1',
                'hint' => 'Use the default PandaDoc API URL, or override for custom setups',
                'default' => 'https://api.pandadoc.com/public/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pandadoc.com/public/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach PandaDoc API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['detail'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Authentication failed: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to PandaDoc API as {$name}.",
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
            'pandadoc_list_documents' => [
                'class' => PandaDocListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents from PandaDoc.',
                'icon' => 'ph:list',
            ],
            'pandadoc_get_document' => [
                'class' => PandaDocGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get details of a specific document.',
                'icon' => 'ph:file-text',
            ],
            'pandadoc_create_document' => [
                'class' => PandaDocCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new document from a template.',
                'icon' => 'ph:file-plus',
            ],
            'pandadoc_send_document' => [
                'class' => PandaDocSendDocument::class,
                'type' => 'write',
                'name' => 'Send Document',
                'description' => 'Send a document for signature.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'pandadoc_list_templates' => [
                'class' => PandaDocListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available document templates.',
                'icon' => 'ph:files',
            ],
            'pandadoc_get_template' => [
                'class' => PandaDocGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details of a specific template.',
                'icon' => 'ph:file',
            ],
            'pandadoc_download_document' => [
                'class' => PandaDocDownloadDocument::class,
                'type' => 'read',
                'name' => 'Download Document',
                'description' => 'Download a document as PDF.',
                'icon' => 'ph:download-simple',
            ],
            'pandadoc_create_link' => [
                'class' => PandaDocCreateLink::class,
                'type' => 'write',
                'name' => 'Create Sharing Link',
                'description' => 'Create a signed sharing link for a document.',
                'icon' => 'ph:link',
            ],
            'pandadoc_get_current_user' => [
                'class' => PandaDocGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/pandadoc.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pandadoc.com/public/v1'],
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

            $service = new PandaDocService(
                accessToken: $creds->get('pandadoc', 'access_token', '', $account),
                baseUrl: $creds->get('pandadoc', 'url', 'https://api.pandadoc.com/public/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PandaDocService::class));
    }
}
