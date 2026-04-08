<?php

namespace OpenCompany\Integrations\Actively;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Actively\Tools\ActivelyListCampaigns;
use OpenCompany\Integrations\Actively\Tools\ActivelyGetCampaign;
use OpenCompany\Integrations\Actively\Tools\ActivelyCreateCampaign;
use OpenCompany\Integrations\Actively\Tools\ActivelyListContacts;
use OpenCompany\Integrations\Actively\Tools\ActivelyGetContact;
use OpenCompany\Integrations\Actively\Tools\ActivelyListOrganizations;
use OpenCompany\Integrations\Actively\Tools\ActivelyGetCurrentUser;

/**
 * Tool provider for the Actively CRM integration.
 *
 * Implements ConfigurableIntegration for multi-account support and provides
 * configuration schema, credential fields, validation rules, and a connection test.
 */
class ActivelyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the machine name for this integration.
     */
    public function appName(): string
    {
        return 'actively';
    }

    /**
     * Get metadata for the app selector UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, contacts, organizations',
            'description' => 'Sales CRM',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:actively',
        ];
    }

    /**
     * Get integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Actively',
            'description' => 'Sales CRM — manage campaigns, contacts, and organizations',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:actively',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://docs.actively.com/api',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Actively API access token',
                'hint' => 'Generate an access token in your Actively account settings under "API Access"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.actively.com',
                'hint' => 'Use <code>https://api.actively.com</code> for cloud, or your self-hosted URL',
                'default' => 'https://api.actively.com',
            ],
        ];
    }

    /**
     * Test the connection to the Actively API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.actively.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Actively API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Actively API returned HTTP {$response->status()}. Check your access token.",
                ];
            }

            $userName = $json['name'] ?? $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Actively API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'actively_list_organizations' => [
                'class' => ActivelyListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations you have access to.',
                'icon' => 'ph:buildings',
            ],
            'actively_get_current_user' => [
                'class' => ActivelyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
            'actively_list_campaigns' => [
                'class' => ActivelyListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List campaigns for an organization.',
                'icon' => 'ph:megaphone',
            ],
            'actively_get_campaign' => [
                'class' => ActivelyGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details of a specific campaign.',
                'icon' => 'ph:megaphone',
            ],
            'actively_create_campaign' => [
                'class' => ActivelyCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create a new campaign for an organization.',
                'icon' => 'ph:megaphone',
            ],
            'actively_list_contacts' => [
                'class' => ActivelyListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts for an organization.',
                'icon' => 'ph:address-book',
            ],
            'actively_get_contact' => [
                'class' => ActivelyGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:address-book',
            ],
        ];
    }

    /**
     * Get the path to the Lua docs file for agent-side documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/actively.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.actively.com'],
        ];
    }

    /**
     * Confirm this class represents an integration (not just standalone tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ActivelyService(
                accessToken: $creds->get('actively', 'access_token', '', $account),
                baseUrl: $creds->get('actively', 'url', 'https://api.actively.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ActivelyService::class));
    }
}
