<?php

namespace OpenCompany\Integrations\AssemblyAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAICreateStreamingToken;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIDeleteTranscript;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetParagraphs;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetRedactedAudio;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetSentences;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetSubtitles;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetTranscript;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIListTranscripts;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAILlmGatewayChat;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAITranscribe;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIUpload;

/**
 * Tool provider for the AssemblyAI integration.
 *
 * Defines transcripts, uploads, streaming-token, and LLM Gateway tools plus credential setup.
 */
class AssemblyAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'assemblyai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'AssemblyAI',
            'description' => 'Speech-to-text, transcript exports, streaming tokens, and LLM Gateway.',
            'icon' => 'ph:microphone',
            'logo' => 'simple-icons:assemblyai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'AssemblyAI',
            'description' => 'Pre-recorded speech-to-text, transcript export/delete, uploads, temporary streaming tokens, and LLM Gateway chat completions.',
            'icon' => 'ph:microphone',
            'logo' => 'simple-icons:assemblyai',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.assemblyai.com/docs/api-reference/overview',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your AssemblyAI API key',
                'hint' => 'Find your API key in the <a href="https://www.assemblyai.com/app/account" target="_blank">AssemblyAI dashboard</a> under Account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.assemblyai.com/v2',
                'hint' => 'Use the default AssemblyAI API URL, or a custom endpoint if applicable',
                'default' => 'https://api.assemblyai.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the AssemblyAI API.
     *
     * @param  array  $config  Configuration values to test with.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.assemblyai.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/transcript', [
                'limit' => 1,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to AssemblyAI API at {$baseUrl}.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => is_string($error) ? $error : json_encode($error),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available AssemblyAI tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'assemblyai_transcribe' => [
                'class' => AssemblyAITranscribe::class,
                'type' => 'write',
                'name' => 'Transcribe Audio',
                'description' => 'Submit an audio or video file URL for transcription.',
                'icon' => 'ph:microphone',
            ],
            'assemblyai_get_transcript' => [
                'class' => AssemblyAIGetTranscript::class,
                'type' => 'read',
                'name' => 'Get Transcript',
                'description' => 'Retrieve a completed transcript by ID.',
                'icon' => 'ph:file-text',
            ],
            'assemblyai_delete_transcript' => [
                'class' => AssemblyAIDeleteTranscript::class,
                'type' => 'write',
                'name' => 'Delete Transcript',
                'description' => 'Delete transcript data and associated uploaded file data.',
                'icon' => 'ph:trash',
            ],
            'assemblyai_get_paragraphs' => [
                'class' => AssemblyAIGetParagraphs::class,
                'type' => 'read',
                'name' => 'Get Paragraphs',
                'description' => 'Export a transcript split into paragraphs.',
                'icon' => 'ph:paragraph',
            ],
            'assemblyai_get_sentences' => [
                'class' => AssemblyAIGetSentences::class,
                'type' => 'read',
                'name' => 'Get Sentences',
                'description' => 'Export a transcript split into sentences.',
                'icon' => 'ph:text-align-left',
            ],
            'assemblyai_get_subtitles' => [
                'class' => AssemblyAIGetSubtitles::class,
                'type' => 'read',
                'name' => 'Get Subtitles',
                'description' => 'Export a transcript as SRT or VTT subtitle text.',
                'icon' => 'ph:closed-captioning',
            ],
            'assemblyai_get_redacted_audio' => [
                'class' => AssemblyAIGetRedactedAudio::class,
                'type' => 'read',
                'name' => 'Get Redacted Audio',
                'description' => 'Get generated redacted audio for a transcript.',
                'icon' => 'ph:file-audio',
            ],
            'assemblyai_list_transcripts' => [
                'class' => AssemblyAIListTranscripts::class,
                'type' => 'read',
                'name' => 'List Transcripts',
                'description' => 'List transcripts with pagination.',
                'icon' => 'ph:list',
            ],
            'assemblyai_upload' => [
                'class' => AssemblyAIUpload::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a local audio or video file for transcription.',
                'icon' => 'ph:upload',
            ],
            'assemblyai_create_streaming_token' => [
                'class' => AssemblyAICreateStreamingToken::class,
                'type' => 'read',
                'name' => 'Create Streaming Token',
                'description' => 'Generate a temporary token for Streaming Speech-to-Text.',
                'icon' => 'ph:key',
            ],
            'assemblyai_llm_gateway_chat' => [
                'class' => AssemblyAILlmGatewayChat::class,
                'type' => 'read',
                'name' => 'LLM Gateway Chat',
                'description' => 'Create a chat completion through AssemblyAI LLM Gateway.',
                'icon' => 'ph:chat-circle-text',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/assemblyai.md';
    }

    /**
     * Credential fields required for multi-account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.assemblyai.com/v2'],
        ];
    }

    /**
     * Confirm this provider is an integration (not just standalone tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array  $context  Context containing optional 'account' key for multi-account.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the AssemblyAI service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool execution context.
     */
    private function resolveService(array $context = []): AssemblyAIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AssemblyAIService(
                apiKey: $creds->get('assemblyai', 'api_key', '', $account),
                baseUrl: $creds->get('assemblyai', 'url', 'https://api.assemblyai.com/v2', $account),
            );
        }

        return app(AssemblyAIService::class);
    }
}
