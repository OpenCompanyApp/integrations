<?php

namespace OpenCompany\Integrations\Convex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Convex\Tools\ConvexCreateDocument;
use OpenCompany\Integrations\Convex\Tools\ConvexDeleteDocument;
use OpenCompany\Integrations\Convex\Tools\ConvexGetCurrentUser;
use OpenCompany\Integrations\Convex\Tools\ConvexGetTable;
use OpenCompany\Integrations\Convex\Tools\ConvexListTables;
use OpenCompany\Integrations\Convex\Tools\ConvexQueryDocuments;
use OpenCompany\Integrations\Convex\Tools\ConvexUpdateDocument;

/**
 * Registers all Convex tools and provides integration metadata.
 *
 * Exposes 7 tools covering tables, documents (CRUD), queries,
 * and user management via the ToolProvider contract.
 */
class ConvexToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'convex';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tables, documents, queries',
            'description' => 'Backend Platform',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:convex',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Convex',
            'description' => 'Tables, documents, queries, mutations, and user management',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:convex',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.convex.dev/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'convex_...',
                'hint' => 'Convex API access token. Generate one from your Convex dashboard under Settings → API Keys.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Convex connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate an API key from your Convex dashboard.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.convex.cloud/api/tables');

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error']['message'] ?? $body['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Convex API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $tableCount = count($body['tables'] ?? $body['data'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Convex. Found {$tableCount} table(s).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Tables
            'convex_list_tables' => [
                'class' => ConvexListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in the Convex deployment.',
                'icon' => 'ph:database',
            ],
            'convex_get_table' => [
                'class' => ConvexGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get metadata and schema for a specific Convex table.',
                'icon' => 'ph:tree-structure',
            ],
            // Documents
            'convex_query_documents' => [
                'class' => ConvexQueryDocuments::class,
                'type' => 'read',
                'name' => 'Query Documents',
                'description' => 'Query documents from a Convex table with optional filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'convex_create_document' => [
                'class' => ConvexCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new document in a Convex table.',
                'icon' => 'ph:plus-circle',
            ],
            'convex_update_document' => [
                'class' => ConvexUpdateDocument::class,
                'type' => 'write',
                'name' => 'Update Document',
                'description' => 'Update an existing document in a Convex table.',
                'icon' => 'ph:pencil-simple',
            ],
            'convex_delete_document' => [
                'class' => ConvexDeleteDocument::class,
                'type' => 'write',
                'name' => 'Delete Document',
                'description' => 'Delete a document from a Convex table.',
                'icon' => 'ph:trash',
            ],
            // User
            'convex_get_current_user' => [
                'class' => ConvexGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Convex user\'s profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/convex.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ConvexService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ConvexService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ConvexService(
                accessToken: $creds->get('convex', 'access_token', '', $account),
            );
        }

        return app(ConvexService::class);
    }
}
