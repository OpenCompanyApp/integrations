<?php

namespace OpenCompany\Integrations\Runpod;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Runpod\Tools\RunpodListPods;
use OpenCompany\Integrations\Runpod\Tools\RunpodGetPod;
use OpenCompany\Integrations\Runpod\Tools\RunpodListTemplates;
use OpenCompany\Integrations\Runpod\Tools\RunpodListNetworkVolumes;
use OpenCompany\Integrations\Runpod\Tools\RunpodListEndpoints;
use OpenCompany\Integrations\Runpod\Tools\RunpodListServerless;
use OpenCompany\Integrations\Runpod\Tools\RunpodGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RunpodToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'runpod';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'RunPod',
            'description' => 'GPU cloud computing',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:runpod',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'RunPod',
            'description' => 'GPU cloud platform for AI/ML workloads, serverless endpoints, and GPU pods',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:runpod',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.runpod.io',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your RunPod API key',
                'hint' => 'Generate an API key in your RunPod settings at <a href="https://www.runpod.io/console/user/settings" target="_blank">runpod.io</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.runpod.io/v1',
                'hint' => 'The RunPod API base URL. Use <code>https://api.runpod.io/v1</code> unless you have a custom endpoint.',
                'default' => 'https://api.runpod.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.runpod.io/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach RunPod API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['firstName'] ?? ($json['username'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to RunPod API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'runpod_list_pods' => [
                'class' => RunpodListPods::class,
                'type' => 'read',
                'name' => 'List Pods',
                'description' => 'List all GPU pods in your RunPod account.',
                'icon' => 'ph:cube',
            ],
            'runpod_get_pod' => [
                'class' => RunpodGetPod::class,
                'type' => 'read',
                'name' => 'Get Pod',
                'description' => 'Get details of a specific RunPod GPU pod.',
                'icon' => 'ph:cube-focus',
            ],
            'runpod_list_templates' => [
                'class' => RunpodListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List all available RunPod templates.',
                'icon' => 'ph:copy',
            ],
            'runpod_list_network_volumes' => [
                'class' => RunpodListNetworkVolumes::class,
                'type' => 'read',
                'name' => 'List Network Volumes',
                'description' => 'List all network volumes in your RunPod account.',
                'icon' => 'ph:hard-drives',
            ],
            'runpod_list_endpoints' => [
                'class' => RunpodListEndpoints::class,
                'type' => 'read',
                'name' => 'List Endpoints',
                'description' => 'List all RunPod endpoints.',
                'icon' => 'ph:link',
            ],
            'runpod_list_serverless' => [
                'class' => RunpodListServerless::class,
                'type' => 'read',
                'name' => 'List Serverless',
                'description' => 'List all serverless endpoints in your RunPod account.',
                'icon' => 'ph:lightning',
            ],
            'runpod_get_current_user' => [
                'class' => RunpodGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated RunPod user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/runpod.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.runpod.io/v1'],
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

            $service = new RunpodService(
                accessToken: $creds->get('runpod', 'access_token', '', $account),
                baseUrl: $creds->get('runpod', 'url', 'https://api.runpod.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RunpodService::class));
    }
}
