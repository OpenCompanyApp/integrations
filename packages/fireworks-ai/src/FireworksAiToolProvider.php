<?php

namespace OpenCompany\Integrations\FireworksAi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiAnthropicMessages;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCancelReinforcementFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateApiKey;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateBatchInferenceJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateDataset;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateDeployedModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateDpoJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateEvaluationJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateEvaluator;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateReinforcementFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateReinforcementFineTuningStep;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateSecret;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateSupervisedFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateUser;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreatesAnEmbeddingVectorRepresentingTheInputText;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteApiKey;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteBatchInferenceJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteDataset;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteDeployedModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteDpoJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteEvaluationJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteEvaluator;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteReinforcementFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteReinforcementFineTuningStep;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteResponse;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteSecret;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiDeleteSupervisedFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiExecuteReinforcementFineTuningStep;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGenerateANewImageFromATextPrompt;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGenerateOrEditImageUsingFluxKontext;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetAccount;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetBatchInferenceJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDataset;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDatasetDownloadEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDatasetUploadEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDeployedModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDeploymentShape;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDeploymentShapeVersion;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDpoJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetDpoJobMetricsFileEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluationJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluationJobLogEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluator;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluatorBuildLogEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluatorSourceCodeEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetEvaluatorUploadEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetGeneratedImageFromFluxKontex;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetModelDownloadEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetModelUploadEndpoint;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetQuota;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetReinforcementFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetReinforcementFineTuningStep;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetResponse;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetSecret;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetSupervisedFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetUser;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListAccounts;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListApiKeys;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListBatchInferenceJobs;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListDatasets;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListDeployedModels;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListDeploymentShapeVersions;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListDeployments;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListDpoJobs;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListEvaluationJobs;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListEvaluators;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListModels;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListQuotas;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListReinforcementFineTuningJobs;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListReinforcementFineTuningSteps;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListResponses;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListSecrets;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListSupervisedFineTuningJobs;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiListUsers;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiPostChatcompletions;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiPostCompletions;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiPostResponses;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiPrepareModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiRerankDocuments;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiResumeDpoJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiResumeReinforcementFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiResumeReinforcementFineTuningStep;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiResumeSupervisedFineTuningJob;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiScaleDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUndeleteDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateDataset;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateDeployedModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateDeployment;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateEvaluator;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateQuota;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateSecret;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUpdateUser;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiUploadDatasetFiles;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiValidateDatasetUpload;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiValidateEvaluatorUpload;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiValidateModelUpload;

/**
 * Tool catalog and configuration metadata for Fireworks AI.
 *
 * Exposes Fireworks inference, responses, datasets, models, deployments,
 * LoRAs, fine-tuning, batch, evaluation, accounts, users, quotas, and secrets.
 */
class FireworksAiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses Authorization: Bearer <FIREWORKS_API_KEY>.'],
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
        return 'fireworks-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Fireworks AI',
            'description' => 'Fast open-model inference, deployments, fine-tuning, batch jobs, evals, and account APIs',
            'icon' => 'ph:fire',
            'logo' => 'simple-icons:fireworks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Fireworks AI',
            'description' => 'Call Fireworks AI inference endpoints and manage accounts, datasets, models, deployments, LoRAs, fine-tuning jobs, batch inference, evaluations, users, API keys, quotas, and secrets.',
            'icon' => 'ph:fire',
            'logo' => 'simple-icons:fireworks',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.fireworks.ai/api-reference/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Fireworks API key', 'hint' => 'Create an API key in Fireworks.', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.fireworks.ai', 'hint' => 'Use the default Fireworks API URL unless you have a compatible gateway.', 'default' => 'https://api.fireworks.ai'],
        ];
    }

    /**
     * Verify Fireworks credentials with a lightweight account list request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.fireworks.ai'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withToken($apiKey)->timeout(10)->get($baseUrl . '/v1/accounts');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Fireworks AI API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Fireworks AI at {$baseUrl}."];
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
            'fireworks_ai_anthropic_messages' => FireworksAiAnthropicMessages::class,
            'fireworks_ai_cancel_reinforcement_fine_tuning_job' => FireworksAiCancelReinforcementFineTuningJob::class,
            'fireworks_ai_create_api_key' => FireworksAiCreateApiKey::class,
            'fireworks_ai_create_batch_inference_job' => FireworksAiCreateBatchInferenceJob::class,
            'fireworks_ai_create_dataset' => FireworksAiCreateDataset::class,
            'fireworks_ai_create_deployed_model' => FireworksAiCreateDeployedModel::class,
            'fireworks_ai_create_deployment' => FireworksAiCreateDeployment::class,
            'fireworks_ai_create_dpo_job' => FireworksAiCreateDpoJob::class,
            'fireworks_ai_create_evaluation_job' => FireworksAiCreateEvaluationJob::class,
            'fireworks_ai_create_evaluator' => FireworksAiCreateEvaluator::class,
            'fireworks_ai_create_model' => FireworksAiCreateModel::class,
            'fireworks_ai_create_reinforcement_fine_tuning_job' => FireworksAiCreateReinforcementFineTuningJob::class,
            'fireworks_ai_create_reinforcement_fine_tuning_step' => FireworksAiCreateReinforcementFineTuningStep::class,
            'fireworks_ai_create_secret' => FireworksAiCreateSecret::class,
            'fireworks_ai_create_supervised_fine_tuning_job' => FireworksAiCreateSupervisedFineTuningJob::class,
            'fireworks_ai_create_user' => FireworksAiCreateUser::class,
            'fireworks_ai_create_embeddings' => FireworksAiCreatesAnEmbeddingVectorRepresentingTheInputText::class,
            'fireworks_ai_delete_api_key' => FireworksAiDeleteApiKey::class,
            'fireworks_ai_delete_batch_inference_job' => FireworksAiDeleteBatchInferenceJob::class,
            'fireworks_ai_delete_dataset' => FireworksAiDeleteDataset::class,
            'fireworks_ai_delete_deployed_model' => FireworksAiDeleteDeployedModel::class,
            'fireworks_ai_delete_deployment' => FireworksAiDeleteDeployment::class,
            'fireworks_ai_delete_dpo_job' => FireworksAiDeleteDpoJob::class,
            'fireworks_ai_delete_evaluation_job' => FireworksAiDeleteEvaluationJob::class,
            'fireworks_ai_delete_evaluator' => FireworksAiDeleteEvaluator::class,
            'fireworks_ai_delete_model' => FireworksAiDeleteModel::class,
            'fireworks_ai_delete_reinforcement_fine_tuning_job' => FireworksAiDeleteReinforcementFineTuningJob::class,
            'fireworks_ai_delete_reinforcement_fine_tuning_step' => FireworksAiDeleteReinforcementFineTuningStep::class,
            'fireworks_ai_delete_response' => FireworksAiDeleteResponse::class,
            'fireworks_ai_delete_secret' => FireworksAiDeleteSecret::class,
            'fireworks_ai_delete_supervised_fine_tuning_job' => FireworksAiDeleteSupervisedFineTuningJob::class,
            'fireworks_ai_execute_reinforcement_fine_tuning_step' => FireworksAiExecuteReinforcementFineTuningStep::class,
            'fireworks_ai_generate_a_new_image_from_a_text_prompt' => FireworksAiGenerateANewImageFromATextPrompt::class,
            'fireworks_ai_generate_or_edit_image_using_flux_kontext' => FireworksAiGenerateOrEditImageUsingFluxKontext::class,
            'fireworks_ai_get_account' => FireworksAiGetAccount::class,
            'fireworks_ai_get_batch_inference_job' => FireworksAiGetBatchInferenceJob::class,
            'fireworks_ai_get_dataset' => FireworksAiGetDataset::class,
            'fireworks_ai_get_dataset_download_endpoint' => FireworksAiGetDatasetDownloadEndpoint::class,
            'fireworks_ai_get_dataset_upload_endpoint' => FireworksAiGetDatasetUploadEndpoint::class,
            'fireworks_ai_get_deployed_model' => FireworksAiGetDeployedModel::class,
            'fireworks_ai_get_deployment' => FireworksAiGetDeployment::class,
            'fireworks_ai_get_deployment_shape' => FireworksAiGetDeploymentShape::class,
            'fireworks_ai_get_deployment_shape_version' => FireworksAiGetDeploymentShapeVersion::class,
            'fireworks_ai_get_dpo_job' => FireworksAiGetDpoJob::class,
            'fireworks_ai_get_dpo_job_metrics_file_endpoint' => FireworksAiGetDpoJobMetricsFileEndpoint::class,
            'fireworks_ai_get_evaluation_job' => FireworksAiGetEvaluationJob::class,
            'fireworks_ai_get_evaluation_job_log_endpoint' => FireworksAiGetEvaluationJobLogEndpoint::class,
            'fireworks_ai_get_evaluator' => FireworksAiGetEvaluator::class,
            'fireworks_ai_get_evaluator_build_log_endpoint' => FireworksAiGetEvaluatorBuildLogEndpoint::class,
            'fireworks_ai_get_evaluator_source_code_endpoint' => FireworksAiGetEvaluatorSourceCodeEndpoint::class,
            'fireworks_ai_get_evaluator_upload_endpoint' => FireworksAiGetEvaluatorUploadEndpoint::class,
            'fireworks_ai_get_generated_image_from_flux_kontex' => FireworksAiGetGeneratedImageFromFluxKontex::class,
            'fireworks_ai_get_model' => FireworksAiGetModel::class,
            'fireworks_ai_get_model_download_endpoint' => FireworksAiGetModelDownloadEndpoint::class,
            'fireworks_ai_get_model_upload_endpoint' => FireworksAiGetModelUploadEndpoint::class,
            'fireworks_ai_get_quota' => FireworksAiGetQuota::class,
            'fireworks_ai_get_reinforcement_fine_tuning_job' => FireworksAiGetReinforcementFineTuningJob::class,
            'fireworks_ai_get_reinforcement_fine_tuning_step' => FireworksAiGetReinforcementFineTuningStep::class,
            'fireworks_ai_get_response' => FireworksAiGetResponse::class,
            'fireworks_ai_get_secret' => FireworksAiGetSecret::class,
            'fireworks_ai_get_supervised_fine_tuning_job' => FireworksAiGetSupervisedFineTuningJob::class,
            'fireworks_ai_get_user' => FireworksAiGetUser::class,
            'fireworks_ai_list_accounts' => FireworksAiListAccounts::class,
            'fireworks_ai_list_api_keys' => FireworksAiListApiKeys::class,
            'fireworks_ai_list_batch_inference_jobs' => FireworksAiListBatchInferenceJobs::class,
            'fireworks_ai_list_datasets' => FireworksAiListDatasets::class,
            'fireworks_ai_list_deployed_models' => FireworksAiListDeployedModels::class,
            'fireworks_ai_list_deployment_shape_versions' => FireworksAiListDeploymentShapeVersions::class,
            'fireworks_ai_list_deployments' => FireworksAiListDeployments::class,
            'fireworks_ai_list_dpo_jobs' => FireworksAiListDpoJobs::class,
            'fireworks_ai_list_evaluation_jobs' => FireworksAiListEvaluationJobs::class,
            'fireworks_ai_list_evaluators' => FireworksAiListEvaluators::class,
            'fireworks_ai_list_models' => FireworksAiListModels::class,
            'fireworks_ai_list_quotas' => FireworksAiListQuotas::class,
            'fireworks_ai_list_reinforcement_fine_tuning_jobs' => FireworksAiListReinforcementFineTuningJobs::class,
            'fireworks_ai_list_reinforcement_fine_tuning_steps' => FireworksAiListReinforcementFineTuningSteps::class,
            'fireworks_ai_list_responses' => FireworksAiListResponses::class,
            'fireworks_ai_list_secrets' => FireworksAiListSecrets::class,
            'fireworks_ai_list_supervised_fine_tuning_jobs' => FireworksAiListSupervisedFineTuningJobs::class,
            'fireworks_ai_list_users' => FireworksAiListUsers::class,
            'fireworks_ai_chat_completions' => FireworksAiPostChatcompletions::class,
            'fireworks_ai_completions' => FireworksAiPostCompletions::class,
            'fireworks_ai_create_response' => FireworksAiPostResponses::class,
            'fireworks_ai_prepare_model' => FireworksAiPrepareModel::class,
            'fireworks_ai_rerank_documents' => FireworksAiRerankDocuments::class,
            'fireworks_ai_resume_dpo_job' => FireworksAiResumeDpoJob::class,
            'fireworks_ai_resume_reinforcement_fine_tuning_job' => FireworksAiResumeReinforcementFineTuningJob::class,
            'fireworks_ai_resume_reinforcement_fine_tuning_step' => FireworksAiResumeReinforcementFineTuningStep::class,
            'fireworks_ai_resume_supervised_fine_tuning_job' => FireworksAiResumeSupervisedFineTuningJob::class,
            'fireworks_ai_scale_deployment' => FireworksAiScaleDeployment::class,
            'fireworks_ai_undelete_deployment' => FireworksAiUndeleteDeployment::class,
            'fireworks_ai_update_dataset' => FireworksAiUpdateDataset::class,
            'fireworks_ai_update_deployed_model' => FireworksAiUpdateDeployedModel::class,
            'fireworks_ai_update_deployment' => FireworksAiUpdateDeployment::class,
            'fireworks_ai_update_evaluator' => FireworksAiUpdateEvaluator::class,
            'fireworks_ai_update_model' => FireworksAiUpdateModel::class,
            'fireworks_ai_update_quota' => FireworksAiUpdateQuota::class,
            'fireworks_ai_update_secret' => FireworksAiUpdateSecret::class,
            'fireworks_ai_update_user' => FireworksAiUpdateUser::class,
            'fireworks_ai_upload_dataset_files' => FireworksAiUploadDatasetFiles::class,
            'fireworks_ai_validate_dataset_upload' => FireworksAiValidateDatasetUpload::class,
            'fireworks_ai_validate_evaluator_upload' => FireworksAiValidateEvaluatorUpload::class,
            'fireworks_ai_validate_model_upload' => FireworksAiValidateModelUpload::class,
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fireworks-ai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.fireworks.ai'],
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
    private function resolveService(array $context = []): FireworksAiService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FireworksAiService(
                apiKey: $creds->get('fireworks-ai', 'api_key', '', $account),
                baseUrl: $creds->get('fireworks-ai', 'base_url', 'https://api.fireworks.ai', $account),
            );
        }

        return app(FireworksAiService::class);
    }
}