<?php

namespace OpenCompany\Integrations\GoogleVault;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Vault.
 *
 * Exposes generated coverage for the official Vault v1 Discovery document,
 * including matters, permissions, counts, holds, held accounts, saved queries,
 * exports, and long-running operations.
 */
class GoogleVaultToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Vault scopes and Vault privileges.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-vault'; }
    public function appMeta(): array { return ['label' => 'Google Vault', 'description' => 'Matters, permissions, counts, holds, held accounts, saved queries, exports, and operations', 'icon' => 'ph:shield-check', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Vault', 'description' => 'Generated coverage for the Google Vault v1 REST API: matters, matter permissions, counts, holds, held accounts, saved queries, exports, and long-running operations.', 'icon' => 'ph:shield-check', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/vault/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Vault scopes and required Vault privileges.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://vault.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://vault.googleapis.com']]; }

    /**
     * Verify Google Vault credentials with a lightweight matters list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://vault.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v1/matters', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Google Vault API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Vault at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_vault_operations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultOperationsList',
  'type' => 'read',
  'name' => 'Operations List',
  'description' => 'Operations List (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_operations_cancel' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultOperationsCancel',
  'type' => 'write',
  'name' => 'Operations Cancel',
  'description' => 'Operations Cancel (POST /v1/{+name}:cancel).',
  'icon' => 'ph:shield-check',
),
            'google_vault_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultOperationsGet',
  'type' => 'read',
  'name' => 'Operations Get',
  'description' => 'Operations Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_operations_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultOperationsDelete',
  'type' => 'write',
  'name' => 'Operations Delete',
  'description' => 'Operations Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersGet',
  'type' => 'read',
  'name' => 'Matters Get',
  'description' => 'Matters Get (GET /v1/matters/{matterId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_remove_permissions' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersRemovePermissions',
  'type' => 'write',
  'name' => 'Matters Remove Permissions',
  'description' => 'Matters Remove Permissions (POST /v1/matters/{matterId}:removePermissions).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_add_permissions' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersAddPermissions',
  'type' => 'write',
  'name' => 'Matters Add Permissions',
  'description' => 'Matters Add Permissions (POST /v1/matters/{matterId}:addPermissions).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_count' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersCount',
  'type' => 'write',
  'name' => 'Matters Count',
  'description' => 'Matters Count (POST /v1/matters/{matterId}:count).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersCreate',
  'type' => 'write',
  'name' => 'Matters Create',
  'description' => 'Matters Create (POST /v1/matters).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersUpdate',
  'type' => 'write',
  'name' => 'Matters Update',
  'description' => 'Matters Update (PUT /v1/matters/{matterId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersList',
  'type' => 'read',
  'name' => 'Matters List',
  'description' => 'Matters List (GET /v1/matters).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_reopen' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersReopen',
  'type' => 'write',
  'name' => 'Matters Reopen',
  'description' => 'Matters Reopen (POST /v1/matters/{matterId}:reopen).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_close' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersClose',
  'type' => 'write',
  'name' => 'Matters Close',
  'description' => 'Matters Close (POST /v1/matters/{matterId}:close).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersDelete',
  'type' => 'write',
  'name' => 'Matters Delete',
  'description' => 'Matters Delete (DELETE /v1/matters/{matterId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_undelete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersUndelete',
  'type' => 'write',
  'name' => 'Matters Undelete',
  'description' => 'Matters Undelete (POST /v1/matters/{matterId}:undelete).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_add_held_accounts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsAddHeldAccounts',
  'type' => 'write',
  'name' => 'Matters Holds Add Held Accounts',
  'description' => 'Matters Holds Add Held Accounts (POST /v1/matters/{matterId}/holds/{holdId}:addHeldAccounts).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_remove_held_accounts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsRemoveHeldAccounts',
  'type' => 'write',
  'name' => 'Matters Holds Remove Held Accounts',
  'description' => 'Matters Holds Remove Held Accounts (POST /v1/matters/{matterId}/holds/{holdId}:removeHeldAccounts).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsDelete',
  'type' => 'write',
  'name' => 'Matters Holds Delete',
  'description' => 'Matters Holds Delete (DELETE /v1/matters/{matterId}/holds/{holdId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsGet',
  'type' => 'read',
  'name' => 'Matters Holds Get',
  'description' => 'Matters Holds Get (GET /v1/matters/{matterId}/holds/{holdId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_holds_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsList',
  'type' => 'read',
  'name' => 'Matters Holds List',
  'description' => 'Matters Holds List (GET /v1/matters/{matterId}/holds).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_holds_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsCreate',
  'type' => 'write',
  'name' => 'Matters Holds Create',
  'description' => 'Matters Holds Create (POST /v1/matters/{matterId}/holds).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsUpdate',
  'type' => 'write',
  'name' => 'Matters Holds Update',
  'description' => 'Matters Holds Update (PUT /v1/matters/{matterId}/holds/{holdId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_accounts_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsAccountsList',
  'type' => 'read',
  'name' => 'Matters Holds Accounts List',
  'description' => 'Matters Holds Accounts List (GET /v1/matters/{matterId}/holds/{holdId}/accounts).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_holds_accounts_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsAccountsCreate',
  'type' => 'write',
  'name' => 'Matters Holds Accounts Create',
  'description' => 'Matters Holds Accounts Create (POST /v1/matters/{matterId}/holds/{holdId}/accounts).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_holds_accounts_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersHoldsAccountsDelete',
  'type' => 'write',
  'name' => 'Matters Holds Accounts Delete',
  'description' => 'Matters Holds Accounts Delete (DELETE /v1/matters/{matterId}/holds/{holdId}/accounts/{accountId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_saved_queries_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersSavedQueriesCreate',
  'type' => 'write',
  'name' => 'Matters Saved Queries Create',
  'description' => 'Matters Saved Queries Create (POST /v1/matters/{matterId}/savedQueries).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_saved_queries_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersSavedQueriesDelete',
  'type' => 'write',
  'name' => 'Matters Saved Queries Delete',
  'description' => 'Matters Saved Queries Delete (DELETE /v1/matters/{matterId}/savedQueries/{savedQueryId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_saved_queries_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersSavedQueriesGet',
  'type' => 'read',
  'name' => 'Matters Saved Queries Get',
  'description' => 'Matters Saved Queries Get (GET /v1/matters/{matterId}/savedQueries/{savedQueryId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_saved_queries_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersSavedQueriesList',
  'type' => 'read',
  'name' => 'Matters Saved Queries List',
  'description' => 'Matters Saved Queries List (GET /v1/matters/{matterId}/savedQueries).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_exports_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersExportsCreate',
  'type' => 'write',
  'name' => 'Matters Exports Create',
  'description' => 'Matters Exports Create (POST /v1/matters/{matterId}/exports).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_exports_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersExportsDelete',
  'type' => 'write',
  'name' => 'Matters Exports Delete',
  'description' => 'Matters Exports Delete (DELETE /v1/matters/{matterId}/exports/{exportId}).',
  'icon' => 'ph:shield-check',
),
            'google_vault_matters_exports_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersExportsGet',
  'type' => 'read',
  'name' => 'Matters Exports Get',
  'description' => 'Matters Exports Get (GET /v1/matters/{matterId}/exports/{exportId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_vault_matters_exports_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleVault\\Tools\\GoogleVaultMattersExportsList',
  'type' => 'read',
  'name' => 'Matters Exports List',
  'description' => 'Matters Exports List (GET /v1/matters/{matterId}/exports).',
  'icon' => 'ph:magnifying-glass',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Vault tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleVaultService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleVaultService(accessToken: $creds->get('google-vault', 'access_token', '', $account), baseUrl: $creds->get('google-vault', 'url', 'https://vault.googleapis.com', $account));
        }
        return app(GoogleVaultService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-vault.md'; }
}