<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsTextToSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListVoices;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsCreateVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsDeleteVoice;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetModels;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetHistory;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
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




/**
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'elevenlabs';
    }

/**
     * Short metadata shown in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'text-to-speech, voices, models, history',
            'description' => 'AI Text-to-Speech',
            'icon'        => 'ph:speaker-high',
            'logo'        => 'simple-icons:elevenlabs',
        ];
    }

/**
     * Metadata shown on the integration catalog / settings page.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'ElevenLabs',
            'description' => 'AI-powered text-to-speech and voice cloning',
            'icon'        => 'ph:speaker-high',
            'logo'        => 'simple-icons:elevenlabs',
            'category'    => 'ai',
            'badge'       => 'verified',
            'docs_url'    => 'https://elevenlabs.io/docs/api-reference',
        ];
    }/**
     * Configuration schema for the integration settings form.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_key',
                'type'        => 'secret',
                'label'       => 'API Key',
                'placeholder' => 'Enter your ElevenLabs API key',
                'hint'        => 'Find your API key in your <a href="https://elevenlabs.io/app/settings/api-keys" target="_blank">ElevenLabs account settings</a>',
                'required'    => true,
            ],
        ];
    }

    /**
     * Verify the API key by fetching the current user.
     *
     * @param array<string, mixed> $config Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'xi-api-key'     => $apiKey,
                'Content-Type'   => 'application/json',
            ])->timeout(10)->get('https://api.elevenlabs.io/v1/user');

            if (!$response->successful()) {
                $error = $response->json('detail.message') ?? $response->body();
                return [
                    'success' => false,
                    'error'   => 'API returned HTTP ' . $response->status() . ': ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $data = $response->json();
            $firstName = $data['first_name'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to ElevenLabs API" . ($firstName ? " as {$firstName}" : '') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Register all ElevenLabs tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'elevenlabs_text_to_speech' => [
                'class'       => ElevenLabsTextToSpeech::class,
                'type'        => 'write',
                'name'        => 'Text to Speech',
                'description' => 'Convert text to speech audio using a specific voice.',
                'icon'        => 'ph:speaker-high',
            ],
            'elevenlabs_list_voices' => [
                'class'       => ElevenLabsListVoices::class,
                'type'        => 'read',
                'name'        => 'List Voices',
                'description' => 'List all available voices.',
                'icon'        => 'ph:microphone',
            ],
            'elevenlabs_get_voice' => [
                'class'       => ElevenLabsGetVoice::class,
                'type'        => 'read',
                'name'        => 'Get Voice',
                'description' => 'Get details for a specific voice.',
                'icon'        => 'ph:microphone',
            ],
            'elevenlabs_create_voice' => [
                'class'       => ElevenLabsCreateVoice::class,
                'type'        => 'write',
                'name'        => 'Create Voice',
                'description' => 'Create a new cloned voice.',
                'icon'        => 'ph:plus-circle',
            ],
            'elevenlabs_delete_voice' => [
                'class'       => ElevenLabsDeleteVoice::class,
                'type'        => 'write',
                'name'        => 'Delete Voice',
                'description' => 'Delete a voice by ID.',
                'icon'        => 'ph:trash',
            ],
            'elevenlabs_get_models' => [
                'class'       => ElevenLabsGetModels::class,
                'type'        => 'read',
                'name'        => 'Get Models',
                'description' => 'List all available TTS models.',
                'icon'        => 'ph:cube',
            ],
            'elevenlabs_get_history' => [
                'class'       => ElevenLabsGetHistory::class,
                'type'        => 'read',
                'name'        => 'Get History',
                'description' => 'Browse generation history.',
                'icon'        => 'ph:clock-counter-clockwise',
            ],
            'elevenlabs_get_current_user' => [
                'class'       => ElevenLabsGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get current user info and subscription details.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/elevenlabs.md';
    }

    /**
     * Credential fields for quick-setup / minimal config.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Instantiate a tool class with the correct service instance.
     *
     * Supports multi-account: when an `account` key is present in
     * `$context`, credentials are resolved for that specific account.
     *
     * @param class-string<Tool> $class   Fully-qualified tool class name.
     * @param array<string, mixed> $context Contextual data (optional `account` key).
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ElevenLabsService(
                apiKey: $creds->get('elevenlabs', 'api_key', '', $account),
                baseUrl: $creds->get('elevenlabs', 'url', 'https://api.elevenlabs.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ElevenLabsService::class));
    }
}
