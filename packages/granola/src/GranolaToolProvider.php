<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Granola\Tools\GranolaListMeetings;
use OpenCompany\Integrations\Granola\Tools\GranolaGetMeeting;
use OpenCompany\Integrations\Granola\Tools\GranolaCreateNote;
use OpenCompany\Integrations\Granola\Tools\GranolaShareMeeting;
use OpenCompany\Integrations\Granola\Tools\GranolaGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GranolaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'granola';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Granola',
            'description' => 'AI meeting notes',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:granola',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Granola',
            'description' => 'AI-powered meeting notes and transcripts',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:granola',
            'category' => 'meetings',
            'badge' => 'verified',
            'docs_url' => 'https://granola.ai/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Granola API key',
                'hint' => 'Generate an API key in your Granola account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.granola.ai/v1',
                'hint' => 'Override only if using a custom Granola instance',
                'default' => 'https://api.granola.ai/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.granola.ai/v1', '/');

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
                    'error' => "Could not reach Granola API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['name'] ?? $json['email'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to Granola API as {$userName}.",
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
            'granola_list_meetings' => [
                'class' => GranolaListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List recent meetings with optional search and filtering.',
                'icon' => 'ph:calendar',
            ],
            'granola_get_meeting' => [
                'class' => GranolaGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get a single meeting with full transcript and notes.',
                'icon' => 'ph:notebook',
            ],
            'granola_create_note' => [
                'class' => GranolaCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note on a meeting.',
                'icon' => 'ph:note-pencil',
            ],
            'granola_share_meeting' => [
                'class' => GranolaShareMeeting::class,
                'type' => 'write',
                'name' => 'Share Meeting',
                'description' => 'Share a meeting with others.',
                'icon' => 'ph:share',
            ],
            'granola_get_current_user' => [
                'class' => GranolaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/granola.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.granola.ai/v1'],
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

            $service = new GranolaService(
                apiKey: $creds->get('granola', 'api_key', '', $account),
                baseUrl: $creds->get('granola', 'url', 'https://api.granola.ai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GranolaService::class));
    }
}
