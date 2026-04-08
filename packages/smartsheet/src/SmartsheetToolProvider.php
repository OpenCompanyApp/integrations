<?php

namespace OpenCompany\Integrations\Smartsheet;

use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Support\ConfigurableIntegration;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetListSheets;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetGetSheet;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetCreateSheet;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetAddRows;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetUpdateRows;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetDeleteRows;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetListColumns;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetAddColumn;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetListWorkspaces;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetGetWorkspace;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetSearch;
use OpenCompany\Integrations\Smartsheet\Tools\SmartsheetGetCurrentUser;

/**
 * Smartsheet tool provider for registering integration tools and metadata.
 *
 * Implements the ToolProvider and ConfigurableIntegration contracts to expose
 * 12 Smartsheet tools (sheets, rows, columns, workspaces, search, users)
 * along with configuration schema and connection testing.
 */
class SmartsheetToolProvider implements ToolProvider
{
    use ConfigurableIntegration;

    /**
     * Get the application name identifier.
     *
     * @return string The app name used for credential resolution.
     */
    public function appName(): string
    {
        return 'smartsheet';
    }

    /**
     * Get the application metadata for display purposes.
     *
     * @return array<string, mixed> App metadata including name, description, and icon.
     */
    public function appMeta(): array
    {
        return [
            'name' => 'Smartsheet',
            'description' => 'Enterprise work management platform for sheets, rows, columns, and workspaces.',
            'icon' => 'smartsheet',
        ];
    }

    /**
     * Get the integration-specific metadata.
     *
     * @return array<string, mixed> Integration metadata.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Smartsheet Integration',
            'description' => 'Connect to Smartsheet to manage sheets, rows, columns, and workspaces.',
        ];
    }

    /**
     * Get the configuration schema for the Smartsheet integration.
     *
     * @return array<string, mixed> The configuration schema defining required fields.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'label' => 'Personal Access Token',
                'type' => 'password',
                'required' => true,
                'description' => 'Your Smartsheet personal access token for API authentication.',
            ],
        ];
    }

    /**
     * Test the connection to Smartsheet by fetching the current user.
     *
     * @param array<string, mixed> $context Optional context with account-specific credentials.
     * @return array<string, mixed> Connection test result with success status and user info.
     */
    public function testConnection(array $context = []): array
    {
        try {
            $service = $this->resolveService($context);
            $user = $service->getCurrentUser();

            return [
                'success' => true,
                'message' => 'Connected to Smartsheet as ' . ($user['firstName'] ?? 'Unknown') . ' ' . ($user['lastName'] ?? ''),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Get the validation rules for the Smartsheet configuration.
     *
     * @return array<string, mixed> Laravel-style validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => ['required', 'string', 'min:10'],
        ];
    }

    /**
     * Get the list of all Smartsheet tools.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'smartsheet_list_sheets' => [
                'class' => SmartsheetListSheets::class,
                'type' => 'read',
                'name' => 'List Sheets',
                'description' => 'List all sheets accessible to the authenticated user.',
                'icon' => 'list',
            ],
            'smartsheet_get_sheet' => [
                'class' => SmartsheetGetSheet::class,
                'type' => 'read',
                'name' => 'Get Sheet',
                'description' => 'Get a specific sheet by ID with its rows and columns.',
                'icon' => 'sheet',
            ],
            'smartsheet_create_sheet' => [
                'class' => SmartsheetCreateSheet::class,
                'type' => 'write',
                'name' => 'Create Sheet',
                'description' => 'Create a new sheet with specified name and columns.',
                'icon' => 'plus',
            ],
            'smartsheet_add_rows' => [
                'class' => SmartsheetAddRows::class,
                'type' => 'write',
                'name' => 'Add Rows',
                'description' => 'Add one or more rows to a sheet.',
                'icon' => 'plus',
            ],
            'smartsheet_update_rows' => [
                'class' => SmartsheetUpdateRows::class,
                'type' => 'write',
                'name' => 'Update Rows',
                'description' => 'Update one or more existing rows in a sheet.',
                'icon' => 'pencil',
            ],
            'smartsheet_delete_rows' => [
                'class' => SmartsheetDeleteRows::class,
                'type' => 'write',
                'name' => 'Delete Rows',
                'description' => 'Delete one or more rows from a sheet.',
                'icon' => 'trash',
            ],
            'smartsheet_list_columns' => [
                'class' => SmartsheetListColumns::class,
                'type' => 'read',
                'name' => 'List Columns',
                'description' => 'List all columns in a sheet.',
                'icon' => 'list',
            ],
            'smartsheet_add_column' => [
                'class' => SmartsheetAddColumn::class,
                'type' => 'write',
                'name' => 'Add Column',
                'description' => 'Add a new column to a sheet.',
                'icon' => 'plus',
            ],
            'smartsheet_list_workspaces' => [
                'class' => SmartsheetListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces accessible to the authenticated user.',
                'icon' => 'list',
            ],
            'smartsheet_get_workspace' => [
                'class' => SmartsheetGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get a specific workspace by ID.',
                'icon' => 'folder',
            ],
            'smartsheet_search' => [
                'class' => SmartsheetSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search across sheets, reports, and templates.',
                'icon' => 'search',
            ],
            'smartsheet_get_current_user' => [
                'class' => SmartsheetGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s profile.',
                'icon' => 'user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     *
     * @return string|null The path to the Lua docs, or null if not applicable.
     */
    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/smartsheet.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, string> List of credential field keys.
     */
    public function credentialFields(): array
    {
        return ['access_token'];
    }

    /**
     * Determine whether this provider represents an integration (vs a built-in tool).
     *
     * @return bool Always true for Smartsheet.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an instance of the given tool class with the resolved service.
     *
     * @param string                $class   The fully-qualified tool class name.
     * @param array<string, mixed>  $context Optional context for account-specific credential resolution.
     * @return object The instantiated tool.
     */
    public function createTool(string $class, array $context = []): object
    {
        $service = $this->resolveService($context);

        return new $class($service);
    }

    /**
     * Resolve the Smartsheet service, optionally using account-specific credentials.
     *
     * @param array<string, mixed> $context Optional context containing account overrides.
     * @return SmartsheetService The resolved Smartsheet API client.
     */
    private function resolveService(array $context = []): SmartsheetService
    {
        $creds = $this->resolveCredentials('smartsheet', $context);

        return new SmartsheetService(
            accessToken: $creds->get('access_token', ''),
        );
    }
}
