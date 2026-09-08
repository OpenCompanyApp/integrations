<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListVoices;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGenerateSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGenerateSound;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListModels;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
        return 'eleven-labs';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ElevenLabs',
            'description' => 'AI voice & sound generation',
            'icon' => 'ph:speaker-high',
            'logo' => 'simple-icons:elevenlabs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ElevenLabs',
            'description' => 'Legacy compatibility wrapper for ElevenLabs. Prefer the canonical elevenlabs package.',
            'icon' => 'ph:speaker-high',
            'logo' => 'simple-icons:elevenlabs',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://elevenlabs.io/docs/api-reference',
            'catalog_visibility' => 'hidden',
            'replacement' => 'elevenlabs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ElevenLabs API key',
                'hint' => 'Find your API key in your ElevenLabs account under <b>Profile > API Keys</b>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.elevenlabs.io',
                'hint' => 'Defaults to <code>https://api.elevenlabs.io</code>. Change only for custom endpoints.',
                'default' => 'https://api.elevenlabs.io',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.elevenlabs.io', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'xi-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach ElevenLabs API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => "API error: {$error}"];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: 'ElevenLabs';

            return [
                'success' => true,
                'message' => "Connected to ElevenLabs as {$name}.",
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
            'elevenlabs_list_voices' => [
                'class' => ElevenLabsListVoices::class,
                'type' => 'read',
                'name' => 'List Voices',
                'description' => 'List available ElevenLabs voices.',
                'icon' => 'ph:speaker-high',
            ],
            'elevenlabs_get_voice' => [
                'class' => ElevenLabsGetVoice::class,
                'type' => 'read',
                'name' => 'Get Voice',
                'description' => 'Get details for a specific voice.',
                'icon' => 'ph:speaker-high',
            ],
            'elevenlabs_generate_speech' => [
                'class' => ElevenLabsGenerateSpeech::class,
                'type' => 'write',
                'name' => 'Generate Speech',
                'description' => 'Generate speech audio from text using a voice.',
                'icon' => 'ph:waveform',
            ],
            'elevenlabs_generate_sound' => [
                'class' => ElevenLabsGenerateSound::class,
                'type' => 'write',
                'name' => 'Generate Sound',
                'description' => 'Generate a sound effect from a text prompt.',
                'icon' => 'ph:music-note',
            ],
            'elevenlabs_list_models' => [
                'class' => ElevenLabsListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available ElevenLabs models.',
                'icon' => 'ph:cube',
            ],
            'elevenlabs_get_current_user' => [
                'class' => ElevenLabsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user info and subscription details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/eleven-labs.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.elevenlabs.io'],
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

            $service = new ElevenLabsService(
                apiKey: $creds->get('eleven-labs', 'api_key', '', $account),
                baseUrl: $creds->get('eleven-labs', 'url', 'https://api.elevenlabs.io', $account),
            );

            return new $class($service);
        }

        return new $class(app(ElevenLabsService::class));
    }
}
