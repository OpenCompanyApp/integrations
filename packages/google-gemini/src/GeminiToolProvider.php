<?php

namespace OpenCompany\Integrations\GoogleGemini;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiListModels;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiGetModel;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiGenerateContent;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiListFiles;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiGetFile;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiListTunedModels;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiGetCurrentUser;

class GeminiToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'google-gemini';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'models, generate, files, tuned models',
            'description' => 'Google Gemini AI',
            'icon' => 'ph:brain',
            'logo' => 'logos:google-gemini',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Gemini',
            'description' => 'Google Gemini generative AI — list models, generate content, manage files and tuned models.',
            'icon' => 'ph:brain',
            'logo' => 'logos:google-gemini',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://ai.google.dev/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Google Gemini API key',
                'hint' => 'Generate an API key in the <a href="https://aistudio.google.com/apikey" target="_blank">Google AI Studio</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://generativelanguage.googleapis.com',
                'hint' => 'Use the default Google endpoint, or a compatible proxy URL',
                'default' => 'https://generativelanguage.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://generativelanguage.googleapis.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'x-goog-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/models', ['pageSize' => 1]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gemini API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => "API error: {$error}"];
            }

            return [
                'success' => true,
                'message' => "Connected to Google Gemini API at {$baseUrl}.",
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
            'gemini_list_models' => [
                'class' => GeminiListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Gemini AI models.',
                'icon' => 'ph:list',
            ],
            'gemini_get_model' => [
                'class' => GeminiGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get details for a specific Gemini model.',
                'icon' => 'ph:info',
            ],
            'gemini_generate_content' => [
                'class' => GeminiGenerateContent::class,
                'type' => 'write',
                'name' => 'Generate Content',
                'description' => 'Generate content using a Gemini model.',
                'icon' => 'ph:brain',
            ],
            'gemini_list_files' => [
                'class' => GeminiListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List uploaded files in Gemini.',
                'icon' => 'ph:files',
            ],
            'gemini_get_file' => [
                'class' => GeminiGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get details for an uploaded file.',
                'icon' => 'ph:file',
            ],
            'gemini_list_tuned_models' => [
                'class' => GeminiListTunedModels::class,
                'type' => 'read',
                'name' => 'List Tuned Models',
                'description' => 'List tuned Gemini models.',
                'icon' => 'ph:sliders',
            ],
            'gemini_get_current_user' => [
                'class' => GeminiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-gemini.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://generativelanguage.googleapis.com'],
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

            $service = new GeminiService(
                apiKey: $creds->get('google-gemini', 'api_key', '', $account),
                baseUrl: $creds->get('google-gemini', 'url', 'https://generativelanguage.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GeminiService::class));
    }
}
