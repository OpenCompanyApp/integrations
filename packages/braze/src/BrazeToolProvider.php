<?php

namespace OpenCompany\Integrations\Braze;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCampaign;
use OpenCompany\Integrations\Braze\Tools\BrazeListCanvases;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCanvas;
use OpenCompany\Integrations\Braze\Tools\BrazeListUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeGetUser;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCurrentUser;

/**
 * Braze tool provider implementing ConfigurableIntegration for multi-account support.
 *
 * Registers 7 tools for interacting with the Braze marketing platform:
 * campaigns, canvases, and user data export.
 */
class BrazeToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'braze';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, canvases, users',
            'description' => 'Marketing automation',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:braze',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Braze',
            'description' => 'Lifecycle engagement platform for marketing, CRM, and customer data',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:braze',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://www.braze.com/docs/api/basics/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Braze REST API key',
                'hint' => 'Generate a REST API key in your Braze dashboard under "Developer Console" > "API Settings"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'REST API Endpoint',
                'placeholder' => 'https://rest.iad-01.braze.com',
                'hint' => 'Your Braze REST endpoint depends on your instance region. Find it in "Developer Console" > "API Settings"',
                'default' => 'https://rest.iad-01.braze.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://rest.iad-01.braze.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/campaigns/list', [
                'limit' => 1,
                'page' => 0,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Braze API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Braze API at {$baseUrl}.",
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
            'braze_list_campaigns' => [
                'class' => BrazeListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List marketing campaigns from Braze.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_campaign' => [
                'class' => BrazeGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific Braze campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_canvases' => [
                'class' => BrazeListCanvases::class,
                'type' => 'read',
                'name' => 'List Canvases',
                'description' => 'List canvases from Braze.',
                'icon' => 'ph:flow-arrow',
            ],
            'braze_get_canvas' => [
                'class' => BrazeGetCanvas::class,
                'type' => 'read',
                'name' => 'Get Canvas',
                'description' => 'Get details for a specific Braze canvas.',
                'icon' => 'ph:flow-arrow',
            ],
            'braze_list_users' => [
                'class' => BrazeListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'Export a list of users from Braze by segment or IDs.',
                'icon' => 'ph:users',
            ],
            'braze_get_user' => [
                'class' => BrazeGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a single user profile from Braze by external ID.',
                'icon' => 'ph:user',
            ],
            'braze_get_current_user' => [
                'class' => BrazeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Braze user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/braze.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'REST API Endpoint', 'required' => false, 'default' => 'https://rest.iad-01.braze.com'],
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

            $service = new BrazeService(
                apiKey: $creds->get('braze', 'api_key', '', $account),
                baseUrl: $creds->get('braze', 'url', 'https://rest.iad-01.braze.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(BrazeService::class));
    }
}
