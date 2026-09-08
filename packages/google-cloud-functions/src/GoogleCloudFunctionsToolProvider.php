<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsList;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsOperationsGet;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsOperationsList;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsAbortFunctionUpgrade;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsCommitFunctionUpgradeAsGen2;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsGenerateDownloadUrl;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsSetupFunctionUpgradeConfig;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsList;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsGet;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsCreate;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsGenerateUploadUrl;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsDetachFunction;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsCommitFunctionUpgrade;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsPatch;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsRollbackFunctionUpgradeTraffic;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsDelete;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsRedirectFunctionUpgradeTraffic;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsRuntimesList;

/**
 * Tool catalog and configuration metadata for Google Cloud Functions.
 *
 * Exposes generated coverage for the official Cloud Functions v2 Discovery
 * document, including functions, source upload/download URLs, runtimes,
 * locations, operations, IAM, and Gen1-to-Gen2 upgrade flows.
 */
class GoogleCloudFunctionsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Cloud Functions or cloud-platform scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-cloud-functions'; }
    public function appMeta(): array { return ['label' => 'Google Cloud Functions', 'description' => 'Serverless functions, source upload URLs, runtimes, operations, and IAM', 'icon' => 'ph:function', 'logo' => 'logos:google-cloud']; }
    public function integrationMeta(): array { return ['name' => 'Google Cloud Functions', 'description' => 'Generated coverage for the Cloud Functions v2 API: functions, source upload/download URLs, runtimes, locations, operations, IAM, and upgrade flows.', 'icon' => 'ph:function', 'logo' => 'logos:google-cloud', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://cloud.google.com/functions/docs/reference/rest/v2']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Cloud Functions or cloud-platform scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://cloudfunctions.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://cloudfunctions.googleapis.com']]; }

    /**
     * Verify Google Cloud Functions credentials with a lightweight functions list call when parent is supplied.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://cloudfunctions.googleapis.com'), '/');
        $parent = (string) ($config['parent'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        if ($parent === '') return ['success' => true, 'message' => 'Google Cloud Functions token is present. Provide a parent such as projects/example/locations/us-central1 to run a live function-list credential check.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v2/'.str_replace('%2F','/',rawurlencode($parent)).'/functions', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Cloud Functions API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Cloud Functions at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [            'google_cloud_functions_projects_locations_list' => ['class' => GoogleCloudFunctionsProjectsLocationsList::class, 'type' => 'read', 'name' => 'Projects Locations List', 'description' => 'Projects Locations List (GET /v2/{+name}/locations).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_operations_get' => ['class' => GoogleCloudFunctionsProjectsLocationsOperationsGet::class, 'type' => 'read', 'name' => 'Projects Locations Operations Get', 'description' => 'Projects Locations Operations Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_operations_list' => ['class' => GoogleCloudFunctionsProjectsLocationsOperationsList::class, 'type' => 'read', 'name' => 'Projects Locations Operations List', 'description' => 'Projects Locations Operations List (GET /v2/{+name}/operations).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_functions_set_iam_policy' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Locations Functions Set Iam Policy', 'description' => 'Projects Locations Functions Set Iam Policy (POST /v2/{+resource}:setIamPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_abort_function_upgrade' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsAbortFunctionUpgrade::class, 'type' => 'write', 'name' => 'Projects Locations Functions Abort Function Upgrade', 'description' => 'Projects Locations Functions Abort Function Upgrade (POST /v2/{+name}:abortFunctionUpgrade).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_commit_function_upgrade_as_gen2' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsCommitFunctionUpgradeAsGen2::class, 'type' => 'write', 'name' => 'Projects Locations Functions Commit Function Upgrade As Gen2', 'description' => 'Projects Locations Functions Commit Function Upgrade As Gen2 (POST /v2/{+name}:commitFunctionUpgradeAsGen2).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_generate_download_url' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsGenerateDownloadUrl::class, 'type' => 'write', 'name' => 'Projects Locations Functions Generate Download Url', 'description' => 'Projects Locations Functions Generate Download Url (POST /v2/{+name}:generateDownloadUrl).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_setup_function_upgrade_config' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsSetupFunctionUpgradeConfig::class, 'type' => 'write', 'name' => 'Projects Locations Functions Setup Function Upgrade Config', 'description' => 'Projects Locations Functions Setup Function Upgrade Config (POST /v2/{+name}:setupFunctionUpgradeConfig).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_list' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsList::class, 'type' => 'read', 'name' => 'Projects Locations Functions List', 'description' => 'Projects Locations Functions List (GET /v2/{+parent}/functions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_functions_get' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsGet::class, 'type' => 'read', 'name' => 'Projects Locations Functions Get', 'description' => 'Projects Locations Functions Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_functions_create' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsCreate::class, 'type' => 'write', 'name' => 'Projects Locations Functions Create', 'description' => 'Projects Locations Functions Create (POST /v2/{+parent}/functions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_generate_upload_url' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsGenerateUploadUrl::class, 'type' => 'write', 'name' => 'Projects Locations Functions Generate Upload Url', 'description' => 'Projects Locations Functions Generate Upload Url (POST /v2/{+parent}/functions:generateUploadUrl).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_detach_function' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsDetachFunction::class, 'type' => 'write', 'name' => 'Projects Locations Functions Detach Function', 'description' => 'Projects Locations Functions Detach Function (POST /v2/{+name}:detachFunction).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_test_iam_permissions' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Locations Functions Test Iam Permissions', 'description' => 'Projects Locations Functions Test Iam Permissions (POST /v2/{+resource}:testIamPermissions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_commit_function_upgrade' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsCommitFunctionUpgrade::class, 'type' => 'write', 'name' => 'Projects Locations Functions Commit Function Upgrade', 'description' => 'Projects Locations Functions Commit Function Upgrade (POST /v2/{+name}:commitFunctionUpgrade).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_patch' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsPatch::class, 'type' => 'write', 'name' => 'Projects Locations Functions Patch', 'description' => 'Projects Locations Functions Patch (PATCH /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_rollback_function_upgrade_traffic' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsRollbackFunctionUpgradeTraffic::class, 'type' => 'write', 'name' => 'Projects Locations Functions Rollback Function Upgrade Traffic', 'description' => 'Projects Locations Functions Rollback Function Upgrade Traffic (POST /v2/{+name}:rollbackFunctionUpgradeTraffic).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_get_iam_policy' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Locations Functions Get Iam Policy', 'description' => 'Projects Locations Functions Get Iam Policy (GET /v2/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_functions_projects_locations_functions_delete' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Functions Delete', 'description' => 'Projects Locations Functions Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_functions_redirect_function_upgrade_traffic' => ['class' => GoogleCloudFunctionsProjectsLocationsFunctionsRedirectFunctionUpgradeTraffic::class, 'type' => 'write', 'name' => 'Projects Locations Functions Redirect Function Upgrade Traffic', 'description' => 'Projects Locations Functions Redirect Function Upgrade Traffic (POST /v2/{+name}:redirectFunctionUpgradeTraffic).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_functions_projects_locations_runtimes_list' => ['class' => GoogleCloudFunctionsProjectsLocationsRuntimesList::class, 'type' => 'read', 'name' => 'Projects Locations Runtimes List', 'description' => 'Projects Locations Runtimes List (GET /v2/{+parent}/runtimes).', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Cloud Functions tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleCloudFunctionsService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleCloudFunctionsService(accessToken: $creds->get('google-cloud-functions', 'access_token', '', $account), baseUrl: $creds->get('google-cloud-functions', 'url', 'https://cloudfunctions.googleapis.com', $account));
        }
        return app(GoogleCloudFunctionsService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-cloud-functions.md'; }
}