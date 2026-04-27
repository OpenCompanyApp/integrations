<?php

namespace OpenCompany\Integrations\Drip;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Drip\Tools\DripListCampaigns;
use OpenCompany\Integrations\Drip\Tools\DripGetCampaign;
use OpenCompany\Integrations\Drip\Tools\DripListSubscribers;
use OpenCompany\Integrations\Drip\Tools\DripGetSubscriber;
use OpenCompany\Integrations\Drip\Tools\DripListWorkflows;
use OpenCompany\Integrations\Drip\Tools\DripGetWorkflow;
use OpenCompany\Integrations\Drip\Tools\DripGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DripToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'drip';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'subscribers, campaigns, workflows',
            'description' => 'Email marketing automation',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:drip',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Drip',
            'description' => 'Email marketing automation platform — manage subscribers, campaigns, and workflows',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:drip',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.drip.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Drip API key',
                'hint' => 'Find your API token in Drip under Settings → Account → Advanced Settings → API Endpoints',
                'required' => true,
            ],
            [
                'key' => 'account_id',
                'type' => 'string',
                'label' => 'Account ID',
                'placeholder' => 'Enter your Drip account ID',
                'hint' => 'Find your Account ID in Drip under Settings → Account → General. It is the numeric ID in the URL when logged in.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getdrip.com',
                'hint' => 'Defaults to <code>https://api.getdrip.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.getdrip.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getdrip.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Drip API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Drip API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'account_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'drip_list_campaigns' => [
                'class' => DripListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List email campaigns in your Drip account.',
                'icon' => 'ph:envelope',
            ],
            'drip_get_campaign' => [
                'class' => DripGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Fetch a single email campaign by ID.',
                'icon' => 'ph:envelope',
            ],
            'drip_list_subscribers' => [
                'class' => DripListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers in your Drip account.',
                'icon' => 'ph:users',
            ],
            'drip_get_subscriber' => [
                'class' => DripGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Fetch a single subscriber by ID or email.',
                'icon' => 'ph:user',
            ],
            'drip_list_workflows' => [
                'class' => DripListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List workflows in your Drip account.',
                'icon' => 'ph:flow-arrow',
            ],
            'drip_get_workflow' => [
                'class' => DripGetWorkflow::class,
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Fetch a single workflow by ID.',
                'icon' => 'ph:flow-arrow',
            ],
            'drip_get_current_user' => [
                'class' => DripGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Drip user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/drip.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'account_id', 'type' => 'string', 'label' => 'Account ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Drip API URL', 'required' => false, 'default' => 'https://api.getdrip.com'],
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

            $service = new DripService(
                apiKey: $creds->get('drip', 'api_key', '', $account),
                accountId: $creds->get('drip', 'account_id', '', $account),
                baseUrl: $creds->get('drip', 'url', 'https://api.getdrip.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(DripService::class));
    }
}
