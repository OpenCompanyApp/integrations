<?php

namespace OpenCompany\Integrations\GoogleBigQuery;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsInsert;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsPatch;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsUndelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsUpdate;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsCancel;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsGetQueryResults;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsInsert;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsQuery;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryModelsDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryModelsGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryModelsList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryModelsPatch;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryProjectsGetServiceAccount;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryProjectsList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesGetIamPolicy;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesInsert;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesSetIamPolicy;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesTestIamPermissions;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRoutinesUpdate;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesBatchDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesGetIamPolicy;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesInsert;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesTestIamPermissions;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryRowAccessPoliciesUpdate;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTabledataInsertAll;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTabledataList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesDelete;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesGet;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesGetIamPolicy;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesInsert;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesPatch;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesSetIamPolicy;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesTestIamPermissions;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesUpdate;

/**
 * Tool catalog and configuration metadata for Google BigQuery.
 *
 * Exposes generated coverage for the official BigQuery v2 Discovery document,
 * including datasets, tables, table data, jobs, models, routines, row access
 * policies, projects, and IAM helper methods.
 */
class GoogleBigQueryToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth2_manual_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Requires a Google OAuth access token with BigQuery scopes such as https://www.googleapis.com/auth/bigquery.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'google-bigquery';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google BigQuery',
            'description' => 'Serverless data warehouse, SQL jobs, datasets, tables, models, routines, and policies',
            'icon' => 'ph:database',
            'logo' => 'logos:google-cloud',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google BigQuery',
            'description' => 'Generated coverage for the BigQuery v2 REST API: datasets, jobs, query results, tables, table data streaming, models, routines, row access policies, projects, and IAM.',
            'icon' => 'ph:database',
            'logo' => 'logos:google-cloud',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://cloud.google.com/bigquery/docs/reference/rest',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with BigQuery scopes.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://bigquery.googleapis.com/bigquery/v2', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://bigquery.googleapis.com/bigquery/v2'],
        ];
    }

    /**
     * Verify Google BigQuery credentials with a lightweight projects.list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://bigquery.googleapis.com/bigquery/v2'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/projects', ['maxResults' => 1]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'BigQuery API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Google BigQuery at {$baseUrl}."];
        } catch (\Throwable $e) {
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
        return [            'google_bigquery_datasets_delete' => ['class' => GoogleBigQueryDatasetsDelete::class, 'type' => 'write', 'name' => 'Datasets Delete', 'description' => 'Datasets Delete (DELETE /projects/{+projectId}/datasets/{+datasetId}).', 'icon' => 'ph:database'],
            'google_bigquery_datasets_get' => ['class' => GoogleBigQueryDatasetsGet::class, 'type' => 'read', 'name' => 'Datasets Get', 'description' => 'Datasets Get (GET /projects/{+projectId}/datasets/{+datasetId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_datasets_insert' => ['class' => GoogleBigQueryDatasetsInsert::class, 'type' => 'write', 'name' => 'Datasets Insert', 'description' => 'Datasets Insert (POST /projects/{+projectId}/datasets).', 'icon' => 'ph:database'],
            'google_bigquery_datasets_list' => ['class' => GoogleBigQueryDatasetsList::class, 'type' => 'read', 'name' => 'Datasets List', 'description' => 'Datasets List (GET /projects/{+projectId}/datasets).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_datasets_patch' => ['class' => GoogleBigQueryDatasetsPatch::class, 'type' => 'write', 'name' => 'Datasets Patch', 'description' => 'Datasets Patch (PATCH /projects/{+projectId}/datasets/{+datasetId}).', 'icon' => 'ph:database'],
            'google_bigquery_datasets_undelete' => ['class' => GoogleBigQueryDatasetsUndelete::class, 'type' => 'write', 'name' => 'Datasets Undelete', 'description' => 'Datasets Undelete (POST /projects/{+projectId}/datasets/{+datasetId}:undelete).', 'icon' => 'ph:database'],
            'google_bigquery_datasets_update' => ['class' => GoogleBigQueryDatasetsUpdate::class, 'type' => 'write', 'name' => 'Datasets Update', 'description' => 'Datasets Update (PUT /projects/{+projectId}/datasets/{+datasetId}).', 'icon' => 'ph:database'],
            'google_bigquery_jobs_cancel' => ['class' => GoogleBigQueryJobsCancel::class, 'type' => 'write', 'name' => 'Jobs Cancel', 'description' => 'Jobs Cancel (POST /projects/{+projectId}/jobs/{+jobId}/cancel).', 'icon' => 'ph:database'],
            'google_bigquery_jobs_delete' => ['class' => GoogleBigQueryJobsDelete::class, 'type' => 'write', 'name' => 'Jobs Delete', 'description' => 'Jobs Delete (DELETE /projects/{+projectId}/jobs/{+jobId}/delete).', 'icon' => 'ph:database'],
            'google_bigquery_jobs_get' => ['class' => GoogleBigQueryJobsGet::class, 'type' => 'read', 'name' => 'Jobs Get', 'description' => 'Jobs Get (GET /projects/{+projectId}/jobs/{+jobId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_jobs_get_query_results' => ['class' => GoogleBigQueryJobsGetQueryResults::class, 'type' => 'read', 'name' => 'Jobs Get Query Results', 'description' => 'Jobs Get Query Results (GET /projects/{+projectId}/queries/{+jobId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_jobs_insert' => ['class' => GoogleBigQueryJobsInsert::class, 'type' => 'write', 'name' => 'Jobs Insert', 'description' => 'Jobs Insert (POST /projects/{+projectId}/jobs).', 'icon' => 'ph:database'],
            'google_bigquery_jobs_list' => ['class' => GoogleBigQueryJobsList::class, 'type' => 'read', 'name' => 'Jobs List', 'description' => 'Jobs List (GET /projects/{+projectId}/jobs).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_jobs_query' => ['class' => GoogleBigQueryJobsQuery::class, 'type' => 'write', 'name' => 'Jobs Query', 'description' => 'Jobs Query (POST /projects/{+projectId}/queries).', 'icon' => 'ph:database'],
            'google_bigquery_models_delete' => ['class' => GoogleBigQueryModelsDelete::class, 'type' => 'write', 'name' => 'Models Delete', 'description' => 'Models Delete (DELETE /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}).', 'icon' => 'ph:database'],
            'google_bigquery_models_get' => ['class' => GoogleBigQueryModelsGet::class, 'type' => 'read', 'name' => 'Models Get', 'description' => 'Models Get (GET /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_models_list' => ['class' => GoogleBigQueryModelsList::class, 'type' => 'read', 'name' => 'Models List', 'description' => 'Models List (GET /projects/{+projectId}/datasets/{+datasetId}/models).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_models_patch' => ['class' => GoogleBigQueryModelsPatch::class, 'type' => 'write', 'name' => 'Models Patch', 'description' => 'Models Patch (PATCH /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}).', 'icon' => 'ph:database'],
            'google_bigquery_projects_get_service_account' => ['class' => GoogleBigQueryProjectsGetServiceAccount::class, 'type' => 'read', 'name' => 'Projects Get Service Account', 'description' => 'Projects Get Service Account (GET /projects/{+projectId}/serviceAccount).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_projects_list' => ['class' => GoogleBigQueryProjectsList::class, 'type' => 'read', 'name' => 'Projects List', 'description' => 'Projects List (GET /projects).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_routines_delete' => ['class' => GoogleBigQueryRoutinesDelete::class, 'type' => 'write', 'name' => 'Routines Delete', 'description' => 'Routines Delete (DELETE /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}).', 'icon' => 'ph:database'],
            'google_bigquery_routines_get' => ['class' => GoogleBigQueryRoutinesGet::class, 'type' => 'read', 'name' => 'Routines Get', 'description' => 'Routines Get (GET /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_routines_get_iam_policy' => ['class' => GoogleBigQueryRoutinesGetIamPolicy::class, 'type' => 'write', 'name' => 'Routines Get Iam Policy', 'description' => 'Routines Get Iam Policy (POST /{+resource}:getIamPolicy).', 'icon' => 'ph:database'],
            'google_bigquery_routines_insert' => ['class' => GoogleBigQueryRoutinesInsert::class, 'type' => 'write', 'name' => 'Routines Insert', 'description' => 'Routines Insert (POST /projects/{+projectId}/datasets/{+datasetId}/routines).', 'icon' => 'ph:database'],
            'google_bigquery_routines_list' => ['class' => GoogleBigQueryRoutinesList::class, 'type' => 'read', 'name' => 'Routines List', 'description' => 'Routines List (GET /projects/{+projectId}/datasets/{+datasetId}/routines).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_routines_set_iam_policy' => ['class' => GoogleBigQueryRoutinesSetIamPolicy::class, 'type' => 'write', 'name' => 'Routines Set Iam Policy', 'description' => 'Routines Set Iam Policy (POST /{+resource}:setIamPolicy).', 'icon' => 'ph:database'],
            'google_bigquery_routines_test_iam_permissions' => ['class' => GoogleBigQueryRoutinesTestIamPermissions::class, 'type' => 'write', 'name' => 'Routines Test Iam Permissions', 'description' => 'Routines Test Iam Permissions (POST /{+resource}:testIamPermissions).', 'icon' => 'ph:database'],
            'google_bigquery_routines_update' => ['class' => GoogleBigQueryRoutinesUpdate::class, 'type' => 'write', 'name' => 'Routines Update', 'description' => 'Routines Update (PUT /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_batch_delete' => ['class' => GoogleBigQueryRowAccessPoliciesBatchDelete::class, 'type' => 'write', 'name' => 'Row Access Policies Batch Delete', 'description' => 'Row Access Policies Batch Delete (POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies:batchDelete).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_delete' => ['class' => GoogleBigQueryRowAccessPoliciesDelete::class, 'type' => 'write', 'name' => 'Row Access Policies Delete', 'description' => 'Row Access Policies Delete (DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_get' => ['class' => GoogleBigQueryRowAccessPoliciesGet::class, 'type' => 'read', 'name' => 'Row Access Policies Get', 'description' => 'Row Access Policies Get (GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_row_access_policies_get_iam_policy' => ['class' => GoogleBigQueryRowAccessPoliciesGetIamPolicy::class, 'type' => 'write', 'name' => 'Row Access Policies Get Iam Policy', 'description' => 'Row Access Policies Get Iam Policy (POST /{+resource}:getIamPolicy).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_insert' => ['class' => GoogleBigQueryRowAccessPoliciesInsert::class, 'type' => 'write', 'name' => 'Row Access Policies Insert', 'description' => 'Row Access Policies Insert (POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_list' => ['class' => GoogleBigQueryRowAccessPoliciesList::class, 'type' => 'read', 'name' => 'Row Access Policies List', 'description' => 'Row Access Policies List (GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_row_access_policies_test_iam_permissions' => ['class' => GoogleBigQueryRowAccessPoliciesTestIamPermissions::class, 'type' => 'write', 'name' => 'Row Access Policies Test Iam Permissions', 'description' => 'Row Access Policies Test Iam Permissions (POST /{+resource}:testIamPermissions).', 'icon' => 'ph:database'],
            'google_bigquery_row_access_policies_update' => ['class' => GoogleBigQueryRowAccessPoliciesUpdate::class, 'type' => 'write', 'name' => 'Row Access Policies Update', 'description' => 'Row Access Policies Update (PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}).', 'icon' => 'ph:database'],
            'google_bigquery_tabledata_insert_all' => ['class' => GoogleBigQueryTabledataInsertAll::class, 'type' => 'write', 'name' => 'Tabledata Insert All', 'description' => 'Tabledata Insert All (POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/insertAll).', 'icon' => 'ph:database'],
            'google_bigquery_tabledata_list' => ['class' => GoogleBigQueryTabledataList::class, 'type' => 'read', 'name' => 'Tabledata List', 'description' => 'Tabledata List (GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/data).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_tables_delete' => ['class' => GoogleBigQueryTablesDelete::class, 'type' => 'write', 'name' => 'Tables Delete', 'description' => 'Tables Delete (DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}).', 'icon' => 'ph:database'],
            'google_bigquery_tables_get' => ['class' => GoogleBigQueryTablesGet::class, 'type' => 'read', 'name' => 'Tables Get', 'description' => 'Tables Get (GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_tables_get_iam_policy' => ['class' => GoogleBigQueryTablesGetIamPolicy::class, 'type' => 'write', 'name' => 'Tables Get Iam Policy', 'description' => 'Tables Get Iam Policy (POST /{+resource}:getIamPolicy).', 'icon' => 'ph:database'],
            'google_bigquery_tables_insert' => ['class' => GoogleBigQueryTablesInsert::class, 'type' => 'write', 'name' => 'Tables Insert', 'description' => 'Tables Insert (POST /projects/{+projectId}/datasets/{+datasetId}/tables).', 'icon' => 'ph:database'],
            'google_bigquery_tables_list' => ['class' => GoogleBigQueryTablesList::class, 'type' => 'read', 'name' => 'Tables List', 'description' => 'Tables List (GET /projects/{+projectId}/datasets/{+datasetId}/tables).', 'icon' => 'ph:magnifying-glass'],
            'google_bigquery_tables_patch' => ['class' => GoogleBigQueryTablesPatch::class, 'type' => 'write', 'name' => 'Tables Patch', 'description' => 'Tables Patch (PATCH /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}).', 'icon' => 'ph:database'],
            'google_bigquery_tables_set_iam_policy' => ['class' => GoogleBigQueryTablesSetIamPolicy::class, 'type' => 'write', 'name' => 'Tables Set Iam Policy', 'description' => 'Tables Set Iam Policy (POST /{+resource}:setIamPolicy).', 'icon' => 'ph:database'],
            'google_bigquery_tables_test_iam_permissions' => ['class' => GoogleBigQueryTablesTestIamPermissions::class, 'type' => 'write', 'name' => 'Tables Test Iam Permissions', 'description' => 'Tables Test Iam Permissions (POST /{+resource}:testIamPermissions).', 'icon' => 'ph:database'],
            'google_bigquery_tables_update' => ['class' => GoogleBigQueryTablesUpdate::class, 'type' => 'write', 'name' => 'Tables Update', 'description' => 'Tables Update (PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}).', 'icon' => 'ph:database'],
        ];
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Google BigQuery tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleBigQueryService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GoogleBigQueryService(
                accessToken: $creds->get('google-bigquery', 'access_token', '', $account),
                baseUrl: $creds->get('google-bigquery', 'url', 'https://bigquery.googleapis.com/bigquery/v2', $account),
            );
        }

        return app(GoogleBigQueryService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-bigquery.md';
    }
}