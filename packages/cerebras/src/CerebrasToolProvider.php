<?php

namespace OpenCompany\Integrations\Cerebras;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasCancelBatch;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasChatCompletions;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasCompletions;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasCreateBatch;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasDeleteFile;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasDeleteModelVersion;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasDeployModelToEndpoint;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListBatches;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListEndpoints;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListFiles;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListModelArchitectures;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListModelVersions;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListModels;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasListPublicModels;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveBatch;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveEndpointStatus;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveFile;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveFileContent;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveMetrics;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveModel;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveModelVersionStatus;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrievePublicModel;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasUpdateModelVersionAliases;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasUploadFile;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasUploadModelVersion;

/**
 * Tool catalog and configuration metadata for Cerebras.
 *
 * Exposes Cerebras inference, model, batch, file, metrics, and dedicated
 * endpoint management APIs with multi-account credentials.
 */
class CerebrasToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses Authorization: Bearer <CEREBRAS_API_KEY>.'],
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
        return 'cerebras';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Cerebras',
            'description' => 'Ultra-fast inference, batches, files, metrics, models, and dedicated endpoint management',
            'icon' => 'ph:cpu',
            'logo' => 'ph:cpu',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cerebras',
            'description' => 'Call Cerebras chat and completion endpoints and manage models, public model metadata, batches, files, metrics, custom model versions, and dedicated endpoints.',
            'icon' => 'ph:cpu',
            'logo' => 'ph:cpu',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://inference-docs.cerebras.ai/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Cerebras API key', 'hint' => 'Create an API key in Cerebras Cloud.', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.cerebras.ai', 'hint' => 'Use the default Cerebras API URL unless you have a compatible gateway.', 'default' => 'https://api.cerebras.ai'],
        ];
    }

    /**
     * Verify Cerebras credentials with a lightweight model list request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.cerebras.ai'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withToken($apiKey)->timeout(10)->get($baseUrl . '/v1/models');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Cerebras API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Cerebras at {$baseUrl}."];
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
            'cerebras_cancel_batch' => CerebrasCancelBatch::class,
            'cerebras_chat_completions' => CerebrasChatCompletions::class,
            'cerebras_completions' => CerebrasCompletions::class,
            'cerebras_create_batch' => CerebrasCreateBatch::class,
            'cerebras_delete_file' => CerebrasDeleteFile::class,
            'cerebras_delete_model_version' => CerebrasDeleteModelVersion::class,
            'cerebras_deploy_model_to_endpoint' => CerebrasDeployModelToEndpoint::class,
            'cerebras_list_batches' => CerebrasListBatches::class,
            'cerebras_list_endpoints' => CerebrasListEndpoints::class,
            'cerebras_list_files' => CerebrasListFiles::class,
            'cerebras_list_model_architectures' => CerebrasListModelArchitectures::class,
            'cerebras_list_model_versions' => CerebrasListModelVersions::class,
            'cerebras_list_models' => CerebrasListModels::class,
            'cerebras_list_public_models' => CerebrasListPublicModels::class,
            'cerebras_retrieve_batch' => CerebrasRetrieveBatch::class,
            'cerebras_retrieve_endpoint_status' => CerebrasRetrieveEndpointStatus::class,
            'cerebras_retrieve_file' => CerebrasRetrieveFile::class,
            'cerebras_retrieve_file_content' => CerebrasRetrieveFileContent::class,
            'cerebras_retrieve_metrics' => CerebrasRetrieveMetrics::class,
            'cerebras_retrieve_model' => CerebrasRetrieveModel::class,
            'cerebras_retrieve_model_version_status' => CerebrasRetrieveModelVersionStatus::class,
            'cerebras_retrieve_public_model' => CerebrasRetrievePublicModel::class,
            'cerebras_update_model_version_aliases' => CerebrasUpdateModelVersionAliases::class,
            'cerebras_upload_file' => CerebrasUploadFile::class,
            'cerebras_upload_model_version' => CerebrasUploadModelVersion::class,
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/cerebras.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cerebras.ai'],
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
    private function resolveService(array $context = []): CerebrasService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CerebrasService(
                apiKey: $creds->get('cerebras', 'api_key', '', $account),
                baseUrl: $creds->get('cerebras', 'base_url', 'https://api.cerebras.ai', $account),
            );
        }

        return app(CerebrasService::class);
    }
}