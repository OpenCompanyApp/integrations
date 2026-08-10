<?php

namespace OpenCompany\Integrations\Appwrite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateBucket;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateCollection;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateEmail;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateExecution;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreatePush;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateTeam;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateTopic;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateUser;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteBucket;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteCollection;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteFile;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteTeam;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteTopic;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteDeleteUser;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetBucket;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetCollection;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetCurrentUser;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetExecution;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetFile;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetFunction;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetTeam;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteGetUser;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListBuckets;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListCollections;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListDatabases;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListDocuments;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListExecutions;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListFiles;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListFunctions;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListMessages;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListMessagingProviders;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListTeamMemberships;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListTeams;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListTopics;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteListUsers;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteUpdateBucket;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteUpdateCollection;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteUpdateDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteUpdateDocument;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteUpdateUserStatus;

/**
 * Tool provider for the Appwrite integration.
 *
 * Exposes server REST tools for databases, users, teams, storage, functions,
 * and messaging, and handles credential configuration for host apps.
 */
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
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Appwrite',
            'description' => 'Appwrite integration for Laravel: manage databases, users, teams, storage, functions, and messaging.',
            'icon' => 'ph:app-window',
            'logo' => 'ph:app-window',
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
            'name' => 'Appwrite',
            'description' => 'Appwrite integration for Laravel: manage databases, users, teams, storage, functions, and messaging.',
            'icon' => 'ph:app-window',
            'logo' => 'ph:app-window',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://appwrite.io/docs/references/cloud/server-rest',
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
        ])->timeout(10)->get($baseUrl . '/databases');

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
            'appwrite_create_database' => [
                'class' => AppwriteCreateDatabase::class,
                'type' => 'write',
                'name' => 'Create Database',
                'description' => 'Create a database in the Appwrite project.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_get_database' => [
                'class' => AppwriteGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details of a specific database.',
                'icon' => 'ph:database',
            ],
            'appwrite_update_database' => [
                'class' => AppwriteUpdateDatabase::class,
                'type' => 'write',
                'name' => 'Update Database',
                'description' => 'Update a database name or enabled state.',
                'icon' => 'ph:pencil-simple',
            ],
            'appwrite_delete_database' => [
                'class' => AppwriteDeleteDatabase::class,
                'type' => 'write',
                'name' => 'Delete Database',
                'description' => 'Delete a database by ID.',
                'icon' => 'ph:trash',
            ],
            'appwrite_list_collections' => [
                'class' => AppwriteListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List collections in a database.',
                'icon' => 'ph:folders',
            ],
            'appwrite_create_collection' => [
                'class' => AppwriteCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a collection in a database.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_get_collection' => [
                'class' => AppwriteGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details for a collection.',
                'icon' => 'ph:folder',
            ],
            'appwrite_update_collection' => [
                'class' => AppwriteUpdateCollection::class,
                'type' => 'write',
                'name' => 'Update Collection',
                'description' => 'Update collection metadata and permissions.',
                'icon' => 'ph:pencil-simple',
            ],
            'appwrite_delete_collection' => [
                'class' => AppwriteDeleteCollection::class,
                'type' => 'write',
                'name' => 'Delete Collection',
                'description' => 'Delete a collection from a database.',
                'icon' => 'ph:trash',
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
            'appwrite_update_document' => [
                'class' => AppwriteUpdateDocument::class,
                'type' => 'write',
                'name' => 'Update Document',
                'description' => 'Update a document data payload.',
                'icon' => 'ph:pencil-simple',
            ],
            'appwrite_delete_document' => [
                'class' => AppwriteDeleteDocument::class,
                'type' => 'write',
                'name' => 'Delete Document',
                'description' => 'Delete a document from a collection.',
                'icon' => 'ph:trash',
            ],
            'appwrite_get_current_user' => [
                'class' => AppwriteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user account.',
                'icon' => 'ph:user-circle',
            ],
            'appwrite_list_users' => [
                'class' => AppwriteListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Appwrite project.',
                'icon' => 'ph:users',
            ],
            'appwrite_get_user' => [
                'class' => AppwriteGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get one Appwrite user by ID.',
                'icon' => 'ph:user',
            ],
            'appwrite_create_user' => [
                'class' => AppwriteCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a user in the Appwrite project.',
                'icon' => 'ph:user-plus',
            ],
            'appwrite_update_user_status' => [
                'class' => AppwriteUpdateUserStatus::class,
                'type' => 'write',
                'name' => 'Update User Status',
                'description' => 'Enable or disable an Appwrite user.',
                'icon' => 'ph:user-switch',
            ],
            'appwrite_delete_user' => [
                'class' => AppwriteDeleteUser::class,
                'type' => 'write',
                'name' => 'Delete User',
                'description' => 'Delete an Appwrite user.',
                'icon' => 'ph:user-minus',
            ],
            'appwrite_list_teams' => [
                'class' => AppwriteListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams in the Appwrite project.',
                'icon' => 'ph:users-three',
            ],
            'appwrite_get_team' => [
                'class' => AppwriteGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get one Appwrite team by ID.',
                'icon' => 'ph:users-three',
            ],
            'appwrite_create_team' => [
                'class' => AppwriteCreateTeam::class,
                'type' => 'write',
                'name' => 'Create Team',
                'description' => 'Create a team in the Appwrite project.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_delete_team' => [
                'class' => AppwriteDeleteTeam::class,
                'type' => 'write',
                'name' => 'Delete Team',
                'description' => 'Delete an Appwrite team.',
                'icon' => 'ph:trash',
            ],
            'appwrite_list_team_memberships' => [
                'class' => AppwriteListTeamMemberships::class,
                'type' => 'read',
                'name' => 'List Team Memberships',
                'description' => 'List memberships for a team.',
                'icon' => 'ph:identification-card',
            ],
            'appwrite_list_buckets' => [
                'class' => AppwriteListBuckets::class,
                'type' => 'read',
                'name' => 'List Buckets',
                'description' => 'List Appwrite storage buckets.',
                'icon' => 'ph:archive',
            ],
            'appwrite_get_bucket' => [
                'class' => AppwriteGetBucket::class,
                'type' => 'read',
                'name' => 'Get Bucket',
                'description' => 'Get one Appwrite storage bucket.',
                'icon' => 'ph:archive',
            ],
            'appwrite_create_bucket' => [
                'class' => AppwriteCreateBucket::class,
                'type' => 'write',
                'name' => 'Create Bucket',
                'description' => 'Create an Appwrite storage bucket.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_update_bucket' => [
                'class' => AppwriteUpdateBucket::class,
                'type' => 'write',
                'name' => 'Update Bucket',
                'description' => 'Update an Appwrite storage bucket.',
                'icon' => 'ph:pencil-simple',
            ],
            'appwrite_delete_bucket' => [
                'class' => AppwriteDeleteBucket::class,
                'type' => 'write',
                'name' => 'Delete Bucket',
                'description' => 'Delete an Appwrite storage bucket.',
                'icon' => 'ph:trash',
            ],
            'appwrite_list_files' => [
                'class' => AppwriteListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files in a storage bucket.',
                'icon' => 'ph:files',
            ],
            'appwrite_get_file' => [
                'class' => AppwriteGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get Appwrite storage file metadata.',
                'icon' => 'ph:file',
            ],
            'appwrite_delete_file' => [
                'class' => AppwriteDeleteFile::class,
                'type' => 'write',
                'name' => 'Delete File',
                'description' => 'Delete a file from a storage bucket.',
                'icon' => 'ph:trash',
            ],
            'appwrite_list_functions' => [
                'class' => AppwriteListFunctions::class,
                'type' => 'read',
                'name' => 'List Functions',
                'description' => 'List Appwrite functions.',
                'icon' => 'ph:code',
            ],
            'appwrite_get_function' => [
                'class' => AppwriteGetFunction::class,
                'type' => 'read',
                'name' => 'Get Function',
                'description' => 'Get one Appwrite function by ID.',
                'icon' => 'ph:code',
            ],
            'appwrite_create_execution' => [
                'class' => AppwriteCreateExecution::class,
                'type' => 'write',
                'name' => 'Create Execution',
                'description' => 'Execute an Appwrite function.',
                'icon' => 'ph:play',
            ],
            'appwrite_list_executions' => [
                'class' => AppwriteListExecutions::class,
                'type' => 'read',
                'name' => 'List Executions',
                'description' => 'List executions for an Appwrite function.',
                'icon' => 'ph:list-bullets',
            ],
            'appwrite_get_execution' => [
                'class' => AppwriteGetExecution::class,
                'type' => 'read',
                'name' => 'Get Execution',
                'description' => 'Get one Appwrite function execution.',
                'icon' => 'ph:terminal-window',
            ],
            'appwrite_list_messaging_providers' => [
                'class' => AppwriteListMessagingProviders::class,
                'type' => 'read',
                'name' => 'List Messaging Providers',
                'description' => 'List Appwrite messaging providers.',
                'icon' => 'ph:plugs-connected',
            ],
            'appwrite_list_topics' => [
                'class' => AppwriteListTopics::class,
                'type' => 'read',
                'name' => 'List Topics',
                'description' => 'List Appwrite messaging topics.',
                'icon' => 'ph:broadcast',
            ],
            'appwrite_create_topic' => [
                'class' => AppwriteCreateTopic::class,
                'type' => 'write',
                'name' => 'Create Topic',
                'description' => 'Create an Appwrite messaging topic.',
                'icon' => 'ph:plus-circle',
            ],
            'appwrite_delete_topic' => [
                'class' => AppwriteDeleteTopic::class,
                'type' => 'write',
                'name' => 'Delete Topic',
                'description' => 'Delete an Appwrite messaging topic.',
                'icon' => 'ph:trash',
            ],
            'appwrite_list_messages' => [
                'class' => AppwriteListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List Appwrite messaging messages.',
                'icon' => 'ph:envelope',
            ],
            'appwrite_create_email' => [
                'class' => AppwriteCreateEmail::class,
                'type' => 'write',
                'name' => 'Create Email',
                'description' => 'Create an Appwrite email message.',
                'icon' => 'ph:envelope-simple',
            ],
            'appwrite_create_push' => [
                'class' => AppwriteCreatePush::class,
                'type' => 'write',
                'name' => 'Create Push',
                'description' => 'Create an Appwrite push notification.',
                'icon' => 'ph:bell-ringing',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     *
     * @return string|null
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/appwrite.md';
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
