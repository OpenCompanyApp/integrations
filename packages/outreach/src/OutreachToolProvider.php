<?php

namespace OpenCompany\Integrations\Outreach;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Outreach\Tools\OutreachListProspects;
use OpenCompany\Integrations\Outreach\Tools\OutreachGetProspect;
use OpenCompany\Integrations\Outreach\Tools\OutreachCreateProspect;
use OpenCompany\Integrations\Outreach\Tools\OutreachListSequences;
use OpenCompany\Integrations\Outreach\Tools\OutreachGetSequence;
use OpenCompany\Integrations\Outreach\Tools\OutreachListAccounts;
use OpenCompany\Integrations\Outreach\Tools\OutreachGetCurrentUser;

class OutreachToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     *
     * @return string The app name used for credential resolution.
     */
    public function appName(): string
    {
        return 'outreach';
    }

    /**
     * Get application metadata for display and categorization.
     *
     * @return array Meta information about the Outreach integration.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'prospects, sequences, accounts',
            'description' => 'Sales engagement platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:outreach',
        ];
    }

    /**
     * Get integration metadata for the marketplace/config UI.
     *
     * @return array Integration details including name, category, and documentation URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Outreach',
            'description' => 'Sales engagement platform for managing prospects, sequences, and accounts.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:outreach',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://api.outreach.io/api/v2/docs',
        ];
    }

    /**
     * Get the configuration schema for the Outreach integration.
     *
     * @return array List of configuration field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Outreach access token',
                'hint' => 'Generate an OAuth2 access token from your Outreach developer settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.outreach.io/api/v2',
                'hint' => 'Use <code>https://api.outreach.io/api/v2</code> for the default Outreach API.',
                'default' => 'https://api.outreach.io/api/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Outreach API by fetching the current user.
     *
     * @param  array $config The integration configuration (access_token, url).
     * @return array Result array with 'success' bool and optional 'message' or 'error'.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.outreach.io/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Outreach API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['errors'][0]['detail'] ?? "HTTP {$response->status()}";
                return ['success' => false, 'error' => "Outreach API error: {$error}"];
            }

            return [
                'success' => true,
                'message' => "Connected to Outreach API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array Associative array of tool key => tool metadata.
     */
    public function tools(): array
    {
        return [
            'outreach_list_prospects' => [
                'class' => OutreachListProspects::class,
                'type' => 'read',
                'name' => 'List Prospects',
                'description' => 'List prospects in Outreach with filtering and pagination.',
                'icon' => 'ph:users',
            ],
            'outreach_get_prospect' => [
                'class' => OutreachGetProspect::class,
                'type' => 'read',
                'name' => 'Get Prospect',
                'description' => 'Get a single prospect by ID.',
                'icon' => 'ph:user',
            ],
            'outreach_create_prospect' => [
                'class' => OutreachCreateProspect::class,
                'type' => 'write',
                'name' => 'Create Prospect',
                'description' => 'Create a new prospect in Outreach.',
                'icon' => 'ph:user-plus',
            ],
            'outreach_list_sequences' => [
                'class' => OutreachListSequences::class,
                'type' => 'read',
                'name' => 'List Sequences',
                'description' => 'List sales sequences in Outreach.',
                'icon' => 'ph:list-bullets',
            ],
            'outreach_get_sequence' => [
                'class' => OutreachGetSequence::class,
                'type' => 'read',
                'name' => 'Get Sequence',
                'description' => 'Get a single sequence by ID.',
                'icon' => 'ph:list-bullets',
            ],
            'outreach_list_accounts' => [
                'class' => OutreachListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List accounts in Outreach.',
                'icon' => 'ph:buildings',
            ],
            'outreach_get_current_user' => [
                'class' => OutreachGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Outreach user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file for this integration.
     *
     * @return string|null Absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/outreach.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array List of credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.outreach.io/api/v2'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service connection.
     *
     * Resolves credentials for the given account context, or falls back
     * to the container singleton if no account is specified.
     *
     * @param  string $class   The tool class to instantiate.
     * @param  array  $context Optional context containing 'account' for multi-tenant resolution.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OutreachService(
                accessToken: $creds->get('outreach', 'access_token', '', $account),
                baseUrl: $creds->get('outreach', 'url', 'https://api.outreach.io/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(OutreachService::class));
    }
}
