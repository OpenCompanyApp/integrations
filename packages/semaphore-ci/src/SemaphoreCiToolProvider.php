<?php

namespace OpenCompany\Integrations\SemaphoreCi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiActivateDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiApiDelete;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiApiGet;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiApiPatch;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiApiPost;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiConfigureArtifactRetentionPolicy;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiCreateAgentType;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiCreateDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiDeactivateDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiDeleteAgentType;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiDeleteDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiDisableAgentTypeAgents;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetAgent;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetAgentType;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetArtifactRetentionPolicy;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetArtifactSignedUrl;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetDeploymentHistory;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetJob;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetJobLogs;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetPipeline;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetWorkflow;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListAgents;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListAgentTypes;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListArtifacts;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListDeploymentTargets;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListPipelines;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListPromotions;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListWorkflows;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiPartialRebuildPipeline;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiRerunWorkflow;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiRunWorkflow;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiStopJob;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiStopPipeline;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiStopWorkflow;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiTriggerPromotion;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiTriggerTask;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiUpdateAgentType;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiUpdateDeploymentTarget;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiValidateYaml;

/**
 * Tool catalog and configuration metadata for Semaphore CI.
 *
 * Exposes Semaphore API v1alpha operations for workflows, pipelines,
 * promotions, tasks, jobs, agents, targets, artifacts, and raw helper calls.
 */
class SemaphoreCiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_token'],
                'notes' => ['Semaphore API v1alpha uses Authorization: Token <token> and requires User-Agent: SemaphoreCI v2.0 Client.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'semaphore-ci';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Semaphore CI',
            'description' => 'CI/CD workflows, pipelines, jobs, agents, deployment targets, and artifacts',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Semaphore CI',
            'description' => 'Manage Semaphore workflows, pipelines, promotions, jobs, self-hosted agents, deployment targets, artifacts, and retention policies through API v1alpha.',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.semaphore.io/reference/api',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Semaphore credentials with a lightweight workflows request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            $baseUrl = $this->normalizeBaseUrl((string) ($config['url'] ?? ''));
            if ($token === '' || $baseUrl === '') {
                return ['success' => false, 'error' => 'Semaphore CI API URL and token are required.'];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Token '.$token,
                'Accept' => 'application/json',
                'User-Agent' => 'SemaphoreCI v2.0 Client',
            ])->timeout(20)->get($baseUrl.'/plumber-workflows', ['project_id' => 'connection-test']);

            if (in_array($response->status(), [200, 400, 404], true)) {
                return ['success' => true, 'message' => 'Connected to Semaphore CI API.'];
            }

            return ['success' => false, 'error' => 'Semaphore CI API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['url' => 'required|string', 'api_token' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'url', 'type' => 'text', 'label' => 'Organization API URL', 'placeholder' => 'https://example.semaphoreci.com', 'hint' => 'Semaphore organization URL. /api/v1alpha is appended automatically when omitted.', 'required' => true],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'semaphore-token', 'hint' => 'Semaphore API token with permissions for the tools you want to use.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'semaphore_ci_run_workflow' => ['class' => SemaphoreCiRunWorkflow::class, 'type' => 'write', 'name' => 'Run Workflow', 'description' => 'Run a workflow for a project and reference.', 'icon' => 'ph:play'],
            'semaphore_ci_get_workflow' => ['class' => SemaphoreCiGetWorkflow::class, 'type' => 'read', 'name' => 'Get Workflow', 'description' => 'Get one workflow by id.', 'icon' => 'ph:git-branch'],
            'semaphore_ci_list_workflows' => ['class' => SemaphoreCiListWorkflows::class, 'type' => 'read', 'name' => 'List Workflows', 'description' => 'List workflows for a project.', 'icon' => 'ph:list-checks'],
            'semaphore_ci_rerun_workflow' => ['class' => SemaphoreCiRerunWorkflow::class, 'type' => 'write', 'name' => 'Rerun Workflow', 'description' => 'Rerun a workflow with an idempotency token.', 'icon' => 'ph:arrow-clockwise'],
            'semaphore_ci_stop_workflow' => ['class' => SemaphoreCiStopWorkflow::class, 'type' => 'write', 'name' => 'Stop Workflow', 'description' => 'Stop a workflow.', 'icon' => 'ph:x-circle'],
            'semaphore_ci_get_pipeline' => ['class' => SemaphoreCiGetPipeline::class, 'type' => 'read', 'name' => 'Get Pipeline', 'description' => 'Get one pipeline by id.', 'icon' => 'ph:git-branch'],
            'semaphore_ci_list_pipelines' => ['class' => SemaphoreCiListPipelines::class, 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List pipelines by project or workflow id.', 'icon' => 'ph:list-checks'],
            'semaphore_ci_stop_pipeline' => ['class' => SemaphoreCiStopPipeline::class, 'type' => 'write', 'name' => 'Stop Pipeline', 'description' => 'Stop a pipeline.', 'icon' => 'ph:x-circle'],
            'semaphore_ci_partial_rebuild_pipeline' => ['class' => SemaphoreCiPartialRebuildPipeline::class, 'type' => 'write', 'name' => 'Partial Rebuild Pipeline', 'description' => 'Rebuild failed pipeline blocks.', 'icon' => 'ph:arrows-clockwise'],
            'semaphore_ci_validate_yaml' => ['class' => SemaphoreCiValidateYaml::class, 'type' => 'write', 'name' => 'Validate YAML', 'description' => 'Validate Semaphore pipeline YAML.', 'icon' => 'ph:file-code'],
            'semaphore_ci_list_promotions' => ['class' => SemaphoreCiListPromotions::class, 'type' => 'read', 'name' => 'List Promotions', 'description' => 'List promotions for a pipeline.', 'icon' => 'ph:rocket-launch'],
            'semaphore_ci_trigger_promotion' => ['class' => SemaphoreCiTriggerPromotion::class, 'type' => 'write', 'name' => 'Trigger Promotion', 'description' => 'Trigger a pipeline promotion.', 'icon' => 'ph:rocket-launch'],
            'semaphore_ci_trigger_task' => ['class' => SemaphoreCiTriggerTask::class, 'type' => 'write', 'name' => 'Trigger Task', 'description' => 'Run a Semaphore task immediately.', 'icon' => 'ph:play-circle'],
            'semaphore_ci_get_job' => ['class' => SemaphoreCiGetJob::class, 'type' => 'read', 'name' => 'Get Job', 'description' => 'Get one job by id.', 'icon' => 'ph:check-circle'],
            'semaphore_ci_stop_job' => ['class' => SemaphoreCiStopJob::class, 'type' => 'write', 'name' => 'Stop Job', 'description' => 'Stop one job by id.', 'icon' => 'ph:x-circle'],
            'semaphore_ci_get_job_logs' => ['class' => SemaphoreCiGetJobLogs::class, 'type' => 'read', 'name' => 'Get Job Logs', 'description' => 'Get job logs.', 'icon' => 'ph:file-text'],
            'semaphore_ci_list_agent_types' => ['class' => SemaphoreCiListAgentTypes::class, 'type' => 'read', 'name' => 'List Agent Types', 'description' => 'List self-hosted agent types.', 'icon' => 'ph:hard-drives'],
            'semaphore_ci_create_agent_type' => ['class' => SemaphoreCiCreateAgentType::class, 'type' => 'write', 'name' => 'Create Agent Type', 'description' => 'Create a self-hosted agent type.', 'icon' => 'ph:plus-circle'],
            'semaphore_ci_update_agent_type' => ['class' => SemaphoreCiUpdateAgentType::class, 'type' => 'write', 'name' => 'Update Agent Type', 'description' => 'Update a self-hosted agent type.', 'icon' => 'ph:pencil'],
            'semaphore_ci_get_agent_type' => ['class' => SemaphoreCiGetAgentType::class, 'type' => 'read', 'name' => 'Get Agent Type', 'description' => 'Get a self-hosted agent type.', 'icon' => 'ph:hard-drive'],
            'semaphore_ci_delete_agent_type' => ['class' => SemaphoreCiDeleteAgentType::class, 'type' => 'write', 'name' => 'Delete Agent Type', 'description' => 'Delete a self-hosted agent type.', 'icon' => 'ph:trash'],
            'semaphore_ci_disable_agent_type_agents' => ['class' => SemaphoreCiDisableAgentTypeAgents::class, 'type' => 'write', 'name' => 'Disable Agent Type Agents', 'description' => 'Disable agents for an agent type.', 'icon' => 'ph:pause-circle'],
            'semaphore_ci_list_agents' => ['class' => SemaphoreCiListAgents::class, 'type' => 'read', 'name' => 'List Agents', 'description' => 'List self-hosted agents.', 'icon' => 'ph:hard-drives'],
            'semaphore_ci_get_agent' => ['class' => SemaphoreCiGetAgent::class, 'type' => 'read', 'name' => 'Get Agent', 'description' => 'Get one self-hosted agent.', 'icon' => 'ph:hard-drive'],
            'semaphore_ci_list_deployment_targets' => ['class' => SemaphoreCiListDeploymentTargets::class, 'type' => 'read', 'name' => 'List Deployment Targets', 'description' => 'List deployment targets for a project.', 'icon' => 'ph:target'],
            'semaphore_ci_get_deployment_target' => ['class' => SemaphoreCiGetDeploymentTarget::class, 'type' => 'read', 'name' => 'Get Deployment Target', 'description' => 'Get one deployment target.', 'icon' => 'ph:target'],
            'semaphore_ci_create_deployment_target' => ['class' => SemaphoreCiCreateDeploymentTarget::class, 'type' => 'write', 'name' => 'Create Deployment Target', 'description' => 'Create a deployment target.', 'icon' => 'ph:plus-circle'],
            'semaphore_ci_update_deployment_target' => ['class' => SemaphoreCiUpdateDeploymentTarget::class, 'type' => 'write', 'name' => 'Update Deployment Target', 'description' => 'Update a deployment target.', 'icon' => 'ph:pencil'],
            'semaphore_ci_delete_deployment_target' => ['class' => SemaphoreCiDeleteDeploymentTarget::class, 'type' => 'write', 'name' => 'Delete Deployment Target', 'description' => 'Delete a deployment target.', 'icon' => 'ph:trash'],
            'semaphore_ci_deactivate_deployment_target' => ['class' => SemaphoreCiDeactivateDeploymentTarget::class, 'type' => 'write', 'name' => 'Deactivate Deployment Target', 'description' => 'Deactivate a deployment target.', 'icon' => 'ph:pause-circle'],
            'semaphore_ci_activate_deployment_target' => ['class' => SemaphoreCiActivateDeploymentTarget::class, 'type' => 'write', 'name' => 'Activate Deployment Target', 'description' => 'Activate a deployment target.', 'icon' => 'ph:play-circle'],
            'semaphore_ci_get_deployment_history' => ['class' => SemaphoreCiGetDeploymentHistory::class, 'type' => 'read', 'name' => 'Get Deployment History', 'description' => 'Retrieve deployment history.', 'icon' => 'ph:clock-counter-clockwise'],
            'semaphore_ci_list_artifacts' => ['class' => SemaphoreCiListArtifacts::class, 'type' => 'read', 'name' => 'List Artifacts', 'description' => 'List artifacts by scope.', 'icon' => 'ph:archive'],
            'semaphore_ci_get_artifact_signed_url' => ['class' => SemaphoreCiGetArtifactSignedUrl::class, 'type' => 'read', 'name' => 'Get Artifact Signed URL', 'description' => 'Get a signed artifact URL.', 'icon' => 'ph:link'],
            'semaphore_ci_configure_artifact_retention_policy' => ['class' => SemaphoreCiConfigureArtifactRetentionPolicy::class, 'type' => 'write', 'name' => 'Configure Artifact Retention', 'description' => 'Configure artifact retention policies.', 'icon' => 'ph:clock'],
            'semaphore_ci_get_artifact_retention_policy' => ['class' => SemaphoreCiGetArtifactRetentionPolicy::class, 'type' => 'read', 'name' => 'Get Artifact Retention', 'description' => 'Get artifact retention policy.', 'icon' => 'ph:clock'],
            'semaphore_ci_api_get' => ['class' => SemaphoreCiApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Semaphore GET path.', 'icon' => 'ph:code'],
            'semaphore_ci_api_post' => ['class' => SemaphoreCiApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Semaphore POST path.', 'icon' => 'ph:code'],
            'semaphore_ci_api_patch' => ['class' => SemaphoreCiApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Semaphore PATCH path.', 'icon' => 'ph:code'],
            'semaphore_ci_api_delete' => ['class' => SemaphoreCiApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Semaphore DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Semaphore tool instance.
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
    private function resolveService(array $context = []): SemaphoreCiService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SemaphoreCiService(
                apiToken: $creds->get('semaphore-ci', 'api_token', '', $account),
                baseUrl: $creds->get('semaphore-ci', 'url', '', $account),
            );
        }

        return app(SemaphoreCiService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/semaphore-ci.md';
    }

    private function normalizeBaseUrl(string $url): string
    {
        $url = rtrim(trim($url), '/');
        if ($url === '') {
            return '';
        }

        return str_ends_with($url, '/api/v1alpha') ? $url : $url.'/api/v1alpha';
    }
}
