<?php

namespace OpenCompany\Integrations\ElevenLabs;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsApiDelete;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsApiGet;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsApiPost;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsCreateDubbing;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsCreateSoundEffect;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsCreateVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsDeleteDubbing;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsDeleteHistoryItem;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsDeleteVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsEditVoiceSettings;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetCurrentUser;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetDubbing;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetDubbingTranscript;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetHistory;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetHistoryItem;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetHistoryItemAudio;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetModels;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetSubscription;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetVoiceSettings;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsIsolateAudio;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListAudioIsolationHistory;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListDubbings;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListVoices;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsSpeechToSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsSpeechToText;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsTextToSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsTextToSpeechWithTimestamps;

/**
 * Exposes ElevenLabs tools and credential metadata to host applications.
 */
class ElevenLabsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'elevenlabs';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ElevenLabs',
            'description' => 'AI audio generation',
            'icon' => 'ph:speaker-high',
            'logo' => 'simple-icons:elevenlabs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ElevenLabs',
            'description' => 'AI speech, transcription, voice conversion, sound effects, dubbing, voices, and history.',
            'icon' => 'ph:speaker-high',
            'logo' => 'simple-icons:elevenlabs',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://elevenlabs.io/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ElevenLabs API key',
                'hint' => 'Create an API key in ElevenLabs account settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.elevenlabs.io/v1',
                'hint' => 'Use the default ElevenLabs v1 API URL unless targeting a compatible environment.',
                'default' => 'https://api.elevenlabs.io/v1',
            ],
        ];
    }

    /**
     * Verify the API key by fetching the current user.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = trim((string) ($config['api_key'] ?? ''));

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $service = new ElevenLabsService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.elevenlabs.io/v1'),
            );
            $service->getCurrentUser();

            return [
                'success' => true,
                'message' => 'Connected to ElevenLabs API.',
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
        ];
    }

    public function tools(): array
    {
        return [
            'elevenlabs_text_to_speech' => ['class' => ElevenLabsTextToSpeech::class, 'type' => 'write', 'name' => 'Text to Speech', 'description' => 'Convert text to speech audio.', 'icon' => 'ph:speaker-high'],
            'elevenlabs_text_to_speech_with_timestamps' => ['class' => ElevenLabsTextToSpeechWithTimestamps::class, 'type' => 'write', 'name' => 'Text to Speech With Timestamps', 'description' => 'Convert text to speech with character timing.', 'icon' => 'ph:timer'],
            'elevenlabs_speech_to_speech' => ['class' => ElevenLabsSpeechToSpeech::class, 'type' => 'write', 'name' => 'Speech to Speech', 'description' => 'Transform an audio file into another voice.', 'icon' => 'ph:waveform'],
            'elevenlabs_speech_to_text' => ['class' => ElevenLabsSpeechToText::class, 'type' => 'read', 'name' => 'Speech to Text', 'description' => 'Transcribe audio or video.', 'icon' => 'ph:closed-captioning'],
            'elevenlabs_create_sound_effect' => ['class' => ElevenLabsCreateSoundEffect::class, 'type' => 'write', 'name' => 'Create Sound Effect', 'description' => 'Generate a sound effect from text.', 'icon' => 'ph:music-notes'],
            'elevenlabs_isolate_audio' => ['class' => ElevenLabsIsolateAudio::class, 'type' => 'write', 'name' => 'Isolate Audio', 'description' => 'Remove background noise from audio.', 'icon' => 'ph:faders'],
            'elevenlabs_list_audio_isolation_history' => ['class' => ElevenLabsListAudioIsolationHistory::class, 'type' => 'read', 'name' => 'List Audio Isolation History', 'description' => 'List audio isolation generations.', 'icon' => 'ph:clock-counter-clockwise'],
            'elevenlabs_list_voices' => ['class' => ElevenLabsListVoices::class, 'type' => 'read', 'name' => 'List Voices', 'description' => 'List available voices.', 'icon' => 'ph:microphone'],
            'elevenlabs_get_voice' => ['class' => ElevenLabsGetVoice::class, 'type' => 'read', 'name' => 'Get Voice', 'description' => 'Get one voice.', 'icon' => 'ph:microphone'],
            'elevenlabs_get_voice_settings' => ['class' => ElevenLabsGetVoiceSettings::class, 'type' => 'read', 'name' => 'Get Voice Settings', 'description' => 'Get voice settings.', 'icon' => 'ph:sliders'],
            'elevenlabs_edit_voice_settings' => ['class' => ElevenLabsEditVoiceSettings::class, 'type' => 'write', 'name' => 'Edit Voice Settings', 'description' => 'Edit voice settings.', 'icon' => 'ph:sliders-horizontal'],
            'elevenlabs_create_voice' => ['class' => ElevenLabsCreateVoice::class, 'type' => 'write', 'name' => 'Create Voice', 'description' => 'Create a cloned voice.', 'icon' => 'ph:plus-circle'],
            'elevenlabs_delete_voice' => ['class' => ElevenLabsDeleteVoice::class, 'type' => 'write', 'name' => 'Delete Voice', 'description' => 'Delete a voice.', 'icon' => 'ph:trash'],
            'elevenlabs_get_models' => ['class' => ElevenLabsGetModels::class, 'type' => 'read', 'name' => 'Get Models', 'description' => 'List models.', 'icon' => 'ph:cube'],
            'elevenlabs_get_history' => ['class' => ElevenLabsGetHistory::class, 'type' => 'read', 'name' => 'Get History', 'description' => 'Browse generation history.', 'icon' => 'ph:clock-counter-clockwise'],
            'elevenlabs_get_history_item' => ['class' => ElevenLabsGetHistoryItem::class, 'type' => 'read', 'name' => 'Get History Item', 'description' => 'Get one history item.', 'icon' => 'ph:file-audio'],
            'elevenlabs_get_history_item_audio' => ['class' => ElevenLabsGetHistoryItemAudio::class, 'type' => 'read', 'name' => 'Get History Item Audio', 'description' => 'Download history item audio.', 'icon' => 'ph:download-simple'],
            'elevenlabs_delete_history_item' => ['class' => ElevenLabsDeleteHistoryItem::class, 'type' => 'write', 'name' => 'Delete History Item', 'description' => 'Delete one history item.', 'icon' => 'ph:trash'],
            'elevenlabs_create_dubbing' => ['class' => ElevenLabsCreateDubbing::class, 'type' => 'write', 'name' => 'Create Dubbing', 'description' => 'Create a dubbing project.', 'icon' => 'ph:translate'],
            'elevenlabs_list_dubbings' => ['class' => ElevenLabsListDubbings::class, 'type' => 'read', 'name' => 'List Dubbings', 'description' => 'List dubbing projects.', 'icon' => 'ph:list'],
            'elevenlabs_get_dubbing' => ['class' => ElevenLabsGetDubbing::class, 'type' => 'read', 'name' => 'Get Dubbing', 'description' => 'Get one dubbing project.', 'icon' => 'ph:film-strip'],
            'elevenlabs_delete_dubbing' => ['class' => ElevenLabsDeleteDubbing::class, 'type' => 'write', 'name' => 'Delete Dubbing', 'description' => 'Delete a dubbing project.', 'icon' => 'ph:trash'],
            'elevenlabs_get_dubbing_transcript' => ['class' => ElevenLabsGetDubbingTranscript::class, 'type' => 'read', 'name' => 'Get Dubbing Transcript', 'description' => 'Get a dubbing transcript.', 'icon' => 'ph:subtitles'],
            'elevenlabs_get_current_user' => ['class' => ElevenLabsGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get current user info.', 'icon' => 'ph:user-circle'],
            'elevenlabs_get_subscription' => ['class' => ElevenLabsGetSubscription::class, 'type' => 'read', 'name' => 'Get Subscription', 'description' => 'Get subscription and quota details.', 'icon' => 'ph:credit-card'],
            'elevenlabs_api_get' => ['class' => ElevenLabsApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call an ElevenLabs GET endpoint.', 'icon' => 'ph:terminal-window'],
            'elevenlabs_api_post' => ['class' => ElevenLabsApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call an ElevenLabs POST endpoint.', 'icon' => 'ph:terminal-window'],
            'elevenlabs_api_delete' => ['class' => ElevenLabsApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call an ElevenLabs DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/elevenlabs.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.elevenlabs.io/v1'],
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
     * Resolve the ElevenLabs service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Contextual data.
     */
    private function resolveService(array $context = []): ElevenLabsService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $apiKey = $creds->get('elevenlabs', 'api_key', '', $account)
                ?: $creds->get('eleven-labs', 'api_key', '', $account);
            $baseUrl = $creds->get('elevenlabs', 'url', '', $account)
                ?: $creds->get('eleven-labs', 'url', 'https://api.elevenlabs.io/v1', $account);

            return new ElevenLabsService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );
        }

        return app(ElevenLabsService::class);
    }
}
