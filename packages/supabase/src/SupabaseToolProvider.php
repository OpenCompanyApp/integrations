<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Supabase\Tools\SupabaseCountRows;
use OpenCompany\Integrations\Supabase\Tools\SupabaseDeleteRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetCurrentUser;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetSettings;
use OpenCompany\Integrations\Supabase\Tools\SupabaseInsertBatch;
use OpenCompany\Integrations\Supabase\Tools\SupabaseInsertRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListRows;
use OpenCompany\Integrations\Supabase\Tools\SupabaseQueryWithFilters;
use OpenCompany\Integrations\Supabase\Tools\SupabaseRpc;
use OpenCompany\Integrations\Supabase\Tools\SupabaseUpdateRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseUpsertRow;

/**
 * Registers all Supabase tools and provides integration metadata.
 *
 * Exposes 12 tools covering rows, batch inserts, upserts, RPC,
 * counts, filtered queries, auth, and schema discovery via the ToolProvider contract.
 */
class SupabaseToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'supabase';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tables, rows, RPC, SQL, auth',
            'description' => 'Database & Backend',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Supabase',
            'description' => 'Tables, rows, batch operations, upserts, RPC, counts, filtered queries, auth, and settings',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://supabase.com/docs/reference/rest/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'eyJ...',
                'hint' => 'Supabase anon key or service_role key. Found in Project Settings → API.',
                'required' => true,
            ],
            [
                'key' => 'project_url',
                'type' => 'text',
                'label' => 'Project URL',
                'placeholder' => 'https://xyzproject.supabase.co',
                'hint' => 'Your Supabase project URL.',
                'required' => true,
            ],
            [
                'key' => 'bearer_token',
                'type' => 'secret',
                'label' => 'Bearer Token',
                'placeholder' => 'Optional — defaults to API key',
                'hint' => 'Optional bearer token. If empty, the API key will be used as the bearer token.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Supabase connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key', 'project_url', and optionally 'bearer_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $projectUrl = $config['project_url'] ?? '';
        $bearerToken = $config['bearer_token'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Copy it from your Supabase Project Settings → API.'];
        }

        if (empty($projectUrl)) {
            return ['success' => false, 'error' => 'No project URL provided.'];
        }

        $bearer = empty($bearerToken) ? $apiKey : $bearerToken;
        $baseUrl = rtrim($projectUrl, '/') . '/rest/v1';

        try {
            $response = Http::withHeaders([
                'apikey' => $apiKey,
                'Authorization' => 'Bearer ' . $bearer,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/');

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $body['msg'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Supabase API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Supabase PostgREST API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'project_url' => 'nullable|string|url',
            'bearer_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'supabase_list_rows' => [
                'class' => SupabaseListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows from a Supabase table with optional filtering, ordering, and pagination.',
                'icon' => 'ph:list',
            ],
            'supabase_get_row' => [
                'class' => SupabaseGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Retrieve a single row from a Supabase table by its primary key id.',
                'icon' => 'ph:record',
            ],
            'supabase_insert_row' => [
                'class' => SupabaseInsertRow::class,
                'type' => 'write',
                'name' => 'Insert Row',
                'description' => 'Insert a new row into a Supabase table.',
                'icon' => 'ph:plus-circle',
            ],
            'supabase_update_row' => [
                'class' => SupabaseUpdateRow::class,
                'type' => 'write',
                'name' => 'Update Row',
                'description' => 'Update an existing row in a Supabase table by its primary key id.',
                'icon' => 'ph:pencil-simple',
            ],
            'supabase_delete_row' => [
                'class' => SupabaseDeleteRow::class,
                'type' => 'write',
                'name' => 'Delete Row',
                'description' => 'Delete a row from a Supabase table by its primary key id.',
                'icon' => 'ph:trash',
            ],
            'supabase_insert_batch' => [
                'class' => SupabaseInsertBatch::class,
                'type' => 'write',
                'name' => 'Insert Batch',
                'description' => 'Insert multiple rows into a Supabase table in a single batch request.',
                'icon' => 'ph:stack-plus',
            ],
            'supabase_rpc' => [
                'class' => SupabaseRpc::class,
                'type' => 'write',
                'name' => 'Call RPC Function',
                'description' => 'Call a Supabase remote procedure (RPC function) with parameters.',
                'icon' => 'ph:terminal',
            ],
            'supabase_count_rows' => [
                'class' => SupabaseCountRows::class,
                'type' => 'read',
                'name' => 'Count Rows',
                'description' => 'Count rows in a Supabase table with optional filtering.',
                'icon' => 'ph:hash',
            ],
            'supabase_upsert_row' => [
                'class' => SupabaseUpsertRow::class,
                'type' => 'write',
                'name' => 'Upsert Row',
                'description' => 'Insert a row or merge on conflict using PostgREST upsert.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'supabase_query_with_filters' => [
                'class' => SupabaseQueryWithFilters::class,
                'type' => 'read',
                'name' => 'Query with Filters',
                'description' => 'Query a Supabase table using advanced PostgREST filter operators.',
                'icon' => 'ph:funnel',
            ],
            'supabase_get_current_user' => [
                'class' => SupabaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user from Supabase Auth.',
                'icon' => 'ph:user-circle',
            ],
            'supabase_get_settings' => [
                'class' => SupabaseGetSettings::class,
                'type' => 'read',
                'name' => 'Get Settings',
                'description' => 'Get the OpenAPI spec info for the Supabase PostgREST instance.',
                'icon' => 'ph:gear-six',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/supabase.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'project_url', 'type' => 'text', 'label' => 'Project URL', 'required' => true],
            ['key' => 'bearer_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => false],
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
     * Resolve the SupabaseService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): SupabaseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new SupabaseService(
                apiKey: $creds->get('supabase', 'api_key', '', $account),
                projectUrl: $creds->get('supabase', 'project_url', '', $account),
                bearerToken: $creds->get('supabase', 'bearer_token', '', $account),
            );
        }

        return app(SupabaseService::class);
    }
}
