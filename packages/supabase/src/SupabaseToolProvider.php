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
use OpenCompany\Integrations\Supabase\Tools\SupabaseInsertBatch;
use OpenCompany\Integrations\Supabase\Tools\SupabaseInsertRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListRows;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListTables;
use OpenCompany\Integrations\Supabase\Tools\SupabaseQuerySql;
use OpenCompany\Integrations\Supabase\Tools\SupabaseRpc;
use OpenCompany\Integrations\Supabase\Tools\SupabaseUpdateRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseUpsertRow;

/**
 * Registers all Supabase tools and provides integration metadata, configuration schema, and connection testing.
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
            'label' => 'database, auth, storage',
            'description' => 'Backend-as-a-Service',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Supabase',
            'description' => 'Tables, rows, RPC, SQL queries, and auth',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://supabase.com/docs/reference/javascript/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'eyJhbGciOiJIUzI1NiIs...',
                'hint' => 'Supabase anon key or service_role key from <a href="https://app.supabase.com" target="_blank">Project Settings → API</a>.',
                'required' => true,
            ],
            [
                'key' => 'project_url',
                'type' => 'string',
                'label' => 'Project URL',
                'placeholder' => 'https://xyzproject.supabase.co',
                'hint' => 'Your Supabase project URL from Project Settings → API.',
                'required' => true,
            ],
            [
                'key' => 'bearer_token',
                'type' => 'secret',
                'label' => 'Bearer Token (optional)',
                'placeholder' => 'Leave empty to use API key as bearer token',
                'hint' => 'Optional bearer token for authenticated requests. Defaults to the API key.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Supabase connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key' and 'project_url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $projectUrl = $config['project_url'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Find it in Supabase → Project Settings → API.'];
        }

        if (empty($projectUrl)) {
            return ['success' => false, 'error' => 'No project URL provided. Find it in Supabase → Project Settings → API.'];
        }

        try {
            $response = Http::withHeaders([
                'apikey' => $apiKey,
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($projectUrl, '/') . '/rest/v1/');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Supabase successfully.',
                ];
            }

            $error = $response->body();

            return [
                'success' => false,
                'error' => 'Supabase API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            // Rows
            'supabase_list_rows' => [
                'class' => SupabaseListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows from a Supabase table with filtering, ordering, and pagination.',
                'icon' => 'ph:list',
            ],
            'supabase_get_row' => [
                'class' => SupabaseGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Get a single row by its primary key id.',
                'icon' => 'ph:record',
            ],
            'supabase_insert_row' => [
                'class' => SupabaseInsertRow::class,
                'type' => 'write',
                'name' => 'Insert Row',
                'description' => 'Insert a single row into a Supabase table.',
                'icon' => 'ph:plus-circle',
            ],
            'supabase_update_row' => [
                'class' => SupabaseUpdateRow::class,
                'type' => 'write',
                'name' => 'Update Row',
                'description' => 'Update an existing row by its primary key id.',
                'icon' => 'ph:pencil-simple',
            ],
            'supabase_delete_row' => [
                'class' => SupabaseDeleteRow::class,
                'type' => 'write',
                'name' => 'Delete Row',
                'description' => 'Delete a row by its primary key id.',
                'icon' => 'ph:trash',
            ],
            // Batch
            'supabase_insert_batch' => [
                'class' => SupabaseInsertBatch::class,
                'type' => 'write',
                'name' => 'Insert Batch',
                'description' => 'Insert multiple rows in a single batch request.',
                'icon' => 'ph:stack-plus',
            ],
            // Upsert
            'supabase_upsert_row' => [
                'class' => SupabaseUpsertRow::class,
                'type' => 'write',
                'name' => 'Upsert Row',
                'description' => 'Insert or update a row based on unique constraint.',
                'icon' => 'ph:arrows-clockwise',
            ],
            // RPC & SQL
            'supabase_rpc' => [
                'class' => SupabaseRpc::class,
                'type' => 'action',
                'name' => 'Call RPC',
                'description' => 'Call a remote procedure (RPC function) defined in the database.',
                'icon' => 'ph:lightning',
            ],
            'supabase_query_sql' => [
                'class' => SupabaseQuerySql::class,
                'type' => 'action',
                'name' => 'Query SQL',
                'description' => 'Execute a raw SQL query via the exec_sql RPC function.',
                'icon' => 'ph:code',
            ],
            // Schema
            'supabase_list_tables' => [
                'class' => SupabaseListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List available tables in the Supabase database.',
                'icon' => 'ph:table',
            ],
            'supabase_count_rows' => [
                'class' => SupabaseCountRows::class,
                'type' => 'read',
                'name' => 'Count Rows',
                'description' => 'Count rows in a table with optional filtering.',
                'icon' => 'ph:hash',
            ],
            // Auth
            'supabase_get_current_user' => [
                'class' => SupabaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user from Supabase Auth.',
                'icon' => 'ph:user-circle',
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
            ['key' => 'project_url', 'type' => 'string', 'label' => 'Project URL', 'required' => true],
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
