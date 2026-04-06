<?php

namespace OpenCompany\Integrations\GoogleDocs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsListDocuments;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsGetDocument;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsCreateDocument;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsBatchUpdate;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsListPermissions;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsGetPermission;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsGetCurrentUser;

/**
 * Tool provider for the Google Docs integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * provides all Google Docs tools (document management, permissions, user info).
 */
class GoogleDocsToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'google-docs';
    }

    /**
     * Get short metadata for the app.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'documents, permissions, user',
            'description' => 'Google Docs',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:googledocs',
        ];
    }

    /**
     * Get integration metadata for display in the UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Docs',
            'description' => 'Create, read, and update Google Docs documents',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:googledocs',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/docs/api/reference/rest',
        ];
    }

    /**
     * Get the configuration schema for this integration.
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
                'placeholder' => 'Enter your Google OAuth2 access token',
                'hint' => 'Provide an OAuth2 access token with scope <code>https://www.googleapis.com/auth/documents</code> and <code>https://www.googleapis.com/auth/drive.readonly</code>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Docs API Base URL',
                'placeholder' => 'https://docs.googleapis.com',
                'hint' => 'The base URL for the Google Docs API. Change only if using a proxy or custom endpoint.',
                'default' => 'https://docs.googleapis.com',
            ],
        ];
    }

    /**
     * Test the connection to Google APIs using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration containing access_token and optional url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://www.googleapis.com/oauth2/v2/userinfo');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Google API. Check the access token and network.',
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => "Google API error: {$error}"];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Google Docs as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, mixed>
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
            'gdocs_list_documents' => [
                'class' => GdocsListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List Google Docs documents visible to the authenticated user.',
                'icon' => 'ph:files',
            ],
            'gdocs_get_document' => [
                'class' => GdocsGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get the full content and metadata of a Google Docs document.',
                'icon' => 'ph:file-text',
            ],
            'gdocs_create_document' => [
                'class' => GdocsCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new Google Docs document.',
                'icon' => 'ph:file-plus',
            ],
            'gdocs_batch_update' => [
                'class' => GdocsBatchUpdate::class,
                'type' => 'write',
                'name' => 'Batch Update',
                'description' => 'Send batch update requests to a document (insert text, styling, etc.).',
                'icon' => 'ph:pencil-simple',
            ],
            'gdocs_list_permissions' => [
                'class' => GdocsListPermissions::class,
                'type' => 'read',
                'name' => 'List Permissions',
                'description' => 'List permissions (sharing settings) for a Google Docs document.',
                'icon' => 'ph:users',
            ],
            'gdocs_get_permission' => [
                'class' => GdocsGetPermission::class,
                'type' => 'read',
                'name' => 'Get Permission',
                'description' => 'Get details of a specific permission for a Google Docs document.',
                'icon' => 'ph:user',
            ],
            'gdocs_get_current_user' => [
                'class' => GdocsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Google profile information.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-docs.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Docs API URL', 'required' => false, 'default' => 'https://docs.googleapis.com'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context with 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GoogleDocsService(
                accessToken: $creds->get('google-docs', 'access_token', '', $account),
                baseUrl: $creds->get('google-docs', 'url', 'https://docs.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleDocsService::class));
    }
}
