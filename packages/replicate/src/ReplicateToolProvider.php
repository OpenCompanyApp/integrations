<?php

namespace OpenCompany\Integrations\Replicate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Replicate\Tools\ReplicateListPredictions;
use OpenCompany\Integrations\Replicate\Tools\ReplicateGetPrediction;
use OpenCompany\Integrations\Replicate\Tools\ReplicateCreatePrediction;
use OpenCompany\Integrations\Replicate\Tools\ReplicateListModels;
use OpenCompany\Integrations\Replicate\Tools\ReplicateGetModel;
use OpenCompany\Integrations\Replicate\Tools\ReplicateListCollections;
use OpenCompany\Integrations\Replicate\Tools\ReplicateGetCurrentUser;

class ReplicateToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'replicate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'predictions, models, collections',
            'description' => 'AI model hosting & predictions',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:replicate',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Replicate',
            'description' => 'Run AI models in the cloud — generate images, text, audio, and more with open-source models',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:replicate',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://replicate.com/docs/topics/predictions',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Replicate API token',
                'hint' => 'Find your API token at <b>replicate.com/account/api-tokens</b>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.replicate.com/v1',
                'hint' => 'Defaults to <code>https://api.replicate.com/v1</code>. Change only for custom endpoints.',
                'default' => 'https://api.replicate.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.replicate.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Replicate API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['detail'] ?? $json['error'] ?? 'Unknown error';
                return ['success' => false, 'error' => "API error: {$error}"];
            }

            $name = $json['name'] ?? $json['username'] ?? 'Replicate';

            return [
                'success' => true,
                'message' => "Connected to Replicate as {$name}.",
            ];
        } catch (\Exception $e) {
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
            'replicate_list_predictions' => [
                'class' => ReplicateListPredictions::class,
                'type' => 'read',
                'name' => 'List Predictions',
                'description' => 'List recent Replicate predictions.',
                'icon' => 'ph:list-bullets',
            ],
            'replicate_get_prediction' => [
                'class' => ReplicateGetPrediction::class,
                'type' => 'read',
                'name' => 'Get Prediction',
                'description' => 'Get details for a specific prediction by ID.',
                'icon' => 'ph:magnifying-glass',
            ],
            'replicate_create_prediction' => [
                'class' => ReplicateCreatePrediction::class,
                'type' => 'write',
                'name' => 'Create Prediction',
                'description' => 'Create a new prediction using a model version.',
                'icon' => 'ph:play',
            ],
            'replicate_list_models' => [
                'class' => ReplicateListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Replicate models.',
                'icon' => 'ph:cube',
            ],
            'replicate_get_model' => [
                'class' => ReplicateGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get details for a specific model by owner and name.',
                'icon' => 'ph:cube-transparent',
            ],
            'replicate_list_collections' => [
                'class' => ReplicateListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List model collections on Replicate.',
                'icon' => 'ph:folders',
            ],
            'replicate_get_current_user' => [
                'class' => ReplicateGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user profile and billing information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/replicate.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.replicate.com/v1'],
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

            $service = new ReplicateService(
                apiKey: $creds->get('replicate', 'api_key', '', $account),
                baseUrl: $creds->get('replicate', 'url', 'https://api.replicate.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ReplicateService::class));
    }
}
