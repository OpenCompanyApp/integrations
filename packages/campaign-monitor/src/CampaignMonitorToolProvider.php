<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListCampaigns;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorGetCampaign;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListLists;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorGetList;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListSubscribers;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorAddSubscriber;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CampaignMonitorToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'campaign-monitor';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, lists, subscribers',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:campaignmonitor',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Campaign Monitor',
            'description' => 'Email marketing and campaign management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:campaignmonitor',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://www.campaignmonitor.com/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Campaign Monitor API key',
                'hint' => 'Find your API key in your Campaign Monitor account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.createsend.com/api/v3.3',
                'hint' => 'The Campaign Monitor API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.createsend.com/api/v3.3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.createsend.com/api/v3.3', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/primarycontact');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Campaign Monitor API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Campaign Monitor API as {$json['EmailAddress']}.",
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
            'campaignmonitor_list_campaigns' => [
                'class' => CampaignMonitorListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all email campaigns.',
                'icon' => 'ph:envelope',
            ],
            'campaignmonitor_get_campaign' => [
                'class' => CampaignMonitorGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific campaign.',
                'icon' => 'ph:envelope',
            ],
            'campaignmonitor_list_lists' => [
                'class' => CampaignMonitorListLists::class,
                'type' => 'read',
                'name' => 'List Subscriber Lists',
                'description' => 'List all subscriber lists.',
                'icon' => 'ph:list',
            ],
            'campaignmonitor_get_list' => [
                'class' => CampaignMonitorGetList::class,
                'type' => 'read',
                'name' => 'Get Subscriber List',
                'description' => 'Get details for a specific subscriber list.',
                'icon' => 'ph:list',
            ],
            'campaignmonitor_list_subscribers' => [
                'class' => CampaignMonitorListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List active subscribers on a list.',
                'icon' => 'ph:users',
            ],
            'campaignmonitor_add_subscriber' => [
                'class' => CampaignMonitorAddSubscriber::class,
                'type' => 'write',
                'name' => 'Add Subscriber',
                'description' => 'Add a subscriber to a list.',
                'icon' => 'ph:user-plus',
            ],
            'campaignmonitor_get_current_user' => [
                'class' => CampaignMonitorGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/campaign-monitor.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.createsend.com/api/v3.3'],
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

            $service = new CampaignMonitorService(
                apiKey: $creds->get('campaign-monitor', 'api_key', '', $account),
                baseUrl: $creds->get('campaign-monitor', 'url', 'https://api.createsend.com/api/v3.3', $account),
            );

            return new $class($service);
        }

        return new $class(app(CampaignMonitorService::class));
    }
}
