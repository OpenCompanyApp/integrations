<?php

namespace OpenCompany\Integrations\OpenAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIChatCompletion;
use OpenCompany\Integrations\OpenAI\Tools\OpenAICreateEmbedding;
use OpenCompany\Integrations\OpenAI\Tools\OpenAICreateImage;
use OpenCompany\Integrations\OpenAI\Tools\OpenAITranscribeAudio;
use OpenCompany\Integrations\OpenAI\Tools\OpenAITextToSpeech;
use OpenCompany\Integrations\OpenAI\Tools\OpenAICreateAssistant;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIListAssistants;
use OpenCompany\Integrations\OpenAI\Tools\OpenAICreateThread;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIAddMessageToThread;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIListThreadMessages;
use OpenCompany\Integrations\OpenAI\Tools\OpenAICreateRun;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIGetRun;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIUploadFile;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIListFiles;
use OpenCompany\Integrations\OpenAI\Tools\OpenAIListModels;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all OpenAI tools and provides integration metadata.
 *
 * Exposes 15 tools covering chat completions, embeddings, images,
 * audio, assistants, threads, runs, files, and models via the
 * ToolProvider contract.
 */
class OpenAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'openai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OpenAI',
            'description' => 'OpenAI',
            'icon' => 'ph:openai-logo',
            'logo' => 'simple-icons:openai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenAI',
            'description' => 'Chat completions, embeddings, images, audio, assistants, and file management',
            'icon' => 'ph:openai-logo',
            'logo' => 'simple-icons:openai',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://platform.openai.com/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'sk-...',
                'hint' => 'OpenAI API key from <a href="https://platform.openai.com/api-keys" target="_blank">platform.openai.com</a>. Starts with <code>sk-</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the OpenAI connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Generate one at platform.openai.com.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.openai.com/v1/models');

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'OpenAI API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $body = $response->json() ?? [];
            $count = count($body['data'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to OpenAI — {$count} models available.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Chat
            'openai_chat_completion' => [
                'class' => OpenAIChatCompletion::class,
                'type' => 'write',
                'name' => 'Chat Completion',
                'description' => 'Generate a chat completion using GPT models.',
                'icon' => 'ph:chat-circle-text',
            ],
            // Embeddings
            'openai_create_embedding' => [
                'class' => OpenAICreateEmbedding::class,
                'type' => 'write',
                'name' => 'Create Embedding',
                'description' => 'Generate an embedding vector for text input.',
                'icon' => 'ph:vector-three',
            ],
            // Images
            'openai_create_image' => [
                'class' => OpenAICreateImage::class,
                'type' => 'write',
                'name' => 'Create Image',
                'description' => 'Generate an image using DALL·E.',
                'icon' => 'ph:image',
            ],
            // Audio
            'openai_transcribe_audio' => [
                'class' => OpenAITranscribeAudio::class,
                'type' => 'write',
                'name' => 'Transcribe Audio',
                'description' => 'Transcribe audio using Whisper.',
                'icon' => 'ph:microphone',
            ],
            'openai_text_to_speech' => [
                'class' => OpenAITextToSpeech::class,
                'type' => 'write',
                'name' => 'Text to Speech',
                'description' => 'Generate speech audio from text.',
                'icon' => 'ph:speaker-high',
            ],
            // Assistants
            'openai_create_assistant' => [
                'class' => OpenAICreateAssistant::class,
                'type' => 'write',
                'name' => 'Create Assistant',
                'description' => 'Create an OpenAI assistant.',
                'icon' => 'ph:robot',
            ],
            'openai_list_assistants' => [
                'class' => OpenAIListAssistants::class,
                'type' => 'read',
                'name' => 'List Assistants',
                'description' => 'List all OpenAI assistants.',
                'icon' => 'ph:robots',
            ],
            // Threads
            'openai_create_thread' => [
                'class' => OpenAICreateThread::class,
                'type' => 'write',
                'name' => 'Create Thread',
                'description' => 'Create a conversation thread.',
                'icon' => 'ph:chat-dots',
            ],
            'openai_add_message_to_thread' => [
                'class' => OpenAIAddMessageToThread::class,
                'type' => 'write',
                'name' => 'Add Message to Thread',
                'description' => 'Add a message to an existing thread.',
                'icon' => 'ph:chat-plus',
            ],
            'openai_list_thread_messages' => [
                'class' => OpenAIListThreadMessages::class,
                'type' => 'read',
                'name' => 'List Thread Messages',
                'description' => 'List messages in a thread.',
                'icon' => 'ph:chat-text',
            ],
            // Runs
            'openai_create_run' => [
                'class' => OpenAICreateRun::class,
                'type' => 'write',
                'name' => 'Create Run',
                'description' => 'Start an assistant run on a thread.',
                'icon' => 'ph:play',
            ],
            'openai_get_run' => [
                'class' => OpenAIGetRun::class,
                'type' => 'read',
                'name' => 'Get Run',
                'description' => 'Get the status of a thread run.',
                'icon' => 'ph:spinner',
            ],
            // Files
            'openai_upload_file' => [
                'class' => OpenAIUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to OpenAI.',
                'icon' => 'ph:upload-simple',
            ],
            'openai_list_files' => [
                'class' => OpenAIListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files uploaded to OpenAI.',
                'icon' => 'ph:files',
            ],
            // Models
            'openai_list_models' => [
                'class' => OpenAIListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available OpenAI models.',
                'icon' => 'ph:list-dashes',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/openai.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the OpenAIService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): OpenAIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new OpenAIService(
                apiKey: $creds->get('openai', 'api_key', '', $account),
            );
        }

        return app(OpenAIService::class);
    }
}
