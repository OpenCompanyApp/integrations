<?php

namespace OpenCompany\Integrations\Groq;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Groq.
 *
 * Exposes the documented Groq API surface: chat, responses, audio, models,
 * batches, files, and closed-beta fine-tuning endpoints.
 */
class GroqToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'groq_list_models' => ['GroqListModels', 'read', 'List Models', 'List available Groq models.', 'ph:list'],
        'groq_get_model' => ['GroqGetModel', 'read', 'Get Model', 'Retrieve a Groq model by ID.', 'ph:info'],
        'groq_create_completion' => ['GroqCreateCompletion', 'write', 'Create Chat Completion', 'Create a chat completion using a Groq model.', 'ph:chat-circle-text'],
        'groq_create_response' => ['GroqCreateResponse', 'write', 'Create Response', 'Create a response through Groq beta Responses API.', 'ph:sparkle'],
        'groq_create_transcription' => ['GroqCreateTranscription', 'write', 'Create Transcription', 'Transcribe audio with Groq.', 'ph:waveform'],
        'groq_create_translation' => ['GroqCreateTranslation', 'write', 'Create Translation', 'Translate audio into English with Groq.', 'ph:translate'],
        'groq_create_speech' => ['GroqCreateSpeech', 'write', 'Create Speech', 'Generate speech audio from text.', 'ph:speaker-high'],
        'groq_create_batch' => ['GroqCreateBatch', 'write', 'Create Batch', 'Create a batch job from an uploaded JSONL file.', 'ph:stack'],
        'groq_get_batch' => ['GroqGetBatch', 'read', 'Get Batch', 'Retrieve a batch job by ID.', 'ph:database'],
        'groq_list_batches' => ['GroqListBatches', 'read', 'List Batches', 'List Groq batch jobs.', 'ph:list-bullets'],
        'groq_cancel_batch' => ['GroqCancelBatch', 'write', 'Cancel Batch', 'Cancel a Groq batch job.', 'ph:x-circle'],
        'groq_upload_file' => ['GroqUploadFile', 'write', 'Upload File', 'Upload a file for batch processing.', 'ph:upload-simple'],
        'groq_list_files' => ['GroqListFiles', 'read', 'List Files', 'List uploaded Groq files.', 'ph:files'],
        'groq_get_file' => ['GroqGetFile', 'read', 'Get File', 'Retrieve Groq file metadata.', 'ph:file'],
        'groq_download_file' => ['GroqDownloadFile', 'read', 'Download File', 'Download Groq file content.', 'ph:download-simple'],
        'groq_delete_file' => ['GroqDeleteFile', 'write', 'Delete File', 'Delete an uploaded Groq file.', 'ph:trash'],
        'groq_list_fine_tunings' => ['GroqListFineTunings', 'read', 'List Fine Tunings', 'List Groq fine-tuning jobs.', 'ph:list-checks'],
        'groq_create_fine_tuning' => ['GroqCreateFineTuning', 'write', 'Create Fine Tuning', 'Create a Groq fine-tuning job.', 'ph:tuning'],
        'groq_get_fine_tuning' => ['GroqGetFineTuning', 'read', 'Get Fine Tuning', 'Retrieve a Groq fine-tuning job.', 'ph:target'],
        'groq_delete_fine_tuning' => ['GroqDeleteFineTuning', 'write', 'Delete Fine Tuning', 'Delete a Groq fine-tuning job.', 'ph:trash-simple'],
    ];

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
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'groq';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Groq',
            'description' => 'Groq AI inference, audio, batches, files, and fine tuning',
            'icon' => 'ph:lightning',
            'logo' => 'logos:groq',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Groq',
            'description' => 'Groq AI inference with chat completions, beta responses, speech-to-text, text-to-speech, models, batches, files, and fine tuning.',
            'icon' => 'ph:lightning',
            'logo' => 'logos:groq',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://console.groq.com/docs/api-reference',
        ];
    }

    /**
     * Configuration schema for settings UIs.
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
                'placeholder' => 'Enter your Groq API key',
                'hint' => 'Generate an API key in the <a href="https://console.groq.com/keys" target="_blank">Groq Console</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.groq.com/openai/v1',
                'hint' => 'Use the default Groq endpoint, or a compatible proxy URL',
                'default' => 'https://api.groq.com/openai/v1',
            ],
        ];
    }

    /**
     * Test credentials with the lightweight models endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.groq.com/openai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/models');

            $json = $response->json();
            if ($json === null) {
                return ['success' => false, 'error' => "Could not reach Groq API at {$baseUrl}. Check the URL."];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? 'Unknown error';

                return ['success' => false, 'error' => "API error: {$error}"];
            }

            return ['success' => true, 'message' => "Connected to Groq API at {$baseUrl}."];
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

    /**
     * Return all available Groq tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/groq.md';
    }

    /**
     * Credential fields required for setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.groq.com/openai/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new GroqService(
                apiKey: $creds->get('groq', 'api_key', '', $account),
                baseUrl: $creds->get('groq', 'url', 'https://api.groq.com/openai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GroqService::class));
    }
}
