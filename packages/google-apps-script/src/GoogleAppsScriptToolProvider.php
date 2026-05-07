<?php

namespace OpenCompany\Integrations\GoogleAppsScript;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Apps Script.
 *
 * Exposes generated coverage for the official Apps Script v1 Discovery
 * document, including projects, source content, deployments, versions, metrics,
 * process history, and script function execution.
 */
class GoogleAppsScriptToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Apps Script API scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-apps-script'; }
    public function appMeta(): array { return ['label' => 'Google Apps Script', 'description' => 'Projects, source content, deployments, versions, metrics, processes, and script execution', 'icon' => 'ph:code', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Apps Script', 'description' => 'Generated coverage for the Apps Script v1 REST API: script projects, source content, deployments, versions, metrics, process history, and function execution.', 'icon' => 'ph:code', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/apps-script/api/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Apps Script API scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://script.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://script.googleapis.com']]; }

    /**
     * Verify Google Apps Script credentials with token-presence only because project listing is not part of the API.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        return ['success' => true, 'message' => 'Google Apps Script token is present. Use a scriptId with a project get/content tool for a live project-specific check.'];
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_apps_script_projects_get_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsGetContent',
  'type' => 'read',
  'name' => 'Projects Get Content',
  'description' => 'Projects Get Content (GET /v1/projects/{scriptId}/content).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsGet',
  'type' => 'read',
  'name' => 'Projects Get',
  'description' => 'Projects Get (GET /v1/projects/{scriptId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsCreate',
  'type' => 'write',
  'name' => 'Projects Create',
  'description' => 'Projects Create (POST /v1/projects).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_update_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsUpdateContent',
  'type' => 'write',
  'name' => 'Projects Update Content',
  'description' => 'Projects Update Content (PUT /v1/projects/{scriptId}/content).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_get_metrics' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsGetMetrics',
  'type' => 'read',
  'name' => 'Projects Get Metrics',
  'description' => 'Projects Get Metrics (GET /v1/projects/{scriptId}/metrics).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_deployments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsDeploymentsDelete',
  'type' => 'write',
  'name' => 'Projects Deployments Delete',
  'description' => 'Projects Deployments Delete (DELETE /v1/projects/{scriptId}/deployments/{deploymentId}).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_deployments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsDeploymentsCreate',
  'type' => 'write',
  'name' => 'Projects Deployments Create',
  'description' => 'Projects Deployments Create (POST /v1/projects/{scriptId}/deployments).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_deployments_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsDeploymentsUpdate',
  'type' => 'write',
  'name' => 'Projects Deployments Update',
  'description' => 'Projects Deployments Update (PUT /v1/projects/{scriptId}/deployments/{deploymentId}).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_deployments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsDeploymentsList',
  'type' => 'read',
  'name' => 'Projects Deployments List',
  'description' => 'Projects Deployments List (GET /v1/projects/{scriptId}/deployments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_deployments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsDeploymentsGet',
  'type' => 'read',
  'name' => 'Projects Deployments Get',
  'description' => 'Projects Deployments Get (GET /v1/projects/{scriptId}/deployments/{deploymentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_versions_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsVersionsCreate',
  'type' => 'write',
  'name' => 'Projects Versions Create',
  'description' => 'Projects Versions Create (POST /v1/projects/{scriptId}/versions).',
  'icon' => 'ph:code',
),
            'google_apps_script_projects_versions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsVersionsList',
  'type' => 'read',
  'name' => 'Projects Versions List',
  'description' => 'Projects Versions List (GET /v1/projects/{scriptId}/versions).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_projects_versions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProjectsVersionsGet',
  'type' => 'read',
  'name' => 'Projects Versions Get',
  'description' => 'Projects Versions Get (GET /v1/projects/{scriptId}/versions/{versionNumber}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_processes_list_script_processes' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProcessesListScriptProcesses',
  'type' => 'read',
  'name' => 'Processes List Script Processes',
  'description' => 'Processes List Script Processes (GET /v1/processes:listScriptProcesses).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_processes_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptProcessesList',
  'type' => 'read',
  'name' => 'Processes List',
  'description' => 'Processes List (GET /v1/processes).',
  'icon' => 'ph:magnifying-glass',
),
            'google_apps_script_scripts_run' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAppsScript\\Tools\\GoogleAppsScriptScriptsRun',
  'type' => 'write',
  'name' => 'Scripts Run',
  'description' => 'Scripts Run (POST /v1/scripts/{scriptId}:run).',
  'icon' => 'ph:code',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Apps Script tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleAppsScriptService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleAppsScriptService(accessToken: $creds->get('google-apps-script', 'access_token', '', $account), baseUrl: $creds->get('google-apps-script', 'url', 'https://script.googleapis.com', $account));
        }
        return app(GoogleAppsScriptService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-apps-script.md'; }
}