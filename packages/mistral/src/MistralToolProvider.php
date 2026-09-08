<?php

namespace OpenCompany\Integrations\Mistral;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mistral\Tools\MistralAgentsCompletions;
use OpenCompany\Integrations\Mistral\Tools\MistralAppendConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralArchiveFineTunedModel;
use OpenCompany\Integrations\Mistral\Tools\MistralArchiveWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralBatchCancelWorkflowExecutions;
use OpenCompany\Integrations\Mistral\Tools\MistralBatchTerminateWorkflowExecutions;
use OpenCompany\Integrations\Mistral\Tools\MistralBulkDeleteObservabilityDatasetRecords;
use OpenCompany\Integrations\Mistral\Tools\MistralCancelBatchJob;
use OpenCompany\Integrations\Mistral\Tools\MistralCancelFineTuningJob;
use OpenCompany\Integrations\Mistral\Tools\MistralCancelWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralChatClassifications;
use OpenCompany\Integrations\Mistral\Tools\MistralChatCompletions;
use OpenCompany\Integrations\Mistral\Tools\MistralChatModerations;
use OpenCompany\Integrations\Mistral\Tools\MistralClassifications;
use OpenCompany\Integrations\Mistral\Tools\MistralConversationHistory;
use OpenCompany\Integrations\Mistral\Tools\MistralConversationMessages;
use OpenCompany\Integrations\Mistral\Tools\MistralCountChatCompletionFieldOptions;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateAgent;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateBatchJob;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateCampaign;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateFineTuningJob;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateJudge;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateLibrary;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateLibraryShare;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateObservabilityDataset;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateObservabilityDatasetRecord;
use OpenCompany\Integrations\Mistral\Tools\MistralCreateVoice;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteAgent;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteAgentAlias;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteCampaign;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteFile;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteJudge;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteLibrary;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteLibraryDocument;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteLibraryShare;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteModel;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteObservabilityDataset;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteObservabilityDatasetRecord;
use OpenCompany\Integrations\Mistral\Tools\MistralDeleteVoice;
use OpenCompany\Integrations\Mistral\Tools\MistralDownloadFile;
use OpenCompany\Integrations\Mistral\Tools\MistralEmbeddings;
use OpenCompany\Integrations\Mistral\Tools\MistralExecuteWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralExecuteWorkflowRegistration;
use OpenCompany\Integrations\Mistral\Tools\MistralExportObservabilityDatasetJsonl;
use OpenCompany\Integrations\Mistral\Tools\MistralFimCompletions;
use OpenCompany\Integrations\Mistral\Tools\MistralGetAgent;
use OpenCompany\Integrations\Mistral\Tools\MistralGetAgentVersion;
use OpenCompany\Integrations\Mistral\Tools\MistralGetBatchJob;
use OpenCompany\Integrations\Mistral\Tools\MistralGetCampaign;
use OpenCompany\Integrations\Mistral\Tools\MistralGetCampaignSelectedEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralGetCampaignStatus;
use OpenCompany\Integrations\Mistral\Tools\MistralGetChatCompletionEvent;
use OpenCompany\Integrations\Mistral\Tools\MistralGetChatCompletionFieldOptions;
use OpenCompany\Integrations\Mistral\Tools\MistralGetConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralGetFileUrl;
use OpenCompany\Integrations\Mistral\Tools\MistralGetFineTuningJob;
use OpenCompany\Integrations\Mistral\Tools\MistralGetJudge;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibrary;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibraryDocument;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibraryDocumentExtractedTextUrl;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibraryDocumentSignedUrl;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibraryDocumentStatus;
use OpenCompany\Integrations\Mistral\Tools\MistralGetLibraryDocumentText;
use OpenCompany\Integrations\Mistral\Tools\MistralGetObservabilityDataset;
use OpenCompany\Integrations\Mistral\Tools\MistralGetObservabilityDatasetRecord;
use OpenCompany\Integrations\Mistral\Tools\MistralGetObservabilityDatasetTask;
use OpenCompany\Integrations\Mistral\Tools\MistralGetSimilarChatCompletionEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralGetVoice;
use OpenCompany\Integrations\Mistral\Tools\MistralGetVoiceSample;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowDeployment;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowExecutionHistory;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowExecutionTraceEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowExecutionTraceOtel;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowExecutionTraceSummary;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowMetrics;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowRegistration;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowRun;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowRunHistory;
use OpenCompany\Integrations\Mistral\Tools\MistralGetWorkflowWorkerInfo;
use OpenCompany\Integrations\Mistral\Tools\MistralImportObservabilityDatasetFromCampaign;
use OpenCompany\Integrations\Mistral\Tools\MistralImportObservabilityDatasetFromDataset;
use OpenCompany\Integrations\Mistral\Tools\MistralImportObservabilityDatasetFromExplorer;
use OpenCompany\Integrations\Mistral\Tools\MistralImportObservabilityDatasetFromFile;
use OpenCompany\Integrations\Mistral\Tools\MistralImportObservabilityDatasetFromPlayground;
use OpenCompany\Integrations\Mistral\Tools\MistralJudgeChatCompletionEvent;
use OpenCompany\Integrations\Mistral\Tools\MistralJudgeConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralJudgeObservabilityDatasetRecord;
use OpenCompany\Integrations\Mistral\Tools\MistralListAgentAliases;
use OpenCompany\Integrations\Mistral\Tools\MistralListAgentVersions;
use OpenCompany\Integrations\Mistral\Tools\MistralListAgents;
use OpenCompany\Integrations\Mistral\Tools\MistralListBatchJobs;
use OpenCompany\Integrations\Mistral\Tools\MistralListCampaigns;
use OpenCompany\Integrations\Mistral\Tools\MistralListChatCompletionFields;
use OpenCompany\Integrations\Mistral\Tools\MistralListConversations;
use OpenCompany\Integrations\Mistral\Tools\MistralListFiles;
use OpenCompany\Integrations\Mistral\Tools\MistralListFineTuningJobs;
use OpenCompany\Integrations\Mistral\Tools\MistralListJudges;
use OpenCompany\Integrations\Mistral\Tools\MistralListLibraries;
use OpenCompany\Integrations\Mistral\Tools\MistralListLibraryDocuments;
use OpenCompany\Integrations\Mistral\Tools\MistralListLibraryShares;
use OpenCompany\Integrations\Mistral\Tools\MistralListModels;
use OpenCompany\Integrations\Mistral\Tools\MistralListObservabilityDatasetRecords;
use OpenCompany\Integrations\Mistral\Tools\MistralListObservabilityDatasetTasks;
use OpenCompany\Integrations\Mistral\Tools\MistralListObservabilityDatasets;
use OpenCompany\Integrations\Mistral\Tools\MistralListVoices;
use OpenCompany\Integrations\Mistral\Tools\MistralListWorkflowDeployments;
use OpenCompany\Integrations\Mistral\Tools\MistralListWorkflowEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralListWorkflowRegistrations;
use OpenCompany\Integrations\Mistral\Tools\MistralListWorkflowRuns;
use OpenCompany\Integrations\Mistral\Tools\MistralListWorkflowSchedules;
use OpenCompany\Integrations\Mistral\Tools\MistralModerations;
use OpenCompany\Integrations\Mistral\Tools\MistralOcr;
use OpenCompany\Integrations\Mistral\Tools\MistralQueryWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralReprocessLibraryDocument;
use OpenCompany\Integrations\Mistral\Tools\MistralResetWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralRestartConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralRetrieveFile;
use OpenCompany\Integrations\Mistral\Tools\MistralRetrieveModel;
use OpenCompany\Integrations\Mistral\Tools\MistralScheduleWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralSearchChatCompletionEventIds;
use OpenCompany\Integrations\Mistral\Tools\MistralSearchChatCompletionEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralSignalWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralSpeech;
use OpenCompany\Integrations\Mistral\Tools\MistralStartConversation;
use OpenCompany\Integrations\Mistral\Tools\MistralStartFineTuningJob;
use OpenCompany\Integrations\Mistral\Tools\MistralStreamWorkflowEvents;
use OpenCompany\Integrations\Mistral\Tools\MistralStreamWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralTerminateWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralTranscribeAudio;
use OpenCompany\Integrations\Mistral\Tools\MistralUnarchiveFineTunedModel;
use OpenCompany\Integrations\Mistral\Tools\MistralUnarchiveWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralUnscheduleWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateAgent;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateAgentVersion;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateFineTunedModel;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateJudge;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateLibrary;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateLibraryDocument;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateObservabilityDataset;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateObservabilityDatasetRecordPayload;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateObservabilityDatasetRecordProperties;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateVoice;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateWorkflow;
use OpenCompany\Integrations\Mistral\Tools\MistralUpdateWorkflowExecution;
use OpenCompany\Integrations\Mistral\Tools\MistralUploadFile;
use OpenCompany\Integrations\Mistral\Tools\MistralUploadLibraryDocument;
use OpenCompany\Integrations\Mistral\Tools\MistralUpsertAgentAlias;

/**
 * Tool catalog and configuration metadata for Mistral AI.
 *
 * Exposes Mistral models, inference, agents, conversations, files,
 * fine-tuning, batch, audio, libraries, observability, and workflow APIs.
 */
class MistralToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses Authorization: Bearer <MISTRAL_API_KEY>.'],
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
        return 'mistral';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mistral AI',
            'description' => 'Mistral models, agents, OCR, files, batch, audio, libraries, observability, and workflows',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:mistralai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mistral AI',
            'description' => 'Call Mistral models and manage agents, conversations, files, fine-tuning jobs, batch jobs, audio voices, OCR, document libraries, observability datasets, judges, campaigns, and workflows.',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:mistralai',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.mistral.ai/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Mistral API key', 'hint' => 'Create an API key in the Mistral console.', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.mistral.ai', 'hint' => 'Use the default Mistral API URL unless you have a compatible gateway.', 'default' => 'https://api.mistral.ai'],
        ];
    }

    /**
     * Verify Mistral credentials with a lightweight model list request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? $config['url'] ?? 'https://api.mistral.ai'), '/');

        if (str_ends_with($baseUrl, '/v1')) {
            $baseUrl = substr($baseUrl, 0, -3);
        }

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withToken($apiKey)->timeout(10)->get($baseUrl . '/v1/models');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Mistral API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Mistral AI at {$baseUrl}."];
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
            'mistral_agents_completions' => MistralAgentsCompletions::class,
            'mistral_append_conversation' => MistralAppendConversation::class,
            'mistral_archive_fine_tuned_model' => MistralArchiveFineTunedModel::class,
            'mistral_archive_workflow' => MistralArchiveWorkflow::class,
            'mistral_batch_cancel_workflow_executions' => MistralBatchCancelWorkflowExecutions::class,
            'mistral_batch_terminate_workflow_executions' => MistralBatchTerminateWorkflowExecutions::class,
            'mistral_bulk_delete_observability_dataset_records' => MistralBulkDeleteObservabilityDatasetRecords::class,
            'mistral_cancel_batch_job' => MistralCancelBatchJob::class,
            'mistral_cancel_fine_tuning_job' => MistralCancelFineTuningJob::class,
            'mistral_cancel_workflow_execution' => MistralCancelWorkflowExecution::class,
            'mistral_chat_classifications' => MistralChatClassifications::class,
            'mistral_chat_completions' => MistralChatCompletions::class,
            'mistral_chat_moderations' => MistralChatModerations::class,
            'mistral_classifications' => MistralClassifications::class,
            'mistral_conversation_history' => MistralConversationHistory::class,
            'mistral_conversation_messages' => MistralConversationMessages::class,
            'mistral_count_chat_completion_field_options' => MistralCountChatCompletionFieldOptions::class,
            'mistral_create_agent' => MistralCreateAgent::class,
            'mistral_create_batch_job' => MistralCreateBatchJob::class,
            'mistral_create_campaign' => MistralCreateCampaign::class,
            'mistral_create_fine_tuning_job' => MistralCreateFineTuningJob::class,
            'mistral_create_judge' => MistralCreateJudge::class,
            'mistral_create_library' => MistralCreateLibrary::class,
            'mistral_create_library_share' => MistralCreateLibraryShare::class,
            'mistral_create_observability_dataset' => MistralCreateObservabilityDataset::class,
            'mistral_create_observability_dataset_record' => MistralCreateObservabilityDatasetRecord::class,
            'mistral_create_voice' => MistralCreateVoice::class,
            'mistral_delete_agent' => MistralDeleteAgent::class,
            'mistral_delete_agent_alias' => MistralDeleteAgentAlias::class,
            'mistral_delete_campaign' => MistralDeleteCampaign::class,
            'mistral_delete_conversation' => MistralDeleteConversation::class,
            'mistral_delete_file' => MistralDeleteFile::class,
            'mistral_delete_judge' => MistralDeleteJudge::class,
            'mistral_delete_library' => MistralDeleteLibrary::class,
            'mistral_delete_library_document' => MistralDeleteLibraryDocument::class,
            'mistral_delete_library_share' => MistralDeleteLibraryShare::class,
            'mistral_delete_model' => MistralDeleteModel::class,
            'mistral_delete_observability_dataset' => MistralDeleteObservabilityDataset::class,
            'mistral_delete_observability_dataset_record' => MistralDeleteObservabilityDatasetRecord::class,
            'mistral_delete_voice' => MistralDeleteVoice::class,
            'mistral_download_file' => MistralDownloadFile::class,
            'mistral_embeddings' => MistralEmbeddings::class,
            'mistral_execute_workflow' => MistralExecuteWorkflow::class,
            'mistral_execute_workflow_registration' => MistralExecuteWorkflowRegistration::class,
            'mistral_export_observability_dataset_jsonl' => MistralExportObservabilityDatasetJsonl::class,
            'mistral_fim_completions' => MistralFimCompletions::class,
            'mistral_get_agent' => MistralGetAgent::class,
            'mistral_get_agent_version' => MistralGetAgentVersion::class,
            'mistral_get_batch_job' => MistralGetBatchJob::class,
            'mistral_get_campaign' => MistralGetCampaign::class,
            'mistral_get_campaign_selected_events' => MistralGetCampaignSelectedEvents::class,
            'mistral_get_campaign_status' => MistralGetCampaignStatus::class,
            'mistral_get_chat_completion_event' => MistralGetChatCompletionEvent::class,
            'mistral_get_chat_completion_field_options' => MistralGetChatCompletionFieldOptions::class,
            'mistral_get_conversation' => MistralGetConversation::class,
            'mistral_get_file_url' => MistralGetFileUrl::class,
            'mistral_get_fine_tuning_job' => MistralGetFineTuningJob::class,
            'mistral_get_judge' => MistralGetJudge::class,
            'mistral_get_library' => MistralGetLibrary::class,
            'mistral_get_library_document' => MistralGetLibraryDocument::class,
            'mistral_get_library_document_extracted_text_url' => MistralGetLibraryDocumentExtractedTextUrl::class,
            'mistral_get_library_document_signed_url' => MistralGetLibraryDocumentSignedUrl::class,
            'mistral_get_library_document_status' => MistralGetLibraryDocumentStatus::class,
            'mistral_get_library_document_text' => MistralGetLibraryDocumentText::class,
            'mistral_get_observability_dataset' => MistralGetObservabilityDataset::class,
            'mistral_get_observability_dataset_record' => MistralGetObservabilityDatasetRecord::class,
            'mistral_get_observability_dataset_task' => MistralGetObservabilityDatasetTask::class,
            'mistral_get_similar_chat_completion_events' => MistralGetSimilarChatCompletionEvents::class,
            'mistral_get_voice' => MistralGetVoice::class,
            'mistral_get_voice_sample' => MistralGetVoiceSample::class,
            'mistral_get_workflow' => MistralGetWorkflow::class,
            'mistral_get_workflow_deployment' => MistralGetWorkflowDeployment::class,
            'mistral_get_workflow_execution' => MistralGetWorkflowExecution::class,
            'mistral_get_workflow_execution_history' => MistralGetWorkflowExecutionHistory::class,
            'mistral_get_workflow_execution_trace_events' => MistralGetWorkflowExecutionTraceEvents::class,
            'mistral_get_workflow_execution_trace_otel' => MistralGetWorkflowExecutionTraceOtel::class,
            'mistral_get_workflow_execution_trace_summary' => MistralGetWorkflowExecutionTraceSummary::class,
            'mistral_get_workflow_metrics' => MistralGetWorkflowMetrics::class,
            'mistral_get_workflow_registration' => MistralGetWorkflowRegistration::class,
            'mistral_get_workflow_run' => MistralGetWorkflowRun::class,
            'mistral_get_workflow_run_history' => MistralGetWorkflowRunHistory::class,
            'mistral_get_workflow_worker_info' => MistralGetWorkflowWorkerInfo::class,
            'mistral_import_observability_dataset_from_campaign' => MistralImportObservabilityDatasetFromCampaign::class,
            'mistral_import_observability_dataset_from_dataset' => MistralImportObservabilityDatasetFromDataset::class,
            'mistral_import_observability_dataset_from_explorer' => MistralImportObservabilityDatasetFromExplorer::class,
            'mistral_import_observability_dataset_from_file' => MistralImportObservabilityDatasetFromFile::class,
            'mistral_import_observability_dataset_from_playground' => MistralImportObservabilityDatasetFromPlayground::class,
            'mistral_judge_chat_completion_event' => MistralJudgeChatCompletionEvent::class,
            'mistral_judge_conversation' => MistralJudgeConversation::class,
            'mistral_judge_observability_dataset_record' => MistralJudgeObservabilityDatasetRecord::class,
            'mistral_list_agent_aliases' => MistralListAgentAliases::class,
            'mistral_list_agent_versions' => MistralListAgentVersions::class,
            'mistral_list_agents' => MistralListAgents::class,
            'mistral_list_batch_jobs' => MistralListBatchJobs::class,
            'mistral_list_campaigns' => MistralListCampaigns::class,
            'mistral_list_chat_completion_fields' => MistralListChatCompletionFields::class,
            'mistral_list_conversations' => MistralListConversations::class,
            'mistral_list_files' => MistralListFiles::class,
            'mistral_list_fine_tuning_jobs' => MistralListFineTuningJobs::class,
            'mistral_list_judges' => MistralListJudges::class,
            'mistral_list_libraries' => MistralListLibraries::class,
            'mistral_list_library_documents' => MistralListLibraryDocuments::class,
            'mistral_list_library_shares' => MistralListLibraryShares::class,
            'mistral_list_models' => MistralListModels::class,
            'mistral_list_observability_dataset_records' => MistralListObservabilityDatasetRecords::class,
            'mistral_list_observability_dataset_tasks' => MistralListObservabilityDatasetTasks::class,
            'mistral_list_observability_datasets' => MistralListObservabilityDatasets::class,
            'mistral_list_voices' => MistralListVoices::class,
            'mistral_list_workflow_deployments' => MistralListWorkflowDeployments::class,
            'mistral_list_workflow_events' => MistralListWorkflowEvents::class,
            'mistral_list_workflow_registrations' => MistralListWorkflowRegistrations::class,
            'mistral_list_workflow_runs' => MistralListWorkflowRuns::class,
            'mistral_list_workflow_schedules' => MistralListWorkflowSchedules::class,
            'mistral_moderations' => MistralModerations::class,
            'mistral_ocr' => MistralOcr::class,
            'mistral_query_workflow_execution' => MistralQueryWorkflowExecution::class,
            'mistral_reprocess_library_document' => MistralReprocessLibraryDocument::class,
            'mistral_reset_workflow_execution' => MistralResetWorkflowExecution::class,
            'mistral_restart_conversation' => MistralRestartConversation::class,
            'mistral_retrieve_file' => MistralRetrieveFile::class,
            'mistral_retrieve_model' => MistralRetrieveModel::class,
            'mistral_schedule_workflow' => MistralScheduleWorkflow::class,
            'mistral_search_chat_completion_event_ids' => MistralSearchChatCompletionEventIds::class,
            'mistral_search_chat_completion_events' => MistralSearchChatCompletionEvents::class,
            'mistral_signal_workflow_execution' => MistralSignalWorkflowExecution::class,
            'mistral_speech' => MistralSpeech::class,
            'mistral_start_conversation' => MistralStartConversation::class,
            'mistral_start_fine_tuning_job' => MistralStartFineTuningJob::class,
            'mistral_stream_workflow_events' => MistralStreamWorkflowEvents::class,
            'mistral_stream_workflow_execution' => MistralStreamWorkflowExecution::class,
            'mistral_terminate_workflow_execution' => MistralTerminateWorkflowExecution::class,
            'mistral_transcribe_audio' => MistralTranscribeAudio::class,
            'mistral_unarchive_fine_tuned_model' => MistralUnarchiveFineTunedModel::class,
            'mistral_unarchive_workflow' => MistralUnarchiveWorkflow::class,
            'mistral_unschedule_workflow' => MistralUnscheduleWorkflow::class,
            'mistral_update_agent' => MistralUpdateAgent::class,
            'mistral_update_agent_version' => MistralUpdateAgentVersion::class,
            'mistral_update_fine_tuned_model' => MistralUpdateFineTunedModel::class,
            'mistral_update_judge' => MistralUpdateJudge::class,
            'mistral_update_library' => MistralUpdateLibrary::class,
            'mistral_update_library_document' => MistralUpdateLibraryDocument::class,
            'mistral_update_observability_dataset' => MistralUpdateObservabilityDataset::class,
            'mistral_update_observability_dataset_record_payload' => MistralUpdateObservabilityDatasetRecordPayload::class,
            'mistral_update_observability_dataset_record_properties' => MistralUpdateObservabilityDatasetRecordProperties::class,
            'mistral_update_voice' => MistralUpdateVoice::class,
            'mistral_update_workflow' => MistralUpdateWorkflow::class,
            'mistral_update_workflow_execution' => MistralUpdateWorkflowExecution::class,
            'mistral_upload_file' => MistralUploadFile::class,
            'mistral_upload_library_document' => MistralUploadLibraryDocument::class,
            'mistral_upsert_agent_alias' => MistralUpsertAgentAlias::class,
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/mistral.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.mistral.ai'],
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
    private function resolveService(array $context = []): MistralService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $apiKey = (string) $creds->get('mistral', 'api_key', '', $account);
            $baseUrl = (string) $creds->get('mistral', 'base_url', '', $account);

            if ($apiKey === '') {
                $apiKey = (string) $creds->get('mistralai', 'api_key', '', $account);
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('mistralai', 'url', 'https://api.mistral.ai', $account);
            }

            return new MistralService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );
        }

        return app(MistralService::class);
    }
}
