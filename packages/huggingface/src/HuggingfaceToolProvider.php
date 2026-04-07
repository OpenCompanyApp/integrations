<?php

namespace OpenCompany\Integrations\Huggingface;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceListModels;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceGetModel;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceListDatasets;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceGetDataset;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceListSpaces;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceGetSpace;
use OpenCompany\Integrations\Huggingface\Tools\HuggingfaceGetCurrentUser;

class HuggingfaceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'huggingface';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'models, datasets, spaces',
            'description' => 'AI model hub & datasets',
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
                'class' => HuggingfaceListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'Search and list AI models on the Hugging Face Hub.',
                'icon' => 'ph:magnifying-glass',
            ],
            'huggingface_get_model' => [
                'class' => HuggingfaceGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get detailed information about a specific model.',
                'icon' => 'ph:cube',
            ],
            'huggingface_list_datasets' => [
                'class' => HuggingfaceListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'Search and list datasets on the Hugging Face Hub.',
                'icon' => 'ph:database',
            ],
            'huggingface_get_dataset' => [
                'class' => HuggingfaceGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Get detailed information about a specific dataset.',
                'icon' => 'ph:database',
            ],
            'huggingface_list_spaces' => [
                'class' => HuggingfaceListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'Search and list Spaces on the Hugging Face Hub.',
                'icon' => 'ph:app-window',
            ],
            'huggingface_get_space' => [
                'class' => HuggingfaceGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get detailed information about a specific Space.',
                'icon' => 'ph:app-window',
            ],
            'huggingface_get_current_user' => [
                'class' => HuggingfaceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/huggingface.md';
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

            $service = new HuggingfaceService(
                accessToken: $creds->get('huggingface', 'access_token', '', $account),
                baseUrl: $creds->get('huggingface', 'url', 'https://huggingface.co/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(HuggingfaceService::class));
    }
}
