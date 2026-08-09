<?php

namespace OpenCompany\Integrations\HuggingFace;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceApiDelete;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceApiGet;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceApiPost;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceApiPut;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceCreateRepo;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetCurrentUser;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetDataset;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetModel;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetScanStatus;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetSpace;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceInference;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListDatasets;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListDatasetTags;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListCommits;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListModelTags;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListModels;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListRefs;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListSpaceHardware;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListSpaces;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListTree;

/**
 * Tool catalog and setup metadata for the Hugging Face integration.
 *
 * Exposes Hub discovery, repository utilities, and serverless inference tools.
 */
class HuggingFaceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
        return 'hugging-face';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Hugging Face',
            'description' => 'Model hub and inference',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:huggingface',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hugging Face',
            'description' => 'AI model hub, datasets, Spaces, and serverless inference',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:huggingface',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://huggingface.co/docs/hub/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'hf_xxxxxxxxxxxxxxxxxxxxxxxxxx',
                'hint' => 'Generate a User Access Token in your Hugging Face account settings under "Access Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://huggingface.co/api',
                'hint' => 'Use <code>https://huggingface.co/api</code> for the public hub, or your Enterprise hub URL',
                'default' => 'https://huggingface.co/api',
            ],
            [
                'key' => 'inference_url',
                'type' => 'url',
                'label' => 'Inference Base URL',
                'placeholder' => 'https://router.huggingface.co/hf-inference/models',
                'hint' => 'Serverless Inference API model router base URL',
                'default' => 'https://router.huggingface.co/hf-inference/models',
            ],
        ];
    }

    /**
     * Verify that the configured token can access the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Setup form configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://huggingface.co/api', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/whoami-v2');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Hugging Face API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $name = $json['fullname'] ?? $json['name'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Hugging Face API as {$name}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
            'inference_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'huggingface_list_models' => [
                'class' => HuggingFaceListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'Search and list AI models on Hugging Face Hub.',
                'icon' => 'ph:magnifying-glass',
            ],
            'huggingface_get_model' => [
                'class' => HuggingFaceGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get detailed information about a specific model.',
                'icon' => 'ph:cube',
            ],
            'huggingface_list_datasets' => [
                'class' => HuggingFaceListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'Search and list datasets on Hugging Face Hub.',
                'icon' => 'ph:database',
            ],
            'huggingface_get_dataset' => [
                'class' => HuggingFaceGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Get detailed information about a specific dataset.',
                'icon' => 'ph:database',
            ],
            'huggingface_inference' => [
                'class' => HuggingFaceInference::class,
                'type' => 'write',
                'name' => 'Run Inference',
                'description' => 'Run inference on a model via the Hugging Face Inference API.',
                'icon' => 'ph:play',
            ],
            'huggingface_list_spaces' => [
                'class' => HuggingFaceListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'Search and list Spaces on Hugging Face Hub.',
                'icon' => 'ph:app-window',
            ],
            'huggingface_get_space' => [
                'class' => HuggingFaceGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get detailed information about a specific Space.',
                'icon' => 'ph:app-window',
            ],
            'huggingface_get_current_user' => [
                'class' => HuggingFaceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user-circle',
            ],
            'huggingface_list_commits' => [
                'class' => HuggingFaceListCommits::class,
                'type' => 'read',
                'name' => 'List Commits',
                'description' => 'List commits for a model, dataset, or Space repository.',
                'icon' => 'ph:git-commit',
            ],
            'huggingface_list_refs' => [
                'class' => HuggingFaceListRefs::class,
                'type' => 'read',
                'name' => 'List Refs',
                'description' => 'List branches and tags for a Hub repository.',
                'icon' => 'ph:git-branch',
            ],
            'huggingface_list_tree' => [
                'class' => HuggingFaceListTree::class,
                'type' => 'read',
                'name' => 'List Tree',
                'description' => 'List files and folders in a model, dataset, or Space repository.',
                'icon' => 'ph:tree-structure',
            ],
            'huggingface_get_scan_status' => [
                'class' => HuggingFaceGetScanStatus::class,
                'type' => 'read',
                'name' => 'Get Scan Status',
                'description' => 'Get repository security scan status from the Hub.',
                'icon' => 'ph:shield-check',
            ],
            'huggingface_list_model_tags' => [
                'class' => HuggingFaceListModelTags::class,
                'type' => 'read',
                'name' => 'List Model Tags',
                'description' => 'List model tags grouped by type.',
                'icon' => 'ph:tag',
            ],
            'huggingface_list_dataset_tags' => [
                'class' => HuggingFaceListDatasetTags::class,
                'type' => 'read',
                'name' => 'List Dataset Tags',
                'description' => 'List dataset tags grouped by type.',
                'icon' => 'ph:tag',
            ],
            'huggingface_list_space_hardware' => [
                'class' => HuggingFaceListSpaceHardware::class,
                'type' => 'read',
                'name' => 'List Space Hardware',
                'description' => 'List available Space hardware options.',
                'icon' => 'ph:cpu',
            ],
            'huggingface_create_repo' => [
                'class' => HuggingFaceCreateRepo::class,
                'type' => 'write',
                'name' => 'Create Repository',
                'description' => 'Create a model, dataset, or Space repository.',
                'icon' => 'ph:plus-circle',
            ],
            'huggingface_api_get' => [
                'class' => HuggingFaceApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Hugging Face Hub API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'huggingface_api_post' => [
                'class' => HuggingFaceApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Hugging Face Hub API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'huggingface_api_put' => [
                'class' => HuggingFaceApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative Hugging Face Hub API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'huggingface_api_delete' => [
                'class' => HuggingFaceApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Hugging Face Hub API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/hugging-face.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://huggingface.co/api'],
            ['key' => 'inference_url', 'type' => 'url', 'label' => 'Inference Base URL', 'required' => false, 'default' => 'https://router.huggingface.co/hf-inference/models'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $accessToken = $creds->get('hugging-face', 'access_token', '', $account)
                ?: $creds->get('huggingface', 'access_token', '', $account);
            $baseUrl = $creds->get('hugging-face', 'url', '', $account)
                ?: $creds->get('huggingface', 'url', 'https://huggingface.co/api', $account);
            $inferenceUrl = $creds->get('hugging-face', 'inference_url', '', $account)
                ?: $creds->get('huggingface', 'inference_url', 'https://router.huggingface.co/hf-inference/models', $account);

            $service = new HuggingFaceService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
                inferenceUrl: $inferenceUrl,
            );

            return new $class($service);
        }

        return new $class(app(HuggingFaceService::class));
    }
}
