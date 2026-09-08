<?php

namespace OpenCompany\Integrations\Braintrust;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreateDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreateExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreateFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreateProject;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreatePrompt;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustDeleteDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustDeleteExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustDeleteFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustDeleteProject;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustDeletePrompt;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFeedbackDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFeedbackExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFeedbackLogs;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFetchDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFetchExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustFetchLogs;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetProject;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetPrompt;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustInsertDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustInsertExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustInsertLogs;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustInvokeFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustLaunchEval;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListDatasetSnapshots;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListDatasets;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListExperiments;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListFunctions;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListGroups;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListOrganizations;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListProjectScores;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListProjectTags;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListProjects;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListPrompts;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListRoles;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListUsers;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustProxyAuto;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustProxyChatCompletions;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustProxyCompletions;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustProxyEmbeddings;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustQueryBtql;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustSummarizeDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustSummarizeExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpdateDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpdateExperiment;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpdateFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpdateProject;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpdatePrompt;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpsertFunction;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustUpsertPrompt;

/**
 * Tool catalog and configuration metadata for Braintrust.
 *
 * Exposes Braintrust project, experiment, dataset, prompt, function, logging,
 * eval, proxy, and configuration endpoints with multi-account credentials.
 */
class BraintrustToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => [],
                'notes' => ['Uses Authorization: Bearer <BRAINTRUST_API_KEY>.'],
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
        return 'braintrust';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Braintrust',
            'description' => 'LLM evals, observability, prompts, datasets, and AI proxy',
            'icon' => 'ph:brain',
            'logo' => 'ph:brain',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Braintrust',
            'description' => 'Manage Braintrust projects, experiments, datasets, prompts, functions, logs, eval launches, proxy calls, and workspace configuration.',
            'icon' => 'ph:brain',
            'logo' => 'ph:brain',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://www.braintrust.dev/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Braintrust API key', 'hint' => 'Create an API key in Braintrust organization settings.', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Data Plane URL', 'placeholder' => 'https://api.braintrust.dev', 'hint' => 'Use https://api-eu.braintrust.dev for EU data planes or a self-hosted URL.', 'default' => 'https://api.braintrust.dev'],
        ];
    }

    /**
     * Verify Braintrust credentials with a lightweight project list request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.braintrust.dev'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/project', ['limit' => 1]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Braintrust API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Braintrust at {$baseUrl}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'braintrust_list_projects' => ['class' => BraintrustListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List Braintrust projects.', 'icon' => 'ph:folders'],
            'braintrust_create_project' => ['class' => BraintrustCreateProject::class, 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create a Braintrust project.', 'icon' => 'ph:folder-plus'],
            'braintrust_get_project' => ['class' => BraintrustGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Retrieve a Braintrust project by ID.', 'icon' => 'ph:folder-open'],
            'braintrust_update_project' => ['class' => BraintrustUpdateProject::class, 'type' => 'write', 'name' => 'Update Project', 'description' => 'Patch a Braintrust project.', 'icon' => 'ph:pencil-simple'],
            'braintrust_delete_project' => ['class' => BraintrustDeleteProject::class, 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete a Braintrust project.', 'icon' => 'ph:trash'],
            'braintrust_insert_logs' => ['class' => BraintrustInsertLogs::class, 'type' => 'write', 'name' => 'Insert Logs', 'description' => 'Insert project log events.', 'icon' => 'ph:database'],
            'braintrust_fetch_logs' => ['class' => BraintrustFetchLogs::class, 'type' => 'read', 'name' => 'Fetch Logs', 'description' => 'Fetch project log events.', 'icon' => 'ph:rows'],
            'braintrust_feedback_logs' => ['class' => BraintrustFeedbackLogs::class, 'type' => 'write', 'name' => 'Feedback Logs', 'description' => 'Record feedback on project logs.', 'icon' => 'ph:chat-teardrop-text'],
            'braintrust_list_experiments' => ['class' => BraintrustListExperiments::class, 'type' => 'read', 'name' => 'List Experiments', 'description' => 'List Braintrust experiments.', 'icon' => 'ph:flask'],
            'braintrust_create_experiment' => ['class' => BraintrustCreateExperiment::class, 'type' => 'write', 'name' => 'Create Experiment', 'description' => 'Create a Braintrust experiment.', 'icon' => 'ph:plus-circle'],
            'braintrust_get_experiment' => ['class' => BraintrustGetExperiment::class, 'type' => 'read', 'name' => 'Get Experiment', 'description' => 'Retrieve a Braintrust experiment.', 'icon' => 'ph:file-search'],
            'braintrust_update_experiment' => ['class' => BraintrustUpdateExperiment::class, 'type' => 'write', 'name' => 'Update Experiment', 'description' => 'Patch a Braintrust experiment.', 'icon' => 'ph:pencil-simple'],
            'braintrust_delete_experiment' => ['class' => BraintrustDeleteExperiment::class, 'type' => 'write', 'name' => 'Delete Experiment', 'description' => 'Delete a Braintrust experiment.', 'icon' => 'ph:trash'],
            'braintrust_insert_experiment' => ['class' => BraintrustInsertExperiment::class, 'type' => 'write', 'name' => 'Insert Experiment Rows', 'description' => 'Insert events into an experiment.', 'icon' => 'ph:database'],
            'braintrust_fetch_experiment' => ['class' => BraintrustFetchExperiment::class, 'type' => 'read', 'name' => 'Fetch Experiment Rows', 'description' => 'Fetch experiment events.', 'icon' => 'ph:rows'],
            'braintrust_feedback_experiment' => ['class' => BraintrustFeedbackExperiment::class, 'type' => 'write', 'name' => 'Feedback Experiment', 'description' => 'Record feedback on experiment rows.', 'icon' => 'ph:chat-teardrop-text'],
            'braintrust_summarize_experiment' => ['class' => BraintrustSummarizeExperiment::class, 'type' => 'read', 'name' => 'Summarize Experiment', 'description' => 'Summarize experiment metrics.', 'icon' => 'ph:chart-bar'],
            'braintrust_list_datasets' => ['class' => BraintrustListDatasets::class, 'type' => 'read', 'name' => 'List Datasets', 'description' => 'List Braintrust datasets.', 'icon' => 'ph:table'],
            'braintrust_create_dataset' => ['class' => BraintrustCreateDataset::class, 'type' => 'write', 'name' => 'Create Dataset', 'description' => 'Create a Braintrust dataset.', 'icon' => 'ph:table-row-plus-after'],
            'braintrust_get_dataset' => ['class' => BraintrustGetDataset::class, 'type' => 'read', 'name' => 'Get Dataset', 'description' => 'Retrieve a Braintrust dataset.', 'icon' => 'ph:file-search'],
            'braintrust_update_dataset' => ['class' => BraintrustUpdateDataset::class, 'type' => 'write', 'name' => 'Update Dataset', 'description' => 'Patch a Braintrust dataset.', 'icon' => 'ph:pencil-simple'],
            'braintrust_delete_dataset' => ['class' => BraintrustDeleteDataset::class, 'type' => 'write', 'name' => 'Delete Dataset', 'description' => 'Delete a Braintrust dataset.', 'icon' => 'ph:trash'],
            'braintrust_insert_dataset' => ['class' => BraintrustInsertDataset::class, 'type' => 'write', 'name' => 'Insert Dataset Rows', 'description' => 'Insert records into a dataset.', 'icon' => 'ph:database'],
            'braintrust_fetch_dataset' => ['class' => BraintrustFetchDataset::class, 'type' => 'read', 'name' => 'Fetch Dataset Rows', 'description' => 'Fetch dataset records.', 'icon' => 'ph:rows'],
            'braintrust_feedback_dataset' => ['class' => BraintrustFeedbackDataset::class, 'type' => 'write', 'name' => 'Feedback Dataset', 'description' => 'Record feedback on dataset rows.', 'icon' => 'ph:chat-teardrop-text'],
            'braintrust_summarize_dataset' => ['class' => BraintrustSummarizeDataset::class, 'type' => 'read', 'name' => 'Summarize Dataset', 'description' => 'Summarize dataset contents.', 'icon' => 'ph:chart-pie'],
            'braintrust_list_prompts' => ['class' => BraintrustListPrompts::class, 'type' => 'read', 'name' => 'List Prompts', 'description' => 'List Braintrust prompts.', 'icon' => 'ph:quotes'],
            'braintrust_create_prompt' => ['class' => BraintrustCreatePrompt::class, 'type' => 'write', 'name' => 'Create Prompt', 'description' => 'Create a Braintrust prompt.', 'icon' => 'ph:plus-circle'],
            'braintrust_upsert_prompt' => ['class' => BraintrustUpsertPrompt::class, 'type' => 'write', 'name' => 'Upsert Prompt', 'description' => 'Create or update a Braintrust prompt.', 'icon' => 'ph:arrows-clockwise'],
            'braintrust_get_prompt' => ['class' => BraintrustGetPrompt::class, 'type' => 'read', 'name' => 'Get Prompt', 'description' => 'Retrieve a Braintrust prompt.', 'icon' => 'ph:file-search'],
            'braintrust_update_prompt' => ['class' => BraintrustUpdatePrompt::class, 'type' => 'write', 'name' => 'Update Prompt', 'description' => 'Patch a Braintrust prompt.', 'icon' => 'ph:pencil-simple'],
            'braintrust_delete_prompt' => ['class' => BraintrustDeletePrompt::class, 'type' => 'write', 'name' => 'Delete Prompt', 'description' => 'Delete a Braintrust prompt.', 'icon' => 'ph:trash'],
            'braintrust_list_functions' => ['class' => BraintrustListFunctions::class, 'type' => 'read', 'name' => 'List Functions', 'description' => 'List Braintrust functions, tools, and scorers.', 'icon' => 'ph:function'],
            'braintrust_create_function' => ['class' => BraintrustCreateFunction::class, 'type' => 'write', 'name' => 'Create Function', 'description' => 'Create a Braintrust function.', 'icon' => 'ph:plus-circle'],
            'braintrust_upsert_function' => ['class' => BraintrustUpsertFunction::class, 'type' => 'write', 'name' => 'Upsert Function', 'description' => 'Create or update a Braintrust function.', 'icon' => 'ph:arrows-clockwise'],
            'braintrust_get_function' => ['class' => BraintrustGetFunction::class, 'type' => 'read', 'name' => 'Get Function', 'description' => 'Retrieve a Braintrust function.', 'icon' => 'ph:file-search'],
            'braintrust_update_function' => ['class' => BraintrustUpdateFunction::class, 'type' => 'write', 'name' => 'Update Function', 'description' => 'Patch a Braintrust function.', 'icon' => 'ph:pencil-simple'],
            'braintrust_delete_function' => ['class' => BraintrustDeleteFunction::class, 'type' => 'write', 'name' => 'Delete Function', 'description' => 'Delete a Braintrust function.', 'icon' => 'ph:trash'],
            'braintrust_invoke_function' => ['class' => BraintrustInvokeFunction::class, 'type' => 'write', 'name' => 'Invoke Function', 'description' => 'Invoke a Braintrust prompt, tool, or scorer.', 'icon' => 'ph:play'],
            'braintrust_query_btql' => ['class' => BraintrustQueryBtql::class, 'type' => 'read', 'name' => 'Query BTQL', 'description' => 'Query logs, experiments, and datasets with Braintrust SQL.', 'icon' => 'ph:terminal-window'],
            'braintrust_launch_eval' => ['class' => BraintrustLaunchEval::class, 'type' => 'write', 'name' => 'Launch Eval', 'description' => 'Launch a Braintrust eval run.', 'icon' => 'ph:rocket-launch'],
            'braintrust_proxy_chat_completions' => ['class' => BraintrustProxyChatCompletions::class, 'type' => 'write', 'name' => 'Proxy Chat Completions', 'description' => 'Call Braintrust AI proxy chat completions.', 'icon' => 'ph:chat-circle-text'],
            'braintrust_proxy_completions' => ['class' => BraintrustProxyCompletions::class, 'type' => 'write', 'name' => 'Proxy Completions', 'description' => 'Call Braintrust AI proxy completions.', 'icon' => 'ph:text-aa'],
            'braintrust_proxy_embeddings' => ['class' => BraintrustProxyEmbeddings::class, 'type' => 'write', 'name' => 'Proxy Embeddings', 'description' => 'Call Braintrust AI proxy embeddings.', 'icon' => 'ph:circles-three-plus'],
            'braintrust_proxy_auto' => ['class' => BraintrustProxyAuto::class, 'type' => 'write', 'name' => 'Proxy Auto', 'description' => 'Call the Braintrust proxy auto endpoint.', 'icon' => 'ph:magic-wand'],
            'braintrust_list_project_scores' => ['class' => BraintrustListProjectScores::class, 'type' => 'read', 'name' => 'List Project Scores', 'description' => 'List project score definitions.', 'icon' => 'ph:star'],
            'braintrust_list_project_tags' => ['class' => BraintrustListProjectTags::class, 'type' => 'read', 'name' => 'List Project Tags', 'description' => 'List project tags.', 'icon' => 'ph:tag'],
            'braintrust_list_dataset_snapshots' => ['class' => BraintrustListDatasetSnapshots::class, 'type' => 'read', 'name' => 'List Dataset Snapshots', 'description' => 'List dataset snapshots.', 'icon' => 'ph:camera'],
            'braintrust_list_groups' => ['class' => BraintrustListGroups::class, 'type' => 'read', 'name' => 'List Groups', 'description' => 'List Braintrust groups.', 'icon' => 'ph:users-three'],
            'braintrust_list_roles' => ['class' => BraintrustListRoles::class, 'type' => 'read', 'name' => 'List Roles', 'description' => 'List Braintrust roles.', 'icon' => 'ph:key'],
            'braintrust_list_users' => ['class' => BraintrustListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List Braintrust users.', 'icon' => 'ph:user-list'],
            'braintrust_list_organizations' => ['class' => BraintrustListOrganizations::class, 'type' => 'read', 'name' => 'List Organizations', 'description' => 'List Braintrust organizations.', 'icon' => 'ph:buildings'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/braintrust.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Data Plane URL', 'required' => false, 'default' => 'https://api.braintrust.dev'],
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
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): BraintrustService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BraintrustService(
                apiKey: $creds->get('braintrust', 'api_key', '', $account),
                baseUrl: $creds->get('braintrust', 'base_url', 'https://api.braintrust.dev', $account),
            );
        }

        return app(BraintrustService::class);
    }
}
