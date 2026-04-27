<?php

namespace OpenCompany\Integrations\Sanity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Sanity\Tools\SanityQueryDocuments;
use OpenCompany\Integrations\Sanity\Tools\SanityGetDocument;
use OpenCompany\Integrations\Sanity\Tools\SanityCreateDocument;
use OpenCompany\Integrations\Sanity\Tools\SanityUpdateDocument;
use OpenCompany\Integrations\Sanity\Tools\SanityDeleteDocument;
use OpenCompany\Integrations\Sanity\Tools\SanityListProjects;
use OpenCompany\Integrations\Sanity\Tools\SanityGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SanityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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

    public function appName(): string
    {
        return 'sanity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'query, documents, mutations, projects',
            'description' => 'Headless CMS',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:sanity',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sanity',
            'description' => 'Headless CMS with real-time data store and GROQ query language',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:sanity',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.sanity.io/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Sanity API token',
                'hint' => 'Generate a token in your Sanity project under API → Tokens',
                'required' => true,
            ],
            [
                'key' => 'project_id',
                'type' => 'text',
                'label' => 'Project ID',
                'placeholder' => 'e.g., abc123xyz',
                'hint' => 'Found in your Sanity project settings or the sanity.config.ts file',
                'required' => true,
            ],
            [
                'key' => 'dataset',
                'type' => 'text',
                'label' => 'Dataset',
                'placeholder' => 'production',
                'hint' => 'The dataset to query and mutate (e.g., <code>production</code>, <code>staging</code>)',
                'default' => 'production',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $projectId = $config['project_id'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        if (empty($projectId)) {
            return ['success' => false, 'error' => 'No project ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("https://{$projectId}.api.sanity.io/v2023-10-01/users/me");

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Sanity API error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $data = $response->json();
            $name = $data['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Sanity as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'project_id' => 'nullable|string',
            'dataset' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'sanity_query_documents' => [
                'class' => SanityQueryDocuments::class,
                'type' => 'read',
                'name' => 'Query Documents',
                'description' => 'Query documents using GROQ (Graph-Relational Object Queries).',
                'icon' => 'ph:magnifying-glass',
            ],
            'sanity_get_document' => [
                'class' => SanityGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve a single document by its ID.',
                'icon' => 'ph:file-text',
            ],
            'sanity_create_document' => [
                'class' => SanityCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new document in the dataset.',
                'icon' => 'ph:plus-circle',
            ],
            'sanity_update_document' => [
                'class' => SanityUpdateDocument::class,
                'type' => 'write',
                'name' => 'Update Document',
                'description' => 'Update fields on an existing document.',
                'icon' => 'ph:pencil-simple',
            ],
            'sanity_delete_document' => [
                'class' => SanityDeleteDocument::class,
                'type' => 'write',
                'name' => 'Delete Document',
                'description' => 'Delete a document from the dataset.',
                'icon' => 'ph:trash',
            ],
            'sanity_list_projects' => [
                'class' => SanityListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Sanity projects accessible to the authenticated user.',
                'icon' => 'ph:folder',
            ],
            'sanity_get_current_user' => [
                'class' => SanityGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Sanity user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sanity.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'project_id', 'type' => 'text', 'label' => 'Project ID', 'required' => true],
            ['key' => 'dataset', 'type' => 'text', 'label' => 'Dataset', 'required' => false, 'default' => 'production'],
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
            $creds = app(CredentialResolver::class);

            $service = new SanityService(
                apiToken: $creds->get('sanity', 'api_token', '', $account),
                projectId: $creds->get('sanity', 'project_id', '', $account),
                dataset: $creds->get('sanity', 'dataset', 'production', $account),
            );

            return new $class($service);
        }

        return new $class(app(SanityService::class));
    }
}
