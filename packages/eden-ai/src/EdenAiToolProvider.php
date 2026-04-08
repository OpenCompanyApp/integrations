<?php

namespace OpenCompany\Integrations\EdenAi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGenerateText;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiAnalyzeImage;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiTranslateText;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiTranscribeAudio;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiOcr;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGetCurrentUser;

class EdenAiToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'eden-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'generate, analyze, translate, transcribe, OCR',
            'description' => 'AI APIs aggregator',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:edenai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Eden AI',
            'description' => 'Unified AI APIs — text generation, image analysis, translation, audio transcription, and OCR through a single interface.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:edenai',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.edenai.co/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Eden AI API key',
                'hint' => 'Find your API key in the <a href="https://app.edenai.run/Account/ApiKey" target="_blank">Eden AI dashboard</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.edenai.run/v2',
                'hint' => 'Override only if using a custom Eden AI endpoint',
                'default' => 'https://api.edenai.run/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.edenai.run/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Eden AI API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "API returned an error: {$error}",
                ];
            }

            $email = $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Eden AI as {$email}.",
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
            'edenai_generate_text' => [
                'class' => EdenAiGenerateText::class,
                'type' => 'write',
                'name' => 'Generate Text',
                'description' => 'Generate text using AI models via Eden AI.',
                'icon' => 'ph:text-aa',
            ],
            'edenai_analyze_image' => [
                'class' => EdenAiAnalyzeImage::class,
                'type' => 'read',
                'name' => 'Analyze Image',
                'description' => 'Analyze images for content, objects, and features.',
                'icon' => 'ph:image',
            ],
            'edenai_translate_text' => [
                'class' => EdenAiTranslateText::class,
                'type' => 'write',
                'name' => 'Translate Text',
                'description' => 'Translate text between languages.',
                'icon' => 'ph:translate',
            ],
            'edenai_transcribe_audio' => [
                'class' => EdenAiTranscribeAudio::class,
                'type' => 'read',
                'name' => 'Transcribe Audio',
                'description' => 'Convert audio and video to text.',
                'icon' => 'ph:microphone',
            ],
            'edenai_ocr' => [
                'class' => EdenAiOcr::class,
                'type' => 'read',
                'name' => 'OCR',
                'description' => 'Extract text from images and documents.',
                'icon' => 'ph:file-text',
            ],
            'edenai_get_current_user' => [
                'class' => EdenAiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/eden-ai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Eden AI URL', 'required' => false, 'default' => 'https://api.edenai.run/v2'],
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

            $service = new EdenAiService(
                apiKey: $creds->get('eden-ai', 'api_key', '', $account),
                baseUrl: $creds->get('eden-ai', 'url', 'https://api.edenai.run/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(EdenAiService::class));
    }
}
