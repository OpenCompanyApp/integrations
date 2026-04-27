<?php

namespace OpenCompany\Integrations\Appwrite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetCurrentUser;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListCollections;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListDatabases;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListDocuments;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AppwriteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
     * Get the integration app name identifier.
     *
     * @return string
     */
    public function appName(): string
    {
        return 'appwrite';
    }    /**
     * Get the configuration schema for this integration.
     *
     * @return array
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Appwrite API key',
                'hint' => 'Generate an API key in your Appwrite project settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'project_id',
                'type' => 'text',
                'label' => 'Project ID',
                'placeholder' => 'Enter your Appwrite project ID',
                'hint' => 'Found in your Appwrite project settings overview',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Server URL',
                'placeholder' => 'https://cloud.appwrite.io/v1',
                'hint' => 'Use <code>https://cloud.appwrite.io/v1</code> for Appwrite Cloud, or your self-hosted URL',
                'default' => 'https://cloud.appwrite.io/v1',
            ],
        ];
    }

    /**
     * Test the connection to Appwrite using the provided configuration.
     *
     * @param  array $config The configuration values to test.
     * @return array Result array with 'success' bool and 'message' or 'error' string.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $projectId = $config['project_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://cloud.appwrite.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($projectId)) {
            return ['success' => false, 'error' => 'No project ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Appwrite-Key' => $apiKey,
                'X-Appwrite-Project' => $projectId,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Appwrite at {$baseUrl}.",
                ];
            }

            $json = $response->json();
            $error = $json['message'] ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Appwrite returned an error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'project_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            'appwrite_list_databases' => [
                'class' => AppwriteListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases in the Appwrite project.',
                'icon' => 'ph:database',
            ],
            'appwrite_get_database' => [
                'class' => AppwriteGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details of a specific database.',
                'icon' => 'ph:database',
            ],
            'appwrite_list_collections' => [
                'class' => AppwriteListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List collections in a database.',
                'icon' => 'ph:folders',
            ],
            'appwrite_list_documents' => [
                'class' => AppwriteListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents in a collection.',
                'icon' => 'ph:list-dashes',
            ],
            'appwrite_get_document' => [
                'class' => AppwriteGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get a single document by ID.',
                'icon' => 'ph:file-text',
            ],
            'appwrite_create_document' => [
                'class' => AppwriteCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new document in a collection.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_get_current_user' => [
                'class' => AppwriteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user account.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     *
     * @return string|null
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/appwrite.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'project_id', 'type' => 'text', 'label' => 'Project ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Server URL', 'required' => false, 'default' => 'https://cloud.appwrite.io/v1'],
        ];
    }

    /**
     * Whether this class represents an integration.
     *
     * @return bool
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service injected.
     *
     * @param  string $class   The tool class name.
     * @param  array  $context Optional context including the account.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AppwriteService(
                apiKey: $creds->get('appwrite', 'api_key', '', $account),
                projectId: $creds->get('appwrite', 'project_id', '', $account),
                baseUrl: $creds->get('appwrite', 'url', 'https://cloud.appwrite.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AppwriteService::class));
    }
}
