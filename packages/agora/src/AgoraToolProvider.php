<?php

namespace OpenCompany\Integrations\Agora;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Agora\Tools\AgoraListProjects;
use OpenCompany\Integrations\Agora\Tools\AgoraGetProject;
use OpenCompany\Integrations\Agora\Tools\AgoraCreateProject;
use OpenCompany\Integrations\Agora\Tools\AgoraListRecordings;
use OpenCompany\Integrations\Agora\Tools\AgoraGetRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraStartRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AgoraToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'agora';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, recordings, users',
            'description' => 'Real-time communication and recordings',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:agora',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Agora',
            'description' => 'Real-time communication platform with voice, video, and recording capabilities',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:agora',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.agora.io/en/reference/rest-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Agora API key',
                'hint' => 'Find your API key in the Agora Console under Project Management.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.agora.io/v1',
                'hint' => 'Defaults to <code>https://api.agora.io/v1</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.agora.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.agora.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/projects');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Agora API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Agora API returned an error: {$error}",
                ];
            }

            $projectCount = count($json['data'] ?? $json['projects'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Agora API successfully (found {$projectCount} project(s)).",
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
            'agora_list_projects' => [
                'class' => AgoraListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Agora projects.',
                'icon' => 'ph:folder',
            ],
            'agora_get_project' => [
                'class' => AgoraGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'agora_create_project' => [
                'class' => AgoraCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new Agora project.',
                'icon' => 'ph:plus-circle',
            ],
            'agora_list_recordings' => [
                'class' => AgoraListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List recordings with optional filters.',
                'icon' => 'ph:record',
            ],
            'agora_get_recording' => [
                'class' => AgoraGetRecording::class,
                'type' => 'read',
                'name' => 'Get Recording',
                'description' => 'Get details of a specific recording.',
                'icon' => 'ph:record',
            ],
            'agora_start_recording' => [
                'class' => AgoraStartRecording::class,
                'type' => 'write',
                'name' => 'Start Recording',
                'description' => 'Start a cloud recording.',
                'icon' => 'ph:record-fill',
            ],
            'agora_get_current_user' => [
                'class' => AgoraGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Agora user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/agora.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.agora.io/v1'],
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

            $service = new AgoraService(
                apiKey: $creds->get('agora', 'api_key', '', $account),
                baseUrl: $creds->get('agora', 'url', 'https://api.agora.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AgoraService::class));
    }
}
