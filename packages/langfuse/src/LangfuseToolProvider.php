<?php

namespace OpenCompany\Integrations\Langfuse;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateComment;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateDataset;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateDatasetItem;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateDatasetRunItem;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateModel;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreatePrompt;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateScore;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseDeleteDatasetItem;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseDeleteModel;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseDeletePrompt;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseDeleteScore;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseDeleteTrace;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetComment;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetDataset;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetDatasetItem;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetHealth;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetModel;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetObservation;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetPrompt;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetScore;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetSession;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetTrace;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseIngestBatch;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListComments;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListDatasetItems;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListDatasetRunItems;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListDatasets;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListModels;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListObservations;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListPrompts;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListScores;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListSessions;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListTraces;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseMetrics;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseUpdatePromptVersion;

/**
 * Tool catalog and configuration metadata for Langfuse.
 *
 * Exposes high-value Langfuse Public API project operations and resolves
 * account-specific project API credentials for multi-account host environments.
 */
class LangfuseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses HTTP Basic Auth with public key as username and secret key as password.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
        return 'langfuse';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Langfuse',
            'description' => 'LLM observability, prompts, datasets, scores, and metrics',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:langfuse',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Langfuse',
            'description' => 'LLM observability platform for traces, observations, sessions, scores, prompts, datasets, metrics, comments, and model definitions.',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:langfuse',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://langfuse.com/docs/api-and-data-platform/features/public-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'public_key',
                'type' => 'text',
                'label' => 'Public Key',
                'placeholder' => 'pk-lf-...',
                'hint' => 'Langfuse project public key. Used as Basic Auth username.',
                'required' => true,
            ],
            [
                'key' => 'secret_key',
                'type' => 'secret',
                'label' => 'Secret Key',
                'placeholder' => 'sk-lf-...',
                'hint' => 'Langfuse project secret key. Used as Basic Auth password.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://cloud.langfuse.com',
                'hint' => 'Use a Langfuse host URL or full /api/public URL. EU cloud default is https://cloud.langfuse.com.',
                'default' => 'https://cloud.langfuse.com',
            ],
        ];
    }

    /**
     * Verify Langfuse credentials with the public health endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $publicKey = (string) ($config['public_key'] ?? '');
        $secretKey = (string) ($config['secret_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://cloud.langfuse.com'), '/');

        if ($publicKey === '' || $secretKey === '') {
            return ['success' => false, 'error' => 'Public key and secret key are required.'];
        }

        if (!str_ends_with($baseUrl, '/api/public')) {
            $baseUrl .= '/api/public';
        }

        try {
            $response = Http::withBasicAuth($publicKey, $secretKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/health');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Langfuse API returned HTTP ' . $response->status() . '.',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Langfuse API at {$baseUrl}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'public_key' => 'nullable|string',
            'secret_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'langfuse_get_health' => ['class' => LangfuseGetHealth::class, 'type' => 'read', 'name' => 'Get Health', 'description' => 'Check Langfuse Public API health.', 'icon' => 'ph:heartbeat'],
            'langfuse_ingest_batch' => ['class' => LangfuseIngestBatch::class, 'type' => 'write', 'name' => 'Ingest Batch', 'description' => 'Submit Langfuse ingestion batch events.', 'icon' => 'ph:upload'],
            'langfuse_list_traces' => ['class' => LangfuseListTraces::class, 'type' => 'read', 'name' => 'List Traces', 'description' => 'List Langfuse traces with filters and pagination.', 'icon' => 'ph:list'],
            'langfuse_get_trace' => ['class' => LangfuseGetTrace::class, 'type' => 'read', 'name' => 'Get Trace', 'description' => 'Retrieve a Langfuse trace by ID.', 'icon' => 'ph:git-branch'],
            'langfuse_delete_trace' => ['class' => LangfuseDeleteTrace::class, 'type' => 'write', 'name' => 'Delete Trace', 'description' => 'Delete a Langfuse trace by ID.', 'icon' => 'ph:trash'],
            'langfuse_list_observations' => ['class' => LangfuseListObservations::class, 'type' => 'read', 'name' => 'List Observations', 'description' => 'List Langfuse observations with v2 filters.', 'icon' => 'ph:binoculars'],
            'langfuse_get_observation' => ['class' => LangfuseGetObservation::class, 'type' => 'read', 'name' => 'Get Observation', 'description' => 'Retrieve a Langfuse observation by ID.', 'icon' => 'ph:eye'],
            'langfuse_create_score' => ['class' => LangfuseCreateScore::class, 'type' => 'write', 'name' => 'Create Score', 'description' => 'Create a trace, observation, session, or dataset score.', 'icon' => 'ph:star'],
            'langfuse_list_scores' => ['class' => LangfuseListScores::class, 'type' => 'read', 'name' => 'List Scores', 'description' => 'List Langfuse v2 scores with filters.', 'icon' => 'ph:list-star'],
            'langfuse_get_score' => ['class' => LangfuseGetScore::class, 'type' => 'read', 'name' => 'Get Score', 'description' => 'Retrieve a Langfuse score by ID.', 'icon' => 'ph:star-half'],
            'langfuse_delete_score' => ['class' => LangfuseDeleteScore::class, 'type' => 'write', 'name' => 'Delete Score', 'description' => 'Delete a Langfuse score by ID.', 'icon' => 'ph:trash'],
            'langfuse_list_sessions' => ['class' => LangfuseListSessions::class, 'type' => 'read', 'name' => 'List Sessions', 'description' => 'List Langfuse sessions.', 'icon' => 'ph:chats'],
            'langfuse_get_session' => ['class' => LangfuseGetSession::class, 'type' => 'read', 'name' => 'Get Session', 'description' => 'Retrieve a Langfuse session by ID.', 'icon' => 'ph:chat-circle'],
            'langfuse_list_datasets' => ['class' => LangfuseListDatasets::class, 'type' => 'read', 'name' => 'List Datasets', 'description' => 'List Langfuse v2 datasets.', 'icon' => 'ph:database'],
            'langfuse_create_dataset' => ['class' => LangfuseCreateDataset::class, 'type' => 'write', 'name' => 'Create Dataset', 'description' => 'Create a Langfuse v2 dataset.', 'icon' => 'ph:database'],
            'langfuse_get_dataset' => ['class' => LangfuseGetDataset::class, 'type' => 'read', 'name' => 'Get Dataset', 'description' => 'Retrieve a Langfuse dataset by name.', 'icon' => 'ph:database'],
            'langfuse_create_dataset_item' => ['class' => LangfuseCreateDatasetItem::class, 'type' => 'write', 'name' => 'Create Dataset Item', 'description' => 'Create a Langfuse dataset item.', 'icon' => 'ph:plus'],
            'langfuse_list_dataset_items' => ['class' => LangfuseListDatasetItems::class, 'type' => 'read', 'name' => 'List Dataset Items', 'description' => 'List Langfuse dataset items.', 'icon' => 'ph:list'],
            'langfuse_get_dataset_item' => ['class' => LangfuseGetDatasetItem::class, 'type' => 'read', 'name' => 'Get Dataset Item', 'description' => 'Retrieve a Langfuse dataset item by ID.', 'icon' => 'ph:file'],
            'langfuse_delete_dataset_item' => ['class' => LangfuseDeleteDatasetItem::class, 'type' => 'write', 'name' => 'Delete Dataset Item', 'description' => 'Delete a Langfuse dataset item by ID.', 'icon' => 'ph:trash'],
            'langfuse_create_dataset_run_item' => ['class' => LangfuseCreateDatasetRunItem::class, 'type' => 'write', 'name' => 'Create Dataset Run Item', 'description' => 'Create a Langfuse dataset run item.', 'icon' => 'ph:play-circle'],
            'langfuse_list_dataset_run_items' => ['class' => LangfuseListDatasetRunItems::class, 'type' => 'read', 'name' => 'List Dataset Run Items', 'description' => 'List Langfuse dataset run items.', 'icon' => 'ph:list-checks'],
            'langfuse_list_prompts' => ['class' => LangfuseListPrompts::class, 'type' => 'read', 'name' => 'List Prompts', 'description' => 'List Langfuse v2 prompts.', 'icon' => 'ph:cards'],
            'langfuse_create_prompt' => ['class' => LangfuseCreatePrompt::class, 'type' => 'write', 'name' => 'Create Prompt', 'description' => 'Create a Langfuse prompt version.', 'icon' => 'ph:plus-circle'],
            'langfuse_get_prompt' => ['class' => LangfuseGetPrompt::class, 'type' => 'read', 'name' => 'Get Prompt', 'description' => 'Retrieve a Langfuse prompt by name.', 'icon' => 'ph:cardholder'],
            'langfuse_delete_prompt' => ['class' => LangfuseDeletePrompt::class, 'type' => 'write', 'name' => 'Delete Prompt', 'description' => 'Delete a Langfuse prompt by name.', 'icon' => 'ph:trash'],
            'langfuse_update_prompt_version' => ['class' => LangfuseUpdatePromptVersion::class, 'type' => 'write', 'name' => 'Update Prompt Version', 'description' => 'Update labels or config for a prompt version.', 'icon' => 'ph:pencil'],
            'langfuse_create_comment' => ['class' => LangfuseCreateComment::class, 'type' => 'write', 'name' => 'Create Comment', 'description' => 'Create a Langfuse comment.', 'icon' => 'ph:chat-text'],
            'langfuse_list_comments' => ['class' => LangfuseListComments::class, 'type' => 'read', 'name' => 'List Comments', 'description' => 'List Langfuse comments.', 'icon' => 'ph:chats'],
            'langfuse_get_comment' => ['class' => LangfuseGetComment::class, 'type' => 'read', 'name' => 'Get Comment', 'description' => 'Retrieve a Langfuse comment by ID.', 'icon' => 'ph:chat-circle-text'],
            'langfuse_metrics' => ['class' => LangfuseMetrics::class, 'type' => 'read', 'name' => 'Metrics', 'description' => 'Query Langfuse v2 metrics.', 'icon' => 'ph:chart-bar'],
            'langfuse_list_models' => ['class' => LangfuseListModels::class, 'type' => 'read', 'name' => 'List Models', 'description' => 'List Langfuse model definitions.', 'icon' => 'ph:list'],
            'langfuse_create_model' => ['class' => LangfuseCreateModel::class, 'type' => 'write', 'name' => 'Create Model', 'description' => 'Create a Langfuse model definition.', 'icon' => 'ph:brain'],
            'langfuse_get_model' => ['class' => LangfuseGetModel::class, 'type' => 'read', 'name' => 'Get Model', 'description' => 'Retrieve a Langfuse model definition by ID.', 'icon' => 'ph:info'],
            'langfuse_delete_model' => ['class' => LangfuseDeleteModel::class, 'type' => 'write', 'name' => 'Delete Model', 'description' => 'Delete a Langfuse model definition by ID.', 'icon' => 'ph:trash'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/langfuse.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'public_key', 'type' => 'text', 'label' => 'Public Key', 'required' => true],
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://cloud.langfuse.com'],
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
    private function resolveService(array $context = []): LangfuseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LangfuseService(
                publicKey: $creds->get('langfuse', 'public_key', '', $account),
                secretKey: $creds->get('langfuse', 'secret_key', '', $account),
                baseUrl: $creds->get('langfuse', 'url', 'https://cloud.langfuse.com', $account),
            );
        }

        return app(LangfuseService::class);
    }
}
