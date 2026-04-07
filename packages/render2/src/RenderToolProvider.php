<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Render2\Tools\RenderCreateService;
use OpenCompany\Integrations\Render2\Tools\RenderGetCurrentUser;
use OpenCompany\Integrations\Render2\Tools\RenderGetDeploy;
use OpenCompany\Integrations\Render2\Tools\RenderGetService;
use OpenCompany\Integrations\Render2\Tools\RenderListDeploys;
use OpenCompany\Integrations\Render2\Tools\RenderListJobs;
use OpenCompany\Integrations\Render2\Tools\RenderListServices;

class RenderToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'render2';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'services, deploys, jobs',
            'description' => 'Cloud platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:render',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Render',
            'description' => 'Cloud platform — deploy web services, background workers, cron jobs, and databases',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:render',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api-docs.render.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Render API key',
                'hint' => 'Generate an API key in the Render dashboard under <strong>Account Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.render.com/v1',
                'hint' => 'Override only if using a custom Render-compatible endpoint',
                'default' => 'https://api.render.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.render.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/owners/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Render API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Render API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Render as {$email}.",
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
            'render_list_services' => [
                'class' => RenderListServices::class,
                'type' => 'read',
                'name' => 'List Services',
                'description' => 'List all services in the Render account.',
                'icon' => 'ph:server',
            ],
            'render_get_service' => [
                'class' => RenderGetService::class,
                'type' => 'read',
                'name' => 'Get Service',
                'description' => 'Get details for a specific Render service.',
                'icon' => 'ph:server',
            ],
            'render_create_service' => [
                'class' => RenderCreateService::class,
                'type' => 'write',
                'name' => 'Create Service',
                'description' => 'Create a new service on Render.',
                'icon' => 'ph:plus-circle',
            ],
            'render_list_deploys' => [
                'class' => RenderListDeploys::class,
                'type' => 'read',
                'name' => 'List Deploys',
                'description' => 'List deploys for a Render service.',
                'icon' => 'ph:rocket',
            ],
            'render_get_deploy' => [
                'class' => RenderGetDeploy::class,
                'type' => 'read',
                'name' => 'Get Deploy',
                'description' => 'Get details for a specific deploy.',
                'icon' => 'ph:rocket',
            ],
            'render_list_jobs' => [
                'class' => RenderListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List jobs for a Render service.',
                'icon' => 'ph:briefcase',
            ],
            'render_get_current_user' => [
                'class' => RenderGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/render2.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.render.com/v1'],
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

            $service = new RenderService(
                apiKey: $creds->get('render2', 'api_key', '', $account),
                baseUrl: $creds->get('render2', 'url', 'https://api.render.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RenderService::class));
    }
}
