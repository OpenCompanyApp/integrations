<?php

namespace OpenCompany\Integrations\Moosend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Moosend\Tools\MoosendListMailingLists;
use OpenCompany\Integrations\Moosend\Tools\MoosendGetMailingList;
use OpenCompany\Integrations\Moosend\Tools\MoosendCreateMailingList;
use OpenCompany\Integrations\Moosend\Tools\MoosendListSubscribers;
use OpenCompany\Integrations\Moosend\Tools\MoosendAddSubscriber;
use OpenCompany\Integrations\Moosend\Tools\MoosendListCampaigns;
use OpenCompany\Integrations\Moosend\Tools\MoosendGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MoosendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     *
     * @return string
     */
    public function appName(): string
    {
        return 'moosend';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Moosend',
            'description' => 'Moosend integration for Laravel — manage mailing lists, subscribers, and campaigns.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Moosend',
            'description' => 'Moosend integration for Laravel — manage mailing lists, subscribers, and campaigns.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the Moosend integration.
     *
     * @return array
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Moosend API key',
                'hint' => 'Find your API key in your Moosend account under Settings > API Key',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Moosend API using the provided configuration.
     *
     * @param array $config The configuration array containing the API key.
     * @return array Result array with 'success' boolean and optional 'message' or 'error'.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.moosend.com/v3/users/me.json?apikey=' . urlencode($apiKey));

            $json = $response->json();

            if ($response->successful() && isset($json['Error']) && $json['Error'] === null) {
                return [
                    'success' => true,
                    'message' => 'Connected to Moosend API successfully.',
                ];
            }

            $error = $json['Error'] ?? $response->body();

            return [
                'success' => false,
                'error' => is_string($error) ? $error : json_encode($error),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the Moosend configuration.
     *
     * @return array
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by the Moosend integration.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            'moosend_list_mailing_lists' => [
                'class' => MoosendListMailingLists::class,
                'type' => 'read',
                'name' => 'List Mailing Lists',
                'description' => 'List all mailing lists in your Moosend account.',
                'icon' => 'ph:list-bullets',
            ],
            'moosend_get_mailing_list' => [
                'class' => MoosendGetMailingList::class,
                'type' => 'read',
                'name' => 'Get Mailing List',
                'description' => 'Get details for a specific mailing list.',
                'icon' => 'ph:list',
            ],
            'moosend_create_mailing_list' => [
                'class' => MoosendCreateMailingList::class,
                'type' => 'write',
                'name' => 'Create Mailing List',
                'description' => 'Create a new mailing list in Moosend.',
                'icon' => 'ph:plus-circle',
            ],
            'moosend_list_subscribers' => [
                'class' => MoosendListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers for a specific mailing list.',
                'icon' => 'ph:users',
            ],
            'moosend_add_subscriber' => [
                'class' => MoosendAddSubscriber::class,
                'type' => 'write',
                'name' => 'Add Subscriber',
                'description' => 'Add a subscriber to a mailing list.',
                'icon' => 'ph:user-plus',
            ],
            'moosend_list_campaigns' => [
                'class' => MoosendListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all campaigns in your Moosend account.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'moosend_get_current_user' => [
                'class' => MoosendGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user (health check).',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     *
     * @return string|null
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/moosend.md';
    }

    /**
     * Get the credential fields required for the Moosend integration.
     *
     * @return array
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Determine whether this provider is an integration.
     *
     * @return bool
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service context.
     *
     * @param string $class   The fully-qualified tool class name.
     * @param array  $context Optional context array containing account information.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MoosendService(
                apiKey: $creds->get('moosend', 'api_key', '', $account),
                baseUrl: 'https://api.moosend.com/v3',
            );

            return new $class($service);
        }

        return new $class(app(MoosendService::class));
    }
}
