<?php

namespace OpenCompany\Integrations\EdenAi;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiAnalyzeImage;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiApiGet;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiApiPost;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiChatCompletions;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiDeleteAllUploadedFiles;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGenerateText;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGetCurrentUser;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGetFeatureInfo;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGetUniversalAiJob;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiListFeatures;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiListModels;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiOcr;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiTranscribeAudio;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiTranslateText;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiUniversalAi;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiUniversalAiAsync;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiUploadFile;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiV3ApiGet;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiV3ApiPost;

/**
 * Exposes Eden AI tools and credential metadata to host applications.
 */
class EdenAiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [
                    'V3 is the current Eden AI API. V2 helpers remain for legacy accounts while old Eden AI remains supported by Eden AI through the end of 2026.',
                ],
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
        return 'eden-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Eden AI',
            'description' => 'AI APIs aggregator',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:edenai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Eden AI',
            'description' => 'Unified AI gateway for LLMs, expert models, OCR, translation, audio, and image features.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:edenai',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.edenai.co/docs',
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
                'hint' => 'Create an API key in the Eden AI dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Legacy V2 Base URL',
                'placeholder' => 'https://api.edenai.run/v2',
                'hint' => 'Used for legacy V2 helper tools.',
                'default' => 'https://api.edenai.run/v2',
            ],
            [
                'key' => 'v3_url',
                'type' => 'url',
                'label' => 'V3 Base URL',
                'placeholder' => 'https://api.edenai.run/v3',
                'hint' => 'Used for current Eden AI V3 tools.',
                'default' => 'https://api.edenai.run/v3',
            ],
        ];
    }

    /**
     * Verify credentials with the current V3 models endpoint.
     *
     * @param  array<string, mixed>  $config  Eden AI connection configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = trim((string) ($config['api_key'] ?? ''));

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $service = new EdenAiService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.edenai.run/v2'),
                v3BaseUrl: (string) ($config['v3_url'] ?? 'https://api.edenai.run/v3'),
            );
            $service->listModels();

            return [
                'success' => true,
                'message' => 'Connected to Eden AI V3 API.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'url' => 'nullable|url',
            'v3_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'edenai_chat_completions' => ['class' => EdenAiChatCompletions::class, 'type' => 'write', 'name' => 'Chat Completions', 'description' => 'Create a V3 chat completion.', 'icon' => 'ph:chat-circle-text'],
            'edenai_list_models' => ['class' => EdenAiListModels::class, 'type' => 'read', 'name' => 'List Models', 'description' => 'List V3 LLM models.', 'icon' => 'ph:list-bullets'],
            'edenai_universal_ai' => ['class' => EdenAiUniversalAi::class, 'type' => 'write', 'name' => 'Universal AI', 'description' => 'Call V3 Universal AI synchronously.', 'icon' => 'ph:brain'],
            'edenai_universal_ai_async' => ['class' => EdenAiUniversalAiAsync::class, 'type' => 'write', 'name' => 'Universal AI Async', 'description' => 'Submit a V3 Universal AI async job.', 'icon' => 'ph:clock'],
            'edenai_get_universal_ai_job' => ['class' => EdenAiGetUniversalAiJob::class, 'type' => 'read', 'name' => 'Get Universal AI Job', 'description' => 'Get a V3 async job result.', 'icon' => 'ph:clock-counter-clockwise'],
            'edenai_list_features' => ['class' => EdenAiListFeatures::class, 'type' => 'read', 'name' => 'List Features', 'description' => 'List V3 expert model features.', 'icon' => 'ph:tree-structure'],
            'edenai_get_feature_info' => ['class' => EdenAiGetFeatureInfo::class, 'type' => 'read', 'name' => 'Get Feature Info', 'description' => 'Get V3 feature discovery info.', 'icon' => 'ph:info'],
            'edenai_upload_file' => ['class' => EdenAiUploadFile::class, 'type' => 'write', 'name' => 'Upload File', 'description' => 'Upload a file to V3 storage.', 'icon' => 'ph:file-arrow-up'],
            'edenai_delete_all_uploaded_files' => ['class' => EdenAiDeleteAllUploadedFiles::class, 'type' => 'write', 'name' => 'Delete Uploaded Files', 'description' => 'Delete all uploaded V3 files.', 'icon' => 'ph:trash'],
            'edenai_generate_text' => ['class' => EdenAiGenerateText::class, 'type' => 'write', 'name' => 'Generate Text', 'description' => 'Generate text using legacy V2 models.', 'icon' => 'ph:text-aa'],
            'edenai_analyze_image' => ['class' => EdenAiAnalyzeImage::class, 'type' => 'read', 'name' => 'Analyze Image', 'description' => 'Analyze images using legacy V2 providers.', 'icon' => 'ph:image'],
            'edenai_translate_text' => ['class' => EdenAiTranslateText::class, 'type' => 'write', 'name' => 'Translate Text', 'description' => 'Translate text using legacy V2 providers.', 'icon' => 'ph:translate'],
            'edenai_transcribe_audio' => ['class' => EdenAiTranscribeAudio::class, 'type' => 'read', 'name' => 'Transcribe Audio', 'description' => 'Transcribe audio using legacy V2 providers.', 'icon' => 'ph:microphone'],
            'edenai_ocr' => ['class' => EdenAiOcr::class, 'type' => 'read', 'name' => 'OCR', 'description' => 'Run OCR using legacy V2 providers.', 'icon' => 'ph:file-text'],
            'edenai_get_current_user' => ['class' => EdenAiGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get legacy V2 account information.', 'icon' => 'ph:user'],
            'edenai_api_get' => ['class' => EdenAiApiGet::class, 'type' => 'read', 'name' => 'V2 API GET', 'description' => 'Call a legacy V2 GET endpoint.', 'icon' => 'ph:terminal-window'],
            'edenai_api_post' => ['class' => EdenAiApiPost::class, 'type' => 'write', 'name' => 'V2 API POST', 'description' => 'Call a legacy V2 POST endpoint.', 'icon' => 'ph:terminal-window'],
            'edenai_v3_api_get' => ['class' => EdenAiV3ApiGet::class, 'type' => 'read', 'name' => 'V3 API GET', 'description' => 'Call a V3 GET endpoint.', 'icon' => 'ph:terminal-window'],
            'edenai_v3_api_post' => ['class' => EdenAiV3ApiPost::class, 'type' => 'write', 'name' => 'V3 API POST', 'description' => 'Call a V3 POST endpoint.', 'icon' => 'ph:terminal-window'],
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
            ['key' => 'url', 'type' => 'url', 'label' => 'Legacy V2 URL', 'required' => false, 'default' => 'https://api.edenai.run/v2'],
            ['key' => 'v3_url', 'type' => 'url', 'label' => 'V3 URL', 'required' => false, 'default' => 'https://api.edenai.run/v3'],
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
     * Resolve the Eden AI service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): EdenAiService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new EdenAiService(
                apiKey: $creds->get('eden-ai', 'api_key', '', $account),
                baseUrl: $creds->get('eden-ai', 'url', 'https://api.edenai.run/v2', $account),
                v3BaseUrl: $creds->get('eden-ai', 'v3_url', 'https://api.edenai.run/v3', $account),
            );
        }

        return app(EdenAiService::class);
    }
}
