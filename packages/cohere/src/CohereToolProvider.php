<?php

namespace OpenCompany\Integrations\Cohere;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cohere\Tools\CohereCancelEmbedJob;
use OpenCompany\Integrations\Cohere\Tools\CohereChat;
use OpenCompany\Integrations\Cohere\Tools\CohereClassify;
use OpenCompany\Integrations\Cohere\Tools\CohereCreateAudioTranscription;
use OpenCompany\Integrations\Cohere\Tools\CohereCreateDataset;
use OpenCompany\Integrations\Cohere\Tools\CohereCreateEmbedJob;
use OpenCompany\Integrations\Cohere\Tools\CohereDeleteDataset;
use OpenCompany\Integrations\Cohere\Tools\CohereDetokenize;
use OpenCompany\Integrations\Cohere\Tools\CohereEmbed;
use OpenCompany\Integrations\Cohere\Tools\CohereGetDataset;
use OpenCompany\Integrations\Cohere\Tools\CohereGetDatasetUsage;
use OpenCompany\Integrations\Cohere\Tools\CohereGetEmbedJob;
use OpenCompany\Integrations\Cohere\Tools\CohereGetModel;
use OpenCompany\Integrations\Cohere\Tools\CohereListDatasets;
use OpenCompany\Integrations\Cohere\Tools\CohereListEmbedJobs;
use OpenCompany\Integrations\Cohere\Tools\CohereListModels;
use OpenCompany\Integrations\Cohere\Tools\CohereRerank;
use OpenCompany\Integrations\Cohere\Tools\CohereTokenize;

/**
 * Tool catalog and configuration metadata for Cohere.
 *
 * Exposes Cohere's v2 generation, embedding, reranking, audio transcription,
 * and v1 management endpoints with account-specific credential resolution.
 */
class CohereToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [],
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
        return 'cohere';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Cohere',
            'description' => 'LLMs, embeddings, reranking, datasets, and audio transcription',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:cohere',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cohere',
            'description' => 'Cohere chat, embeddings, reranking, tokenization, models, embed jobs, datasets, audio transcription, and legacy classify.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:cohere',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.cohere.com/reference/about',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Cohere API key',
                'hint' => 'Create an API key in the Cohere dashboard.',
                'required' => true,
            ],
            [
                'key' => 'client_name',
                'type' => 'text',
                'label' => 'Client Name',
                'placeholder' => 'Optional X-Client-Name value',
                'hint' => 'Optional. Sent as X-Client-Name for Cohere project attribution.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cohere.com',
                'hint' => 'Use https://api.cohere.com unless Cohere provides a dedicated endpoint.',
                'default' => 'https://api.cohere.com',
            ],
        ];
    }

    /**
     * Verify Cohere credentials with the lightweight models endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.cohere.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        $headers = [
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ];

        if (!empty($config['client_name'])) {
            $headers['X-Client-Name'] = (string) $config['client_name'];
        }

        try {
            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/v1/models', [
                'page_size' => 1,
            ]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Cohere API returned HTTP ' . $response->status() . '.',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Cohere API at {$baseUrl}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'client_name' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'cohere_chat' => [
                'class' => CohereChat::class,
                'type' => 'read',
                'name' => 'Chat',
                'description' => 'Generate a response with Cohere v2 Chat. Non-streaming JSON responses only.',
                'icon' => 'ph:chat-circle-text',
            ],
            'cohere_embed' => [
                'class' => CohereEmbed::class,
                'type' => 'read',
                'name' => 'Embed',
                'description' => 'Create Cohere v2 text, image, or mixed embeddings.',
                'icon' => 'ph:brackets-angle',
            ],
            'cohere_rerank' => [
                'class' => CohereRerank::class,
                'type' => 'read',
                'name' => 'Rerank',
                'description' => 'Rerank documents for a query using Cohere v2 Rerank.',
                'icon' => 'ph:sort-descending',
            ],
            'cohere_tokenize' => [
                'class' => CohereTokenize::class,
                'type' => 'read',
                'name' => 'Tokenize',
                'description' => 'Split text into Cohere model tokens.',
                'icon' => 'ph:list-numbers',
            ],
            'cohere_detokenize' => [
                'class' => CohereDetokenize::class,
                'type' => 'read',
                'name' => 'Detokenize',
                'description' => 'Convert Cohere model tokens back to text.',
                'icon' => 'ph:text-aa',
            ],
            'cohere_list_models' => [
                'class' => CohereListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List Cohere models with optional endpoint/default filtering.',
                'icon' => 'ph:list',
            ],
            'cohere_get_model' => [
                'class' => CohereGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Retrieve Cohere model metadata.',
                'icon' => 'ph:info',
            ],
            'cohere_create_embed_job' => [
                'class' => CohereCreateEmbedJob::class,
                'type' => 'write',
                'name' => 'Create Embed Job',
                'description' => 'Start an asynchronous Cohere embed job for an embed-input dataset.',
                'icon' => 'ph:play-circle',
            ],
            'cohere_list_embed_jobs' => [
                'class' => CohereListEmbedJobs::class,
                'type' => 'read',
                'name' => 'List Embed Jobs',
                'description' => 'List Cohere embed jobs.',
                'icon' => 'ph:list-checks',
            ],
            'cohere_get_embed_job' => [
                'class' => CohereGetEmbedJob::class,
                'type' => 'read',
                'name' => 'Get Embed Job',
                'description' => 'Retrieve a Cohere embed job by ID.',
                'icon' => 'ph:clipboard-text',
            ],
            'cohere_cancel_embed_job' => [
                'class' => CohereCancelEmbedJob::class,
                'type' => 'write',
                'name' => 'Cancel Embed Job',
                'description' => 'Cancel an active Cohere embed job.',
                'icon' => 'ph:x-circle',
            ],
            'cohere_create_dataset' => [
                'class' => CohereCreateDataset::class,
                'type' => 'write',
                'name' => 'Create Dataset',
                'description' => 'Upload a dataset file for Cohere dataset-backed workflows.',
                'icon' => 'ph:upload',
            ],
            'cohere_list_datasets' => [
                'class' => CohereListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'List Cohere datasets with optional filters.',
                'icon' => 'ph:database',
            ],
            'cohere_get_dataset' => [
                'class' => CohereGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Retrieve one Cohere dataset by ID.',
                'icon' => 'ph:database',
            ],
            'cohere_delete_dataset' => [
                'class' => CohereDeleteDataset::class,
                'type' => 'write',
                'name' => 'Delete Dataset',
                'description' => 'Delete a Cohere dataset by ID.',
                'icon' => 'ph:trash',
            ],
            'cohere_get_dataset_usage' => [
                'class' => CohereGetDatasetUsage::class,
                'type' => 'read',
                'name' => 'Get Dataset Usage',
                'description' => 'Get organization dataset storage usage.',
                'icon' => 'ph:gauge',
            ],
            'cohere_create_audio_transcription' => [
                'class' => CohereCreateAudioTranscription::class,
                'type' => 'read',
                'name' => 'Create Audio Transcription',
                'description' => 'Transcribe an audio file with Cohere v2 Audio Transcriptions.',
                'icon' => 'ph:waveform',
            ],
            'cohere_classify' => [
                'class' => CohereClassify::class,
                'type' => 'read',
                'name' => 'Classify',
                'description' => 'Classify text with Cohere v1 Classify. This upstream endpoint is deprecated.',
                'icon' => 'ph:tag',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cohere.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'client_name', 'type' => 'text', 'label' => 'Client Name', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cohere.com'],
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
    private function resolveService(array $context = []): CohereService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CohereService(
                apiKey: $creds->get('cohere', 'api_key', '', $account),
                baseUrl: $creds->get('cohere', 'url', 'https://api.cohere.com', $account),
                clientName: $creds->get('cohere', 'client_name', '', $account),
            );
        }

        return app(CohereService::class);
    }
}
