<?php

namespace OpenCompany\Integrations\Coda;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Coda\Tools\CodaDeleteRow;
use OpenCompany\Integrations\Coda\Tools\CodaGetCurrentUser;
use OpenCompany\Integrations\Coda\Tools\CodaGetDoc;
use OpenCompany\Integrations\Coda\Tools\CodaGetRow;
use OpenCompany\Integrations\Coda\Tools\CodaGetTable;
use OpenCompany\Integrations\Coda\Tools\CodaInsertRows;
use OpenCompany\Integrations\Coda\Tools\CodaListColumns;
use OpenCompany\Integrations\Coda\Tools\CodaListDocs;
use OpenCompany\Integrations\Coda\Tools\CodaListPages;
use OpenCompany\Integrations\Coda\Tools\CodaListRows;
use OpenCompany\Integrations\Coda\Tools\CodaListTables;
use OpenCompany\Integrations\Coda\Tools\CodaUpdateRow;

/**
 * Tool provider for the Coda integration.
 *
 * Registers 12 tools for interacting with the Coda API: docs, tables, rows,
 * columns, and pages. Implements ConfigurableIntegration for multi-account
 * credential management.
 */
class CodaToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * {@inheritdoc}
     */
    public function appName(): string
    {
        return 'coda';
    }

    /**
     * {@inheritdoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'docs, tables, rows, pages',
            'description' => 'Document and spreadsheet platform',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:coda',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Coda',
            'description' => 'Collaborative documents and spreadsheets',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:coda',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://coda.io/developers/apis/v1',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Coda API token',
                'hint' => 'Generate an API token in Coda under Settings → Integrations → API settings',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection by calling the /whoami endpoint.
     *
     * @param  array<string, mixed>  $config  The integration configuration.
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://coda.io/apis/v1/whoami');

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Authentication failed: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $user = $response->json();

            return [
                'success' => true,
                'message' => "Connected to Coda as {$user['name']} ({$user['loginId']}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function tools(): array
    {
        return [
            'coda_list_docs' => [
                'class' => CodaListDocs::class,
                'type' => 'read',
                'name' => 'List Docs',
                'description' => 'List Coda docs accessible to the user.',
                'icon' => 'ph:files',
            ],
            'coda_get_doc' => [
                'class' => CodaGetDoc::class,
                'type' => 'read',
                'name' => 'Get Doc',
                'description' => 'Get details of a specific Coda doc.',
                'icon' => 'ph:file-text',
            ],
            'coda_list_tables' => [
                'class' => CodaListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List tables in a Coda doc.',
                'icon' => 'ph:table',
            ],
            'coda_get_table' => [
                'class' => CodaGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get details of a specific table.',
                'icon' => 'ph:table',
            ],
            'coda_list_rows' => [
                'class' => CodaListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows in a table.',
                'icon' => 'ph:rows',
            ],
            'coda_get_row' => [
                'class' => CodaGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Get a single row from a table.',
                'icon' => 'ph:row',
            ],
            'coda_insert_rows' => [
                'class' => CodaInsertRows::class,
                'type' => 'write',
                'name' => 'Insert Rows',
                'description' => 'Insert new rows into a table.',
                'icon' => 'ph:plus',
            ],
            'coda_update_row' => [
                'class' => CodaUpdateRow::class,
                'type' => 'write',
                'name' => 'Update Row',
                'description' => 'Update cells in an existing row.',
                'icon' => 'ph:pencil',
            ],
            'coda_delete_row' => [
                'class' => CodaDeleteRow::class,
                'type' => 'write',
                'name' => 'Delete Row',
                'description' => 'Delete a row from a table.',
                'icon' => 'ph:trash',
            ],
            'coda_list_columns' => [
                'class' => CodaListColumns::class,
                'type' => 'read',
                'name' => 'List Columns',
                'description' => 'List columns in a table.',
                'icon' => 'ph:columns',
            ],
            'coda_list_pages' => [
                'class' => CodaListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List pages in a Coda doc.',
                'icon' => 'ph:notebook',
            ],
            'coda_get_current_user' => [
                'class' => CodaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify authentication and get user info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/coda.md';
    }

    /**
     * {@inheritdoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new CodaService(
                apiKey: $creds->get('coda', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(CodaService::class));
    }
}
