<?php

namespace OpenCompany\Integrations\GoogleCloudRun;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsExportImageMetadata;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsExportProjectMetadata;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsExportImage;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsExportMetadata;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesPatch;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesCreate;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesRevisionsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesRevisionsExportStatus;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesRevisionsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesRevisionsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsCreate;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsPatch;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsRun;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsExportStatus;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsCancel;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsTasksGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsExecutionsTasksList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsOperationsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsOperationsWait;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsOperationsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsOperationsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesStop;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesStart;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesPatch;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesCreate;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsInstancesGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsPatch;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsCreate;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsGet;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsList;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsDelete;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsBuildsSubmit;

/**
 * Tool catalog and configuration metadata for Google Cloud Run.
 *
 * Exposes generated coverage for the official Cloud Run v2 Discovery document,
 * including services, jobs, revisions, executions, tasks, operations, instances,
 * worker pools, builds, exports, and IAM helpers.
 */
class GoogleCloudRunToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Cloud Run scopes such as https://www.googleapis.com/auth/cloud-platform.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-cloud-run'; }
    public function appMeta(): array { return ['label' => 'Google Cloud Run', 'description' => 'Serverless containers, services, jobs, executions, worker pools, and operations', 'icon' => 'ph:cloud', 'logo' => 'logos:google-cloud']; }
    public function integrationMeta(): array { return ['name' => 'Google Cloud Run', 'description' => 'Generated coverage for the Cloud Run v2 Admin API: services, jobs, revisions, executions, tasks, operations, instances, worker pools, builds, exports, and IAM.', 'icon' => 'ph:cloud', 'logo' => 'logos:google-cloud', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://cloud.google.com/run/docs/reference/rest/v2']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Cloud Run or cloud-platform scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://run.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://run.googleapis.com']]; }

    /**
     * Verify Google Cloud Run credentials with a lightweight service list call when parent is supplied.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://run.googleapis.com'), '/');
        $parent = (string) ($config['parent'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        if ($parent === '') return ['success' => true, 'message' => 'Google Cloud Run token is present. Provide a parent such as projects/example/locations/us-central1 to run a live service-list credential check.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v2/'.str_replace('%2F','/',rawurlencode($parent)).'/services', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Cloud Run API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Cloud Run at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [            'google_cloud_run_projects_locations_export_image_metadata' => ['class' => GoogleCloudRunProjectsLocationsExportImageMetadata::class, 'type' => 'read', 'name' => 'Projects Locations Export Image Metadata', 'description' => 'Projects Locations Export Image Metadata (GET /v2/{+name}:exportImageMetadata).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_export_project_metadata' => ['class' => GoogleCloudRunProjectsLocationsExportProjectMetadata::class, 'type' => 'read', 'name' => 'Projects Locations Export Project Metadata', 'description' => 'Projects Locations Export Project Metadata (GET /v2/{+name}:exportProjectMetadata).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_export_image' => ['class' => GoogleCloudRunProjectsLocationsExportImage::class, 'type' => 'write', 'name' => 'Projects Locations Export Image', 'description' => 'Projects Locations Export Image (POST /v2/{+name}:exportImage).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_export_metadata' => ['class' => GoogleCloudRunProjectsLocationsExportMetadata::class, 'type' => 'read', 'name' => 'Projects Locations Export Metadata', 'description' => 'Projects Locations Export Metadata (GET /v2/{+name}:exportMetadata).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_list' => ['class' => GoogleCloudRunProjectsLocationsServicesList::class, 'type' => 'read', 'name' => 'Projects Locations Services List', 'description' => 'Projects Locations Services List (GET /v2/{+parent}/services).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_delete' => ['class' => GoogleCloudRunProjectsLocationsServicesDelete::class, 'type' => 'write', 'name' => 'Projects Locations Services Delete', 'description' => 'Projects Locations Services Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_services_set_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsServicesSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Locations Services Set Iam Policy', 'description' => 'Projects Locations Services Set Iam Policy (POST /v2/{+resource}:setIamPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_services_get' => ['class' => GoogleCloudRunProjectsLocationsServicesGet::class, 'type' => 'read', 'name' => 'Projects Locations Services Get', 'description' => 'Projects Locations Services Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_get_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsServicesGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Locations Services Get Iam Policy', 'description' => 'Projects Locations Services Get Iam Policy (GET /v2/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_patch' => ['class' => GoogleCloudRunProjectsLocationsServicesPatch::class, 'type' => 'write', 'name' => 'Projects Locations Services Patch', 'description' => 'Projects Locations Services Patch (PATCH /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_services_create' => ['class' => GoogleCloudRunProjectsLocationsServicesCreate::class, 'type' => 'write', 'name' => 'Projects Locations Services Create', 'description' => 'Projects Locations Services Create (POST /v2/{+parent}/services).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_services_test_iam_permissions' => ['class' => GoogleCloudRunProjectsLocationsServicesTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Locations Services Test Iam Permissions', 'description' => 'Projects Locations Services Test Iam Permissions (POST /v2/{+resource}:testIamPermissions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_services_revisions_get' => ['class' => GoogleCloudRunProjectsLocationsServicesRevisionsGet::class, 'type' => 'read', 'name' => 'Projects Locations Services Revisions Get', 'description' => 'Projects Locations Services Revisions Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_revisions_export_status' => ['class' => GoogleCloudRunProjectsLocationsServicesRevisionsExportStatus::class, 'type' => 'read', 'name' => 'Projects Locations Services Revisions Export Status', 'description' => 'Projects Locations Services Revisions Export Status (GET /v2/{+name}/{+operationId}:exportStatus).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_revisions_list' => ['class' => GoogleCloudRunProjectsLocationsServicesRevisionsList::class, 'type' => 'read', 'name' => 'Projects Locations Services Revisions List', 'description' => 'Projects Locations Services Revisions List (GET /v2/{+parent}/revisions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_services_revisions_delete' => ['class' => GoogleCloudRunProjectsLocationsServicesRevisionsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Services Revisions Delete', 'description' => 'Projects Locations Services Revisions Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_create' => ['class' => GoogleCloudRunProjectsLocationsJobsCreate::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Create', 'description' => 'Projects Locations Jobs Create (POST /v2/{+parent}/jobs).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_test_iam_permissions' => ['class' => GoogleCloudRunProjectsLocationsJobsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Test Iam Permissions', 'description' => 'Projects Locations Jobs Test Iam Permissions (POST /v2/{+resource}:testIamPermissions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_patch' => ['class' => GoogleCloudRunProjectsLocationsJobsPatch::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Patch', 'description' => 'Projects Locations Jobs Patch (PATCH /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_get' => ['class' => GoogleCloudRunProjectsLocationsJobsGet::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Get', 'description' => 'Projects Locations Jobs Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_list' => ['class' => GoogleCloudRunProjectsLocationsJobsList::class, 'type' => 'read', 'name' => 'Projects Locations Jobs List', 'description' => 'Projects Locations Jobs List (GET /v2/{+parent}/jobs).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_delete' => ['class' => GoogleCloudRunProjectsLocationsJobsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Delete', 'description' => 'Projects Locations Jobs Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_get_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsJobsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Get Iam Policy', 'description' => 'Projects Locations Jobs Get Iam Policy (GET /v2/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_run' => ['class' => GoogleCloudRunProjectsLocationsJobsRun::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Run', 'description' => 'Projects Locations Jobs Run (POST /v2/{+name}:run).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_set_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsJobsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Set Iam Policy', 'description' => 'Projects Locations Jobs Set Iam Policy (POST /v2/{+resource}:setIamPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_executions_export_status' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsExportStatus::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Executions Export Status', 'description' => 'Projects Locations Jobs Executions Export Status (GET /v2/{+name}/{+operationId}:exportStatus).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_executions_cancel' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsCancel::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Executions Cancel', 'description' => 'Projects Locations Jobs Executions Cancel (POST /v2/{+name}:cancel).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_executions_list' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsList::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Executions List', 'description' => 'Projects Locations Jobs Executions List (GET /v2/{+parent}/executions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_executions_delete' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Jobs Executions Delete', 'description' => 'Projects Locations Jobs Executions Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_jobs_executions_get' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsGet::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Executions Get', 'description' => 'Projects Locations Jobs Executions Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_executions_tasks_get' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsTasksGet::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Executions Tasks Get', 'description' => 'Projects Locations Jobs Executions Tasks Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_jobs_executions_tasks_list' => ['class' => GoogleCloudRunProjectsLocationsJobsExecutionsTasksList::class, 'type' => 'read', 'name' => 'Projects Locations Jobs Executions Tasks List', 'description' => 'Projects Locations Jobs Executions Tasks List (GET /v2/{+parent}/tasks).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_operations_get' => ['class' => GoogleCloudRunProjectsLocationsOperationsGet::class, 'type' => 'read', 'name' => 'Projects Locations Operations Get', 'description' => 'Projects Locations Operations Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_operations_wait' => ['class' => GoogleCloudRunProjectsLocationsOperationsWait::class, 'type' => 'write', 'name' => 'Projects Locations Operations Wait', 'description' => 'Projects Locations Operations Wait (POST /v2/{+name}:wait).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_operations_list' => ['class' => GoogleCloudRunProjectsLocationsOperationsList::class, 'type' => 'read', 'name' => 'Projects Locations Operations List', 'description' => 'Projects Locations Operations List (GET /v2/{+name}/operations).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_operations_delete' => ['class' => GoogleCloudRunProjectsLocationsOperationsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Operations Delete', 'description' => 'Projects Locations Operations Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_get_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsInstancesGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Locations Instances Get Iam Policy', 'description' => 'Projects Locations Instances Get Iam Policy (GET /v2/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_instances_stop' => ['class' => GoogleCloudRunProjectsLocationsInstancesStop::class, 'type' => 'write', 'name' => 'Projects Locations Instances Stop', 'description' => 'Projects Locations Instances Stop (POST /v2/{+name}:stop).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_set_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsInstancesSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Locations Instances Set Iam Policy', 'description' => 'Projects Locations Instances Set Iam Policy (POST /v2/{+resource}:setIamPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_start' => ['class' => GoogleCloudRunProjectsLocationsInstancesStart::class, 'type' => 'write', 'name' => 'Projects Locations Instances Start', 'description' => 'Projects Locations Instances Start (POST /v2/{+name}:start).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_patch' => ['class' => GoogleCloudRunProjectsLocationsInstancesPatch::class, 'type' => 'write', 'name' => 'Projects Locations Instances Patch', 'description' => 'Projects Locations Instances Patch (PATCH /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_create' => ['class' => GoogleCloudRunProjectsLocationsInstancesCreate::class, 'type' => 'write', 'name' => 'Projects Locations Instances Create', 'description' => 'Projects Locations Instances Create (POST /v2/{+parent}/instances).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_test_iam_permissions' => ['class' => GoogleCloudRunProjectsLocationsInstancesTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Locations Instances Test Iam Permissions', 'description' => 'Projects Locations Instances Test Iam Permissions (POST /v2/{+resource}:testIamPermissions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_delete' => ['class' => GoogleCloudRunProjectsLocationsInstancesDelete::class, 'type' => 'write', 'name' => 'Projects Locations Instances Delete', 'description' => 'Projects Locations Instances Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_instances_list' => ['class' => GoogleCloudRunProjectsLocationsInstancesList::class, 'type' => 'read', 'name' => 'Projects Locations Instances List', 'description' => 'Projects Locations Instances List (GET /v2/{+parent}/instances).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_instances_get' => ['class' => GoogleCloudRunProjectsLocationsInstancesGet::class, 'type' => 'read', 'name' => 'Projects Locations Instances Get', 'description' => 'Projects Locations Instances Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_patch' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsPatch::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Patch', 'description' => 'Projects Locations Worker Pools Patch (PATCH /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_worker_pools_get_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Locations Worker Pools Get Iam Policy', 'description' => 'Projects Locations Worker Pools Get Iam Policy (GET /v2/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_create' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsCreate::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Create', 'description' => 'Projects Locations Worker Pools Create (POST /v2/{+parent}/workerPools).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_worker_pools_test_iam_permissions' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Test Iam Permissions', 'description' => 'Projects Locations Worker Pools Test Iam Permissions (POST /v2/{+resource}:testIamPermissions).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_worker_pools_set_iam_policy' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Set Iam Policy', 'description' => 'Projects Locations Worker Pools Set Iam Policy (POST /v2/{+resource}:setIamPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_worker_pools_list' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsList::class, 'type' => 'read', 'name' => 'Projects Locations Worker Pools List', 'description' => 'Projects Locations Worker Pools List (GET /v2/{+parent}/workerPools).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_delete' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Delete', 'description' => 'Projects Locations Worker Pools Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_worker_pools_get' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsGet::class, 'type' => 'read', 'name' => 'Projects Locations Worker Pools Get', 'description' => 'Projects Locations Worker Pools Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_revisions_get' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsGet::class, 'type' => 'read', 'name' => 'Projects Locations Worker Pools Revisions Get', 'description' => 'Projects Locations Worker Pools Revisions Get (GET /v2/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_revisions_list' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsList::class, 'type' => 'read', 'name' => 'Projects Locations Worker Pools Revisions List', 'description' => 'Projects Locations Worker Pools Revisions List (GET /v2/{+parent}/revisions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_run_projects_locations_worker_pools_revisions_delete' => ['class' => GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsDelete::class, 'type' => 'write', 'name' => 'Projects Locations Worker Pools Revisions Delete', 'description' => 'Projects Locations Worker Pools Revisions Delete (DELETE /v2/{+name}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_run_projects_locations_builds_submit' => ['class' => GoogleCloudRunProjectsLocationsBuildsSubmit::class, 'type' => 'write', 'name' => 'Projects Locations Builds Submit', 'description' => 'Projects Locations Builds Submit (POST /v2/{+parent}/builds:submit).', 'icon' => 'ph:cloud-arrow-up'],
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Cloud Run tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleCloudRunService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleCloudRunService(accessToken: $creds->get('google-cloud-run', 'access_token', '', $account), baseUrl: $creds->get('google-cloud-run', 'url', 'https://run.googleapis.com', $account));
        }
        return app(GoogleCloudRunService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-cloud-run.md'; }
}