<?php

namespace OpenCompany\Integrations\Lemlist;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lemlist\Tools\LemlistAddLead;
use OpenCompany\Integrations\Lemlist\Tools\LemlistGetCampaign;
use OpenCompany\Integrations\Lemlist\Tools\LemlistGetCurrentUser;
use OpenCompany\Integrations\Lemlist\Tools\LemlistListCampaigns;
use OpenCompany\Integrations\Lemlist\Tools\LemlistListLeads;
use OpenCompany\Integrations\Lemlist\Tools\LemlistListSubaccounts;
use OpenCompany\Integrations\Lemlist\Tools\LemlistListTeams;

/**
 * Tool provider for the Lemlist integration.
 *
 * Implements ConfigurableIntegration for multi-account support with
 * HTTP Basic auth (username + password).
 */
class LemlistToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the machine name for this integration.
     */
    public function appName(): string
    {
        return 'lemlist';
    }

    /**
     * Get short metadata for tool display (labels, icons).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, leads, teams',
            'description' => 'Email outreach & sales engagement',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:lemlist',
        ];
    }

    /**
     * Get full integration metadata for the UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Lemlist',
            'description' => 'Email outreach and sales engagement platform',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:lemlist',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.lemlist.com/',
        ];
    }

    /**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'username',
                'type' => 'string',
                'label' => 'Username',
                'placeholder' => 'Enter your Lemlist email or API username',
                'hint' => 'The email address associated with your Lemlist account',
                'required' => true,
            ],
            [
                'key' => 'password',
                'type' => 'secret',
                'label' => 'API Key / Password',
                'placeholder' => 'Enter your Lemlist API key',
                'hint' => 'Find your API key in Lemlist under Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.lemlist.com/api',
                'hint' => 'The Lemlist API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.lemlist.com/api',
            ],
        ];
    }

    /**
     * Test the connection to the Lemlist API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.lemlist.com/api', '/');

        if (empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Username and password are required'];
        }

        try {
            $response = Http::withBasicAuth($username, $password)
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Lemlist API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your credentials.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Lemlist API as {$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'lemlist_list_campaigns' => [
                'class' => LemlistListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all outreach campaigns.',
                'icon' => 'ph:envelope-simple',
            ],
            'lemlist_get_campaign' => [
                'class' => LemlistGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details of a specific campaign.',
                'icon' => 'ph:envelope-simple',
            ],
            'lemlist_list_leads' => [
                'class' => LemlistListLeads::class,
                'type' => 'read',
                'name' => 'List Leads',
                'description' => 'List leads in a campaign.',
                'icon' => 'ph:users',
            ],
            'lemlist_add_lead' => [
                'class' => LemlistAddLead::class,
                'type' => 'write',
                'name' => 'Add Lead',
                'description' => 'Add a lead to a campaign.',
                'icon' => 'ph:user-plus',
            ],
            'lemlist_list_teams' => [
                'class' => LemlistListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all teams in the account.',
                'icon' => 'ph:users-three',
            ],
            'lemlist_list_subaccounts' => [
                'class' => LemlistListSubaccounts::class,
                'type' => 'read',
                'name' => 'List Subaccounts',
                'description' => 'List all sub-accounts.',
                'icon' => 'ph:identification-badge',
            ],
            'lemlist_get_current_user' => [
                'class' => LemlistGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lemlist.md';
    }

    /**
     * Get the credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'API Key / Password', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.lemlist.com/api'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new LemlistService(
                username: $creds->get('lemlist', 'username', '', $account),
                password: $creds->get('lemlist', 'password', '', $account),
                baseUrl: $creds->get('lemlist', 'url', 'https://api.lemlist.com/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(LemlistService::class));
    }
}
