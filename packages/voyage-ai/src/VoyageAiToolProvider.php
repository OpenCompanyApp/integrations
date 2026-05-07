<?php

namespace OpenCompany\Integrations\VoyageAi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiBulkDeleteFiles;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCancelBatch;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateBatch;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateContextualizedEmbeddings;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateEmbedding;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateMultimodalEmbeddings;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiDeleteFile;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiListBatches;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiListFiles;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiRetrieveBatch;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiRetrieveFile;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiRetrieveFileContent;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiRerank;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiUploadFile;

/**
 * Tool catalog and configuration metadata for Voyage AI.
 *
 * Exposes the official inference, files, and batch APIs while resolving
 * account-specific API keys in multi-account host environments.
 */
class VoyageAiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'voyage-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Voyage AI',
            'description' => 'Embeddings, reranking, files, and batch inference',
            'icon' => 'ph:vector-three',
            'logo' => 'ph:vector-three',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Voyage AI',
            'description' => 'Embedding, reranking, multimodal embedding, contextualized embedding, file storage, and batch inference APIs for retrieval workflows.',
            'icon' => 'ph:vector-three',
            'logo' => 'ph:vector-three',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.voyageai.com/reference/embeddings-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Voyage AI API key',
                'hint' => 'Create an API key in the Voyage AI dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.voyageai.com/v1',
                'hint' => 'Use the default Voyage AI API URL unless Voyage provides a dedicated endpoint.',
                'default' => 'https://api.voyageai.com/v1',
            ],
        ];
    }

    /**
     * Verify Voyage AI credentials with a low-cost list files request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.voyageai.com/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/files', ['limit' => 1]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Voyage AI API returned HTTP ' . $response->status() . '.',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Voyage AI API at {$baseUrl}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'voyage_ai_create_embedding' => ['class' => VoyageAiCreateEmbedding::class, 'type' => 'read', 'name' => 'Create Embedding', 'description' => 'Create text embeddings with Voyage AI models.', 'icon' => 'ph:vector-three'],
            'voyage_ai_create_contextualized_embeddings' => ['class' => VoyageAiCreateContextualizedEmbeddings::class, 'type' => 'read', 'name' => 'Create Contextualized Embeddings', 'description' => 'Create contextualized chunk embeddings for document chunks or queries.', 'icon' => 'ph:brackets-curly'],
            'voyage_ai_create_multimodal_embeddings' => ['class' => VoyageAiCreateMultimodalEmbeddings::class, 'type' => 'read', 'name' => 'Create Multimodal Embeddings', 'description' => 'Create embeddings from interleaved text, image, or video inputs.', 'icon' => 'ph:image-square'],
            'voyage_ai_rerank' => ['class' => VoyageAiRerank::class, 'type' => 'read', 'name' => 'Rerank', 'description' => 'Rerank documents for a query with Voyage AI rerankers.', 'icon' => 'ph:sort-descending'],
            'voyage_ai_upload_file' => ['class' => VoyageAiUploadFile::class, 'type' => 'write', 'name' => 'Upload File', 'description' => 'Upload a JSONL file for Voyage AI Batch API processing.', 'icon' => 'ph:upload'],
            'voyage_ai_list_files' => ['class' => VoyageAiListFiles::class, 'type' => 'read', 'name' => 'List Files', 'description' => 'List files uploaded to Voyage AI.', 'icon' => 'ph:files'],
            'voyage_ai_retrieve_file' => ['class' => VoyageAiRetrieveFile::class, 'type' => 'read', 'name' => 'Retrieve File', 'description' => 'Retrieve Voyage AI file metadata.', 'icon' => 'ph:file'],
            'voyage_ai_retrieve_file_content' => ['class' => VoyageAiRetrieveFileContent::class, 'type' => 'read', 'name' => 'Retrieve File Content', 'description' => 'Download content for a Voyage AI file.', 'icon' => 'ph:file-text'],
            'voyage_ai_delete_file' => ['class' => VoyageAiDeleteFile::class, 'type' => 'write', 'name' => 'Delete File', 'description' => 'Delete a Voyage AI file.', 'icon' => 'ph:trash'],
            'voyage_ai_bulk_delete_files' => ['class' => VoyageAiBulkDeleteFiles::class, 'type' => 'write', 'name' => 'Bulk Delete Files', 'description' => 'Delete multiple Voyage AI files atomically.', 'icon' => 'ph:trash'],
            'voyage_ai_create_batch' => ['class' => VoyageAiCreateBatch::class, 'type' => 'write', 'name' => 'Create Batch', 'description' => 'Create and execute a Voyage AI batch inference job.', 'icon' => 'ph:stack'],
            'voyage_ai_list_batches' => ['class' => VoyageAiListBatches::class, 'type' => 'read', 'name' => 'List Batches', 'description' => 'List Voyage AI batch jobs.', 'icon' => 'ph:list'],
            'voyage_ai_retrieve_batch' => ['class' => VoyageAiRetrieveBatch::class, 'type' => 'read', 'name' => 'Retrieve Batch', 'description' => 'Retrieve a Voyage AI batch job.', 'icon' => 'ph:stack'],
            'voyage_ai_cancel_batch' => ['class' => VoyageAiCancelBatch::class, 'type' => 'write', 'name' => 'Cancel Batch', 'description' => 'Cancel a validating or in-progress Voyage AI batch job.', 'icon' => 'ph:x-circle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/voyage-ai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.voyageai.com/v1'],
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
    private function resolveService(array $context = []): VoyageAiService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new VoyageAiService(
                apiKey: $creds->get('voyage-ai', 'api_key', '', $account),
                baseUrl: $creds->get('voyage-ai', 'url', 'https://api.voyageai.com/v1', $account),
            );
        }

        return app(VoyageAiService::class);
    }
}
