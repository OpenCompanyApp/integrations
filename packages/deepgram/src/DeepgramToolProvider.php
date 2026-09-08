<?php

namespace OpenCompany\Integrations\Deepgram;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramAnalyzeText;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramCreateProjectKey;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramDeleteProjectKey;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetModel;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetProject;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetProjectBalance;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetProjectModel;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetProjectRequest;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramGetUsageBreakdown;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListModels;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListProjectBalances;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListProjectKeys;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListProjectModels;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramListProjects;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramSpeak;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramTranscribeAudio;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramTranscribeUrl;
use OpenCompany\Integrations\Deepgram\Tools\DeepgramUpdateProject;

/**
 * Tool catalog and configuration metadata for Deepgram.
 *
 * Exposes Deepgram REST APIs for speech-to-text, text intelligence, text-to-
 * speech, model metadata, project administration, keys, balances, and usage.
 */
class DeepgramToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses Authorization: Token <API_KEY>.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'deepgram';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Deepgram',
            'description' => 'Speech-to-text, text intelligence, text-to-speech, and voice API management',
            'icon' => 'ph:microphone',
            'logo' => 'simple-icons:deepgram',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Deepgram',
            'description' => 'Deepgram REST APIs for prerecorded transcription, text intelligence, text-to-speech, model metadata, projects, API keys, balances, and usage reporting.',
            'icon' => 'ph:microphone',
            'logo' => 'simple-icons:deepgram',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.deepgram.com/reference/deepgram-api-overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Deepgram API key', 'hint' => 'Create an API key in the Deepgram console.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.deepgram.com/v1', 'hint' => 'Use https://api.deepgram.com/v1 unless using a compatible gateway.', 'default' => 'https://api.deepgram.com/v1'],
        ];
    }

    /**
     * Verify Deepgram credentials with the projects endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.deepgram.com/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/projects');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Deepgram API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Deepgram API at {$baseUrl}."];
        } catch (\Throwable $e) {
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
            'deepgram_transcribe_url' => ['class' => DeepgramTranscribeUrl::class, 'type' => 'read', 'name' => 'Transcribe URL', 'description' => 'Transcribe prerecorded media from a hosted URL.', 'icon' => 'ph:file-audio'],
            'deepgram_transcribe_audio' => ['class' => DeepgramTranscribeAudio::class, 'type' => 'read', 'name' => 'Transcribe Audio', 'description' => 'Transcribe raw audio bytes submitted by the host.', 'icon' => 'ph:waveform'],
            'deepgram_analyze_text' => ['class' => DeepgramAnalyzeText::class, 'type' => 'read', 'name' => 'Analyze Text', 'description' => 'Analyze text or a URL for summaries, topics, intents, and sentiment.', 'icon' => 'ph:text-aa'],
            'deepgram_speak' => ['class' => DeepgramSpeak::class, 'type' => 'read', 'name' => 'Speak', 'description' => 'Generate speech audio from text and return base64 audio.', 'icon' => 'ph:speaker-high'],
            'deepgram_list_models' => ['class' => DeepgramListModels::class, 'type' => 'read', 'name' => 'List Models', 'description' => 'List public Deepgram STT and TTS models.', 'icon' => 'ph:list'],
            'deepgram_get_model' => ['class' => DeepgramGetModel::class, 'type' => 'read', 'name' => 'Get Model', 'description' => 'Get public Deepgram model metadata.', 'icon' => 'ph:info'],
            'deepgram_list_projects' => ['class' => DeepgramListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List projects visible to the API key.', 'icon' => 'ph:folders'],
            'deepgram_get_project' => ['class' => DeepgramGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get Deepgram project details.', 'icon' => 'ph:folder'],
            'deepgram_update_project' => ['class' => DeepgramUpdateProject::class, 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update Deepgram project settings such as name.', 'icon' => 'ph:pencil'],
            'deepgram_list_project_keys' => ['class' => DeepgramListProjectKeys::class, 'type' => 'read', 'name' => 'List Project Keys', 'description' => 'List API keys for a project.', 'icon' => 'ph:key'],
            'deepgram_create_project_key' => ['class' => DeepgramCreateProjectKey::class, 'type' => 'write', 'name' => 'Create Project Key', 'description' => 'Create an API key for a project.', 'icon' => 'ph:key'],
            'deepgram_delete_project_key' => ['class' => DeepgramDeleteProjectKey::class, 'type' => 'write', 'name' => 'Delete Project Key', 'description' => 'Delete an API key from a project.', 'icon' => 'ph:trash'],
            'deepgram_list_project_balances' => ['class' => DeepgramListProjectBalances::class, 'type' => 'read', 'name' => 'List Project Balances', 'description' => 'List outstanding balances for a project.', 'icon' => 'ph:wallet'],
            'deepgram_get_project_balance' => ['class' => DeepgramGetProjectBalance::class, 'type' => 'read', 'name' => 'Get Project Balance', 'description' => 'Get one project balance by ID.', 'icon' => 'ph:wallet'],
            'deepgram_get_usage_breakdown' => ['class' => DeepgramGetUsageBreakdown::class, 'type' => 'read', 'name' => 'Get Usage Breakdown', 'description' => 'Get project usage breakdown with filters and groupings.', 'icon' => 'ph:chart-bar'],
            'deepgram_get_project_request' => ['class' => DeepgramGetProjectRequest::class, 'type' => 'read', 'name' => 'Get Project Request', 'description' => 'Get one project request by ID.', 'icon' => 'ph:file-search'],
            'deepgram_list_project_models' => ['class' => DeepgramListProjectModels::class, 'type' => 'read', 'name' => 'List Project Models', 'description' => 'List public and private models available to a project.', 'icon' => 'ph:list'],
            'deepgram_get_project_model' => ['class' => DeepgramGetProjectModel::class, 'type' => 'read', 'name' => 'Get Project Model', 'description' => 'Get project-specific model metadata.', 'icon' => 'ph:info'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/deepgram.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.deepgram.com/v1'],
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
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): DeepgramService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DeepgramService(
                apiKey: $creds->get('deepgram', 'api_key', '', $account),
                baseUrl: $creds->get('deepgram', 'url', 'https://api.deepgram.com/v1', $account),
            );
        }

        return app(DeepgramService::class);
    }
}
