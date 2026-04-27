<?php

namespace OpenCompany\Integrations\Gorgias;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasListTickets;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasGetTicket;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasCreateTicket;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasListCustomers;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasGetCustomer;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasListSatisfactionSurveys;
use OpenCompany\Integrations\Gorgias\Tools\GorgiasGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GorgiasToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'gorgias';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tickets, customers, satisfaction surveys',
            'description' => 'Customer support platform',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:gorgias',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Gorgias',
            'description' => 'Customer support platform — manage tickets, customers, and satisfaction surveys',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:gorgias',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.gorgias.com/reference/introduction',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Gorgias API token',
                'hint' => 'Generate an API token in Gorgias under Settings → REST API → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.gorgias.com/v1',
                'hint' => 'Use the default <code>https://api.gorgias.com/v1</code> unless using a custom API endpoint',
                'default' => 'https://api.gorgias.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.gorgias.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gorgias API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = trim(($json['firstname'] ?? '') . ' ' . ($json['lastname'] ?? '')) ?: ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to Gorgias API as {$name}.",
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
            'gorgias_list_tickets' => [
                'class' => GorgiasListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List and search support tickets in Gorgias.',
                'icon' => 'ph:list-dashes',
            ],
            'gorgias_get_ticket' => [
                'class' => GorgiasGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get details of a specific ticket.',
                'icon' => 'ph:ticket',
            ],
            'gorgias_create_ticket' => [
                'class' => GorgiasCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new support ticket.',
                'icon' => 'ph:plus-circle',
            ],
            'gorgias_list_customers' => [
                'class' => GorgiasListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List and search customers in Gorgias.',
                'icon' => 'ph:users',
            ],
            'gorgias_get_customer' => [
                'class' => GorgiasGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details of a specific customer.',
                'icon' => 'ph:user',
            ],
            'gorgias_list_satisfaction_surveys' => [
                'class' => GorgiasListSatisfactionSurveys::class,
                'type' => 'read',
                'name' => 'List Satisfaction Surveys',
                'description' => 'List satisfaction survey responses.',
                'icon' => 'ph:star',
            ],
            'gorgias_get_current_user' => [
                'class' => GorgiasGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gorgias.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.gorgias.com/v1'],
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

            $service = new GorgiasService(
                accessToken: $creds->get('gorgias', 'access_token', '', $account),
                baseUrl: $creds->get('gorgias', 'url', 'https://api.gorgias.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GorgiasService::class));
    }
}
