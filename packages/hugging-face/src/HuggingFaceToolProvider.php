<?php

namespace OpenCompany\Integrations\HuggingFace;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListModels;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetModel;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListDatasets;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceInference;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListSpaces;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceGetCurrentUser;

class HuggingFaceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'hugging-face';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'models, datasets, spaces, inference',
            'description' => 'AI model hub & inference',
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
            'category' => 'ai',
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
        ];
    }

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
            ])->timeout(10)->get($baseUrl . '/users/me');

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
        } catch (\Exception $e) {
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
            'huggingface_get_current_user' => [
                'class' => HuggingFaceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hugging-face.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://huggingface.co/api'],
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new HuggingFaceService(
                accessToken: $creds->get('hugging-face', 'access_token', '', $account),
                baseUrl: $creds->get('hugging-face', 'url', 'https://huggingface.co/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(HuggingFaceService::class));
    }
}
