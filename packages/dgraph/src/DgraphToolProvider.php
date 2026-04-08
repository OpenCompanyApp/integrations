<?php

namespace OpenCompany\Integrations\Dgraph;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Dgraph\Tools\DgraphDropMutation;
use OpenCompany\Integrations\Dgraph\Tools\DgraphGetCurrentUser;
use OpenCompany\Integrations\Dgraph\Tools\DgraphGetNode;
use OpenCompany\Integrations\Dgraph\Tools\DgraphGetSchema;
use OpenCompany\Integrations\Dgraph\Tools\DgraphListIndexes;
use OpenCompany\Integrations\Dgraph\Tools\DgraphListSchema;
use OpenCompany\Integrations\Dgraph\Tools\DgraphListTypes;
use OpenCompany\Integrations\Dgraph\Tools\DgraphMutate;
use OpenCompany\Integrations\Dgraph\Tools\DgraphQuery;

/**
 * Registers all Dgraph tools and provides integration metadata, configuration schema, and connection testing.
 */
class DgraphToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'dgraph';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'database, graphql, graph',
            'description' => 'Distributed Graph Database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:dgraph',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Dgraph',
            'description' => 'GraphQL schema, types, indexes, nodes, mutations, queries, and auth',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:dgraph',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://dgraph.io/docs/graphql/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'bearer_token',
                'type' => 'secret',
                'label' => 'Bearer Token',
                'placeholder' => 'your-api-token',
                'hint' => 'Dgraph API token from your <a href="https://cloud.dgraph.io/" target="_blank">Dgraph Cloud → Settings</a> dashboard.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'string',
                'label' => 'GraphQL Endpoint URL',
                'placeholder' => 'https://api.dgraph.io/graphql',
                'hint' => 'Dgraph GraphQL API endpoint. Defaults to https://api.dgraph.io/graphql. Use your Dgraph Cloud backend URL for hosted instances.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Dgraph connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'bearer_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $bearerToken = $config['bearer_token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://api.dgraph.io/graphql';

        if (empty($bearerToken)) {
            return ['success' => false, 'error' => 'No bearer token provided. Find it in Dgraph Cloud → Settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearerToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post(rtrim($baseUrl, '/'), [
                'query' => '{ __typename }',
            ]);

            if ($response->successful()) {
                $json = $response->json();
                if (isset($json['errors'])) {
                    $messages = array_map(fn ($e) => $e['message'] ?? json_encode($e), $json['errors']);
                    return ['success' => false, 'error' => 'GraphQL error: ' . implode('; ', $messages)];
                }

                return [
                    'success' => true,
                    'message' => 'Connected to Dgraph successfully.',
                ];
            }

            $error = $response->body();

            return [
                'success' => false,
                'error' => 'Dgraph API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'bearer_token' => 'required|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'dgraph_list_schema' => [
                'class' => DgraphListSchema::class,
                'type' => 'read',
                'name' => 'List Schema',
                'description' => 'List the full GraphQL schema with all types and fields.',
                'icon' => 'ph:list',
            ],
            'dgraph_get_schema' => [
                'class' => DgraphGetSchema::class,
                'type' => 'read',
                'name' => 'Get Schema',
                'description' => 'Get the schema for a specific GraphQL type.',
                'icon' => 'ph:file-text',
            ],
            'dgraph_list_types' => [
                'class' => DgraphListTypes::class,
                'type' => 'read',
                'name' => 'List Types',
                'description' => 'List all types defined in the Dgraph schema.',
                'icon' => 'ph:folders',
            ],
            'dgraph_list_indexes' => [
                'class' => DgraphListIndexes::class,
                'type' => 'read',
                'name' => 'List Indexes',
                'description' => 'List all indexes defined in the Dgraph schema.',
                'icon' => 'ph:magnifying-glass',
            ],
            'dgraph_get_node' => [
                'class' => DgraphGetNode::class,
                'type' => 'read',
                'name' => 'Get Node',
                'description' => 'Get a specific node by type and ID.',
                'icon' => 'ph:cube',
            ],
            'dgraph_mutate' => [
                'class' => DgraphMutate::class,
                'type' => 'write',
                'name' => 'Mutate',
                'description' => 'Execute a GraphQL mutation to add or update data.',
                'icon' => 'ph:plus-circle',
            ],
            'dgraph_drop_mutation' => [
                'class' => DgraphDropMutation::class,
                'type' => 'write',
                'name' => 'Drop Mutation',
                'description' => 'Execute a GraphQL drop/delete mutation to remove data.',
                'icon' => 'ph:trash',
            ],
            'dgraph_query' => [
                'class' => DgraphQuery::class,
                'type' => 'action',
                'name' => 'Query',
                'description' => 'Execute a custom GraphQL query.',
                'icon' => 'ph:code',
            ],
            'dgraph_get_current_user' => [
                'class' => DgraphGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Dgraph user identity.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/dgraph.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'bearer_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'string', 'label' => 'GraphQL Endpoint URL', 'required' => false],
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
     * Resolve the DgraphService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): DgraphService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new DgraphService(
                bearerToken: $creds->get('dgraph', 'bearer_token', '', $account),
                baseUrl: $creds->get('dgraph', 'base_url', 'https://api.dgraph.io/graphql', $account),
            );
        }

        return app(DgraphService::class);
    }
}
