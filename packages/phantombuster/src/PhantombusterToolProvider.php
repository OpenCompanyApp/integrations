<?php

namespace OpenCompany\Integrations\Phantombuster;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListAgents;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterLaunchAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetContainer;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListContainers;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetCurrentUser;

class PhantombusterToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'phantombuster';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'agents, launch, containers',
            'description' => 'Automation & scraping',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:phantombuster',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Phantombuster',
            'description' => 'Automated lead generation and web scraping platform',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:phantombuster',
            'category' => 'automation',
            'badge' => 'verified',
            'docs_url' => 'https://docs.phantombuster.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Phantombuster API key',
                'hint' => 'Find your API key in Phantombuster under <strong>Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.phantombuster.com/api/v2',
                'hint' => 'Override only if using a custom endpoint. Default: <code>https://api.phantombuster.com/api/v2</code>',
                'default' => 'https://api.phantombuster.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.phantombuster.com/api/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Phantombuster-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Phantombuster API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Phantombuster API as {$json['email']}.",
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
            'phantombuster_list_agents' => [
                'class' => PhantombusterListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List all Phantombuster agents in your account.',
                'icon' => 'ph:list',
            ],
            'phantombuster_get_agent' => [
                'class' => PhantombusterGetAgent::class,
                'type' => 'read',
                'name' => 'Get Agent',
                'description' => 'Get details for a specific Phantombuster agent.',
                'icon' => 'ph:robot',
            ],
            'phantombuster_launch_agent' => [
                'class' => PhantombusterLaunchAgent::class,
                'type' => 'write',
                'name' => 'Launch Agent',
                'description' => 'Launch a Phantombuster agent to start an automation.',
                'icon' => 'ph:play',
            ],
            'phantombuster_list_containers' => [
                'class' => PhantombusterListContainers::class,
                'type' => 'read',
                'name' => 'List Containers',
                'description' => 'List all Phantombuster containers (execution history).',
                'icon' => 'ph:list',
            ],
            'phantombuster_get_container' => [
                'class' => PhantombusterGetContainer::class,
                'type' => 'read',
                'name' => 'Get Container',
                'description' => 'Get details for a specific Phantombuster container.',
                'icon' => 'ph:cube',
            ],
            'phantombuster_get_current_user' => [
                'class' => PhantombusterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Phantombuster user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/phantombuster.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.phantombuster.com/api/v2'],
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

            $service = new PhantombusterService(
                apiKey: $creds->get('phantombuster', 'api_key', '', $account),
                baseUrl: $creds->get('phantombuster', 'url', 'https://api.phantombuster.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(PhantombusterService::class));
    }
}
