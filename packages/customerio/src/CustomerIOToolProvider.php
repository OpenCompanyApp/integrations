<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOIdentifyCustomer;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOTrackEvent;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOListSegments;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOListCampaigns;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOGetCampaign;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOListNewsletters;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOGetCurrentUser;

class CustomerIOToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'customerio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'identify, events, segments, campaigns, newsletters',
            'description' => 'Customer engagement platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:customerio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Customer.io',
            'description' => 'Customer engagement platform for email, SMS, and push notifications',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:customerio',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://customer.io/docs/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Customer.io API key',
                'hint' => 'Find your API key in Customer.io under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.customer.io/v1',
                'hint' => 'Use <code>https://api.customer.io/v1</code> for the standard API',
                'default' => 'https://api.customer.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.customer.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid API key. Please check your Customer.io API key.',
                ];
            }

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Customer.io API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "Customer.io API returned HTTP {$response->status()}.",
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
            'customerio_identify_customer' => [
                'class' => CustomerIOIdentifyCustomer::class,
                'type' => 'write',
                'name' => 'Identify Customer',
                'description' => 'Create or update a customer profile in Customer.io.',
                'icon' => 'ph:user-plus',
            ],
            'customerio_track_event' => [
                'class' => CustomerIOTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track a custom event for a customer.',
                'icon' => 'ph:lightning',
            ],
            'customerio_list_segments' => [
                'class' => CustomerIOListSegments::class,
                'type' => 'read',
                'name' => 'List Segments',
                'description' => 'List all segments in the workspace.',
                'icon' => 'ph:users-three',
            ],
            'customerio_list_campaigns' => [
                'class' => CustomerIOListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all campaigns in the workspace.',
                'icon' => 'ph:megaphone',
            ],
            'customerio_get_campaign' => [
                'class' => CustomerIOGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific campaign.',
                'icon' => 'ph:megaphone',
            ],
            'customerio_list_newsletters' => [
                'class' => CustomerIOListNewsletters::class,
                'type' => 'read',
                'name' => 'List Newsletters',
                'description' => 'List all newsletters in the workspace.',
                'icon' => 'ph:envelope',
            ],
            'customerio_get_current_user' => [
                'class' => CustomerIOGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user and account information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/customerio.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.customer.io/v1'],
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

            $service = new CustomerIOService(
                apiKey: $creds->get('customerio', 'api_key', '', $account),
                baseUrl: $creds->get('customerio', 'url', 'https://api.customer.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CustomerIOService::class));
    }
}
