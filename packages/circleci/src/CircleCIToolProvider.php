<?php

namespace OpenCompany\Integrations\CircleCI;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides CircleCI tools, metadata, configuration, and connection checks.
 */
class CircleCIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['CircleCI API v2 uses the Circle-Token header with a personal API token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'circleci';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CircleCI',
            'description' => 'CI/CD pipeline management',
            'icon' => 'ph:git-branch',
            'logo' => 'simple-icons:circleci',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CircleCI',
            'description' => 'Manage CircleCI pipelines, workflows, jobs, projects, contexts, schedules, webhooks, and insights.',
            'icon' => 'ph:git-branch',
            'logo' => 'simple-icons:circleci',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://circleci.com/docs/api/v2/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal API Token', 'placeholder' => 'CircleCI personal API token', 'hint' => 'Generate a personal API token in CircleCI user settings.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://circleci.com/api', 'hint' => 'Use https://circleci.com/api for CircleCI Cloud, or your CircleCI Server API base URL.', 'default' => 'https://circleci.com/api'],
        ];
    }

    /**
     * Verify CircleCI credentials with a lightweight current-user lookup.
     *
     * @param  array<string, mixed>  $config  Personal API token and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $service = new CircleCIService(
                accessToken: $accessToken,
                baseUrl: (string) ($config['url'] ?? 'https://circleci.com/api'),
            );
            $result = $service->getCurrentUser();
            $login = $result['login'] ?? $result['name'] ?? 'user';

            return ['success' => true, 'message' => "Connected to CircleCI as {$login}."];
        } catch (Throwable $e) {
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
        return [
            'circleci_api_delete' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApiDelete',
                'type' => 'write',
                'name' => 'Api Delete',
                'description' => 'Call any CircleCI API DELETE endpoint path.',
                'icon' => 'ph:circle',
            ],
            'circleci_api_get' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApiGet',
                'type' => 'read',
                'name' => 'Api Get',
                'description' => 'Call any CircleCI API GET endpoint path.',
                'icon' => 'ph:circle',
            ],
            'circleci_api_patch' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApiPatch',
                'type' => 'write',
                'name' => 'Api Patch',
                'description' => 'Call any CircleCI API PATCH endpoint path.',
                'icon' => 'ph:circle',
            ],
            'circleci_api_post' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApiPost',
                'type' => 'write',
                'name' => 'Api Post',
                'description' => 'Call any CircleCI API POST endpoint path.',
                'icon' => 'ph:circle',
            ],
            'circleci_api_put' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApiPut',
                'type' => 'write',
                'name' => 'Api Put',
                'description' => 'Call any CircleCI API PUT endpoint path.',
                'icon' => 'ph:circle',
            ],
            'circleci_approve_workflow_job' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIApproveWorkflowJob',
                'type' => 'write',
                'name' => 'Approve Workflow Job',
                'description' => 'Approve a workflow approval job.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_cancel_job_by_id' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICancelJobById',
                'type' => 'write',
                'name' => 'Cancel Job By Id',
                'description' => 'Cancel a job by job ID.',
                'icon' => 'ph:briefcase',
            ],
            'circleci_cancel_job_by_number' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICancelJobByNumber',
                'type' => 'write',
                'name' => 'Cancel Job By Number',
                'description' => 'Cancel a job by project slug and job number.',
                'icon' => 'ph:briefcase',
            ],
            'circleci_cancel_workflow' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICancelWorkflow',
                'type' => 'write',
                'name' => 'Cancel Workflow',
                'description' => 'Cancel a workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_continue_pipeline' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIContinuePipeline',
                'type' => 'write',
                'name' => 'Continue Pipeline',
                'description' => 'Continue a setup workflow pipeline with generated configuration.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_create_checkout_key' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateCheckoutKey',
                'type' => 'write',
                'name' => 'Create Checkout Key',
                'description' => 'Create a checkout key for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_create_context' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateContext',
                'type' => 'write',
                'name' => 'Create Context',
                'description' => 'Create a CircleCI context.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_create_context_restriction' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateContextRestriction',
                'type' => 'write',
                'name' => 'Create Context Restriction',
                'description' => 'Create a context restriction.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_create_project_env_var' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateProjectEnvVar',
                'type' => 'write',
                'name' => 'Create Project Env Var',
                'description' => 'Create a project environment variable.',
                'icon' => 'ph:circle',
            ],
            'circleci_create_schedule' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateSchedule',
                'type' => 'write',
                'name' => 'Create Schedule',
                'description' => 'Create a schedule trigger for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_create_webhook' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCICreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create an outbound webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'circleci_delete_checkout_key' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteCheckoutKey',
                'type' => 'write',
                'name' => 'Delete Checkout Key',
                'description' => 'Delete a project checkout key.',
                'icon' => 'ph:circle',
            ],
            'circleci_delete_context' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteContext',
                'type' => 'write',
                'name' => 'Delete Context',
                'description' => 'Delete a context and its environment variables.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_delete_context_env_var' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteContextEnvVar',
                'type' => 'write',
                'name' => 'Delete Context Env Var',
                'description' => 'Delete a context environment variable.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_delete_context_restriction' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteContextRestriction',
                'type' => 'write',
                'name' => 'Delete Context Restriction',
                'description' => 'Delete a context restriction.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_delete_project' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteProject',
                'type' => 'write',
                'name' => 'Delete Project',
                'description' => 'Delete a project by project slug.',
                'icon' => 'ph:circle',
            ],
            'circleci_delete_project_env_var' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteProjectEnvVar',
                'type' => 'write',
                'name' => 'Delete Project Env Var',
                'description' => 'Delete a project environment variable.',
                'icon' => 'ph:circle',
            ],
            'circleci_delete_schedule' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteSchedule',
                'type' => 'write',
                'name' => 'Delete Schedule',
                'description' => 'Delete a schedule by ID.',
                'icon' => 'ph:circle',
            ],
            'circleci_delete_webhook' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete an outbound webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'circleci_get_checkout_key' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetCheckoutKey',
                'type' => 'read',
                'name' => 'Get Checkout Key',
                'description' => 'Get a project checkout key by fingerprint.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_context' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetContext',
                'type' => 'read',
                'name' => 'Get Context',
                'description' => 'Get a context by ID.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_get_current_user' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated CircleCI user profile.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_job_details' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetJobDetails',
                'type' => 'read',
                'name' => 'Get Job Details',
                'description' => 'Get job details by project slug and job number.',
                'icon' => 'ph:briefcase',
            ],
            'circleci_get_pipeline' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetPipeline',
                'type' => 'read',
                'name' => 'Get Pipeline',
                'description' => 'Get details for a pipeline by ID.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_get_pipeline_config' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetPipelineConfig',
                'type' => 'read',
                'name' => 'Get Pipeline Config',
                'description' => 'Get compiled configuration for a pipeline.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_get_pipeline_values' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetPipelineValues',
                'type' => 'read',
                'name' => 'Get Pipeline Values',
                'description' => 'Get pipeline parameter values for a pipeline.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_get_project' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetProject',
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get a project by project slug.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_project_env_var' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetProjectEnvVar',
                'type' => 'read',
                'name' => 'Get Project Env Var',
                'description' => 'Get a masked project environment variable.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_project_insights_summary' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetProjectInsightsSummary',
                'type' => 'read',
                'name' => 'Get Project Insights Summary',
                'description' => 'Get project summary metrics and trends.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_project_pipeline_by_number' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetProjectPipelineByNumber',
                'type' => 'read',
                'name' => 'Get Project Pipeline By Number',
                'description' => 'Get a project pipeline by pipeline number.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_get_project_settings' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetProjectSettings',
                'type' => 'read',
                'name' => 'Get Project Settings',
                'description' => 'Get project settings.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_schedule' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetSchedule',
                'type' => 'read',
                'name' => 'Get Schedule',
                'description' => 'Get a schedule by ID.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_user' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetUser',
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a CircleCI user by ID.',
                'icon' => 'ph:circle',
            ],
            'circleci_get_webhook' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetWebhook',
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get an outbound webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'circleci_get_workflow' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetWorkflow',
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Get details for a workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_get_workflow_job_timeseries' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetWorkflowJobTimeseries',
                'type' => 'read',
                'name' => 'Get Workflow Job Timeseries',
                'description' => 'Get timeseries data for a workflow job.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_get_workflow_metrics' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIGetWorkflowMetrics',
                'type' => 'read',
                'name' => 'Get Workflow Metrics',
                'description' => 'Get metrics and recent runs for a workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_list_checkout_keys' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListCheckoutKeys',
                'type' => 'read',
                'name' => 'List Checkout Keys',
                'description' => 'List checkout keys for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_collaborations' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListCollaborations',
                'type' => 'read',
                'name' => 'List Collaborations',
                'description' => 'List VCS collaborations for the authenticated user.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_context_env_vars' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListContextEnvVars',
                'type' => 'read',
                'name' => 'List Context Env Vars',
                'description' => 'List environment variables in a context without values.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_list_context_restrictions' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListContextRestrictions',
                'type' => 'read',
                'name' => 'List Context Restrictions',
                'description' => 'List context restrictions.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_list_contexts' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListContexts',
                'type' => 'read',
                'name' => 'List Contexts',
                'description' => 'List contexts for an owner.',
                'icon' => 'ph:lock-key',
            ],
            'circleci_list_flaky_tests' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListFlakyTests',
                'type' => 'read',
                'name' => 'List Flaky Tests',
                'description' => 'List flaky tests for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_insight_branches' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListInsightBranches',
                'type' => 'read',
                'name' => 'List Insight Branches',
                'description' => 'List branches with insight data for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_job_artifacts' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListJobArtifacts',
                'type' => 'read',
                'name' => 'List Job Artifacts',
                'description' => 'List artifacts for a job.',
                'icon' => 'ph:briefcase',
            ],
            'circleci_list_job_tests' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListJobTests',
                'type' => 'read',
                'name' => 'List Job Tests',
                'description' => 'List test metadata for a job.',
                'icon' => 'ph:briefcase',
            ],
            'circleci_list_pipeline_workflows' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelineWorkflows',
                'type' => 'read',
                'name' => 'List Pipeline Workflows',
                'description' => 'List workflows for a pipeline.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_list_pipelines' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelines',
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List pipelines visible to the authenticated user or organization.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_list_project_env_vars' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListProjectEnvVars',
                'type' => 'read',
                'name' => 'List Project Env Vars',
                'description' => 'List masked project environment variables.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_project_pipelines' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListProjectPipelines',
                'type' => 'read',
                'name' => 'List Project Pipelines',
                'description' => 'List pipelines for a project.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_list_projects' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListProjects',
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects for an organization.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_schedule_triggers' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListScheduleTriggers',
                'type' => 'read',
                'name' => 'List Schedule Triggers',
                'description' => 'List schedule triggers for a project.',
                'icon' => 'ph:circle',
            ],
            'circleci_list_webhooks' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List outbound webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'circleci_list_workflow_job_metrics' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListWorkflowJobMetrics',
                'type' => 'read',
                'name' => 'List Workflow Job Metrics',
                'description' => 'List job metrics for a project workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_list_workflow_jobs' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListWorkflowJobs',
                'type' => 'read',
                'name' => 'List Workflow Jobs',
                'description' => 'List jobs for a workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_list_workflow_metrics' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListWorkflowMetrics',
                'type' => 'read',
                'name' => 'List Workflow Metrics',
                'description' => 'List workflow metrics for a project.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_list_workflows' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIListWorkflows',
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List workflows for a specific pipeline.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_rerun_workflow' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIRerunWorkflow',
                'type' => 'write',
                'name' => 'Rerun Workflow',
                'description' => 'Rerun a workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_trigger_pipeline' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCITriggerPipeline',
                'type' => 'write',
                'name' => 'Trigger Pipeline',
                'description' => 'Trigger a new pipeline for a project.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_update_project_settings' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIUpdateProjectSettings',
                'type' => 'write',
                'name' => 'Update Project Settings',
                'description' => 'Update project settings.',
                'icon' => 'ph:circle',
            ],
            'circleci_update_schedule' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIUpdateSchedule',
                'type' => 'write',
                'name' => 'Update Schedule',
                'description' => 'Update a schedule by ID.',
                'icon' => 'ph:circle',
            ],
            'circleci_update_webhook' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIUpdateWebhook',
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update an outbound webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'circleci_upsert_context_env_var' => [
                'class' => 'OpenCompany\Integrations\CircleCI\Tools\CircleCIUpsertContextEnvVar',
                'type' => 'write',
                'name' => 'Upsert Context Env Var',
                'description' => 'Add or update a context environment variable.',
                'icon' => 'ph:lock-key',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/circleci.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'CircleCI API URL', 'required' => false, 'default' => 'https://circleci.com/api'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a CircleCI service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): CircleCIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CircleCIService(
                accessToken: (string) $creds->get('circleci', 'access_token', '', $account),
                baseUrl: (string) $creds->get('circleci', 'url', 'https://circleci.com/api', $account),
            );
        }

        return app(CircleCIService::class);
    }
}