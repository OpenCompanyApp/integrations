<?php

namespace OpenCompany\Integrations\Firebase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Firebase\Tools\FirebaseListProjects;
use OpenCompany\Integrations\Firebase\Tools\FirebaseGetProject;
use OpenCompany\Integrations\Firebase\Tools\FirebaseListDatabases;
use OpenCompany\Integrations\Firebase\Tools\FirebaseListDocuments;
use OpenCompany\Integrations\Firebase\Tools\FirebaseListCollections;
use OpenCompany\Integrations\Firebase\Tools\FirebaseListUsers;
use OpenCompany\Integrations\Firebase\Tools\FirebaseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FirebaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the integration app name identifier.
     *
     * @return string
     */
    public function appName(): string
    {
        return 'firebase';
    }    /**
     * Get the configuration schema for this integration.
     *
     * @return array
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Firebase OAuth2 access token',
                'hint' => 'Use a Google OAuth2 access token with the required Firebase scopes. Generate one via the Google Cloud Console or use a service account.',
                'required' => true,
            ],
            [
                'key' => 'project_id',
                'type' => 'text',
                'label' => 'Project ID',
                'placeholder' => 'Enter your Firebase project ID',
                'hint' => 'Your Google Cloud / Firebase project ID, found in Firebase Console project settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Management API URL',
                'placeholder' => 'https://firebase.googleapis.com/v1',
                'hint' => 'The Firebase Management API base URL. Defaults to <code>https://firebase.googleapis.com/v1</code>.',
                'default' => 'https://firebase.googleapis.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to Firebase using the provided configuration.
     *
     * @param  array $config The configuration values to test.
     * @return array Result array with 'success' bool and 'message' or 'error' string.
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
            ])->timeout(10)->get('https://firebase.googleapis.com/v1/projects');

            if ($response->successful()) {
                $data = $response->json();
                $count = count($data['results'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to Firebase. Found {$count} project(s).",
                ];
            }

            $json = $response->json();
            $error = $json['error']['message'] ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Firebase returned an error: {$error}",
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
            'access_token' => 'nullable|string',
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
            'firebase_list_projects' => [
                'class' => FirebaseListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Firebase projects the caller has access to.',
                'icon' => 'ph:folder',
            ],
            'firebase_get_project' => [
                'class' => FirebaseGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific Firebase project.',
                'icon' => 'ph:folder-open',
            ],
            'firebase_list_databases' => [
                'class' => FirebaseListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List Cloud Firestore databases in a Firebase project.',
                'icon' => 'ph:database',
            ],
            'firebase_list_documents' => [
                'class' => FirebaseListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents in a Firestore collection.',
                'icon' => 'ph:list-dashes',
            ],
            'firebase_list_collections' => [
                'class' => FirebaseListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List collection IDs under a Firestore document or database.',
                'icon' => 'ph:folders',
            ],
            'firebase_list_users' => [
                'class' => FirebaseListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in a Firebase project.',
                'icon' => 'ph:users',
            ],
            'firebase_get_current_user' => [
                'class' => FirebaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated OAuth2 user profile.',
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
        return __DIR__ . '/../lua-docs/firebase.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'project_id', 'type' => 'text', 'label' => 'Project ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Management API URL', 'required' => false, 'default' => 'https://firebase.googleapis.com/v1'],
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

            $service = new FirebaseService(
                accessToken: $creds->get('firebase', 'access_token', '', $account),
                projectId: $creds->get('firebase', 'project_id', '', $account),
                baseUrl: $creds->get('firebase', 'url', 'https://firebase.googleapis.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(FirebaseService::class));
    }
}
