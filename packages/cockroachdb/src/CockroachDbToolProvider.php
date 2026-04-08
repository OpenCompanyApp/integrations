<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbCreateCluster;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbGetCluster;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbGetCurrentUser;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbGetDatabase;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbListClusters;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbListDatabases;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbListUsers;

class CockroachDbToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'cockroachdb';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'clusters, databases, users',
            'description' => 'Cloud database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:cockroachlabs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CockroachDB',
            'description' => 'CockroachDB Cloud — distributed SQL database for building scalable, resilient applications',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:cockroachlabs',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.cockroachlabs.com/docs/api/cloud/v1/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your CockroachDB Cloud API key',
                'hint' => 'Generate an API key in the CockroachDB Cloud Console under <strong>Organization Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://cockroachlabs.cloud/api/v1',
                'hint' => 'Override only if using a custom CockroachDB Cloud-compatible endpoint',
                'default' => 'https://cockroachlabs.cloud/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://cockroachlabs.cloud/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided'];
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
                    'error' => "Could not reach CockroachDB Cloud API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "CockroachDB Cloud API error ({$response->status()}): {$message}",
                ];
            }

            $user = $json['user'] ?? $json;
            $email = is_array($user) ? ($user['email'] ?? 'unknown') : 'unknown';

            return [
                'success' => true,
                'message' => "Connected to CockroachDB Cloud as {$email}.",
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
            'cockroachdb_list_clusters' => [
                'class' => CockroachDbListClusters::class,
                'type' => 'read',
                'name' => 'List Clusters',
                'description' => 'List all CockroachDB clusters in the organization.',
                'icon' => 'ph:database',
            ],
            'cockroachdb_get_cluster' => [
                'class' => CockroachDbGetCluster::class,
                'type' => 'read',
                'name' => 'Get Cluster',
                'description' => 'Get details for a specific CockroachDB cluster.',
                'icon' => 'ph:database',
            ],
            'cockroachdb_create_cluster' => [
                'class' => CockroachDbCreateCluster::class,
                'type' => 'write',
                'name' => 'Create Cluster',
                'description' => 'Create a new CockroachDB cluster.',
                'icon' => 'ph:plus-circle',
            ],
            'cockroachdb_list_databases' => [
                'class' => CockroachDbListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List databases in a CockroachDB cluster.',
                'icon' => 'ph:folder',
            ],
            'cockroachdb_get_database' => [
                'class' => CockroachDbGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details for a specific database in a cluster.',
                'icon' => 'ph:folder',
            ],
            'cockroachdb_list_users' => [
                'class' => CockroachDbListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List SQL users in a CockroachDB cluster.',
                'icon' => 'ph:users',
            ],
            'cockroachdb_get_current_user' => [
                'class' => CockroachDbGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cockroachdb.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://cockroachlabs.cloud/api/v1'],
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

            $service = new CockroachDbService(
                accessToken: $creds->get('cockroachdb', 'access_token', '', $account),
                baseUrl: $creds->get('cockroachdb', 'url', 'https://cockroachlabs.cloud/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CockroachDbService::class));
    }
}
