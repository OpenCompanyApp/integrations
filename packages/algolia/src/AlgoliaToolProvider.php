<?php

namespace OpenCompany\Integrations\Algolia;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaBatch;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaClearIndex;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetCurrentUser;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetSettings;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaListIndices;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaPartialUpdate;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSaveObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearch;

/**
 * Registers all available Algolia tools and provides integration metadata,
 * configuration schema, and connection testing.
 */
class AlgoliaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'algolia';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'search, index',
            'description' => 'Search & indexing',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:algolia',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Algolia',
            'description' => 'Search, index, and manage records in Algolia',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:algolia',
            'category' => 'search',
            'badge' => 'verified',
            'docs_url' => 'https://www.algolia.com/doc/rest-api/search/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'app_id',
                'type' => 'text',
                'label' => 'Application ID',
                'placeholder' => 'e.g. ABC123XYZ',
                'hint' => 'Found in your Algolia dashboard under <strong>Settings → API Keys</strong>.',
                'required' => true,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Admin API Key',
                'placeholder' => 'Enter your Algolia Admin API Key',
                'hint' => 'Use the Admin API Key for full access. Found in <strong>Settings → API Keys</strong>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $appId = $config['app_id'] ?? '';
        $apiKey = $config['api_key'] ?? '';

        if (empty($appId) || empty($apiKey)) {
            return ['success' => false, 'error' => 'Application ID and API Key are required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Algolia-Application-Id' => $appId,
                'X-Algolia-API-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("https://{$appId}.algolia.net/1/indexes");

            if ($response->successful()) {
                $data = $response->json();
                $indexCount = count($data['items'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to Algolia (Application ID: {$appId}). Found {$indexCount} index(es).",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Algolia API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'app_id' => 'nullable|string',
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'algolia_search' => [
                'class' => AlgoliaSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search an Algolia index with query, filters, and pagination.',
                'icon' => 'ph:magnifying-glass',
            ],
            'algolia_get_object' => [
                'class' => AlgoliaGetObject::class,
                'type' => 'read',
                'name' => 'Get Object',
                'description' => 'Retrieve a single record by objectID.',
                'icon' => 'ph:file-text',
            ],
            'algolia_save_object' => [
                'class' => AlgoliaSaveObject::class,
                'type' => 'write',
                'name' => 'Save Object',
                'description' => 'Create or replace a record in an index.',
                'icon' => 'ph:floppy-disk',
            ],
            'algolia_delete_object' => [
                'class' => AlgoliaDeleteObject::class,
                'type' => 'write',
                'name' => 'Delete Object',
                'description' => 'Delete a record from an index.',
                'icon' => 'ph:trash',
            ],
            'algolia_partial_update' => [
                'class' => AlgoliaPartialUpdate::class,
                'type' => 'write',
                'name' => 'Partial Update',
                'description' => 'Update specific attributes of a record.',
                'icon' => 'ph:pencil-simple',
            ],
            'algolia_list_indices' => [
                'class' => AlgoliaListIndices::class,
                'type' => 'read',
                'name' => 'List Indices',
                'description' => 'List all indices in the Algolia application.',
                'icon' => 'ph:list',
            ],
            'algolia_get_settings' => [
                'class' => AlgoliaGetSettings::class,
                'type' => 'read',
                'name' => 'Get Settings',
                'description' => 'Get the configuration settings of an index.',
                'icon' => 'ph:gear',
            ],
            'algolia_clear_index' => [
                'class' => AlgoliaClearIndex::class,
                'type' => 'write',
                'name' => 'Clear Index',
                'description' => 'Remove all records from an index.',
                'icon' => 'ph:eraser',
            ],
            'algolia_batch' => [
                'class' => AlgoliaBatch::class,
                'type' => 'write',
                'name' => 'Batch',
                'description' => 'Perform multiple write operations in a single request.',
                'icon' => 'ph:stack',
            ],
            'algolia_get_current_user' => [
                'class' => AlgoliaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'List API Keys',
                'description' => 'List API keys to verify authentication.',
                'icon' => 'ph:key',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/algolia.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'app_id', 'type' => 'text', 'label' => 'Application ID', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Admin API Key', 'required' => true],
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
     * Resolve the AlgoliaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): AlgoliaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new AlgoliaService(
                appId: $creds->get('algolia', 'app_id', '', $account),
                apiKey: $creds->get('algolia', 'api_key', '', $account),
            );
        }

        return app(AlgoliaService::class);
    }
}
