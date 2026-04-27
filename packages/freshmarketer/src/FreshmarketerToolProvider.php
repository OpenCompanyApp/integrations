<?php

namespace OpenCompany\Integrations\Freshmarketer;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerListCampaigns;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerGetCampaign;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerCreateCampaign;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerListSegments;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerGetSegment;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerListUsers;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class FreshmarketerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'freshmarketer';
    }

/**
     * Short metadata shown in tool picker UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, segments, users',
            'description' => 'Marketing automation',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:freshworks',
        ];
    }

/**
     * Full integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshmarketer',
            'description' => 'Marketing automation by Freshworks — manage campaigns, segments, and contacts.',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:freshworks',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshworks.com/crm/',
        ];
    }/**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Freshmarketer API access token',
                'hint' => 'Generate an access token in your Freshworks admin settings under "API Settings"',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'mycompany',
                'hint' => 'Your Freshworks subdomain (the part before <code>.myfreshworks.com</code>)',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => 'https://mycompany.myfreshworks.com/crm/sales',
                'hint' => 'Override the auto-generated base URL. Leave empty to use <code>https://{domain}.myfreshworks.com/crm/sales</code>',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to Freshmarketer using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $domain = $config['domain'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? '', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($baseUrl) && empty($domain)) {
            return ['success' => false, 'error' => 'No domain or base URL provided'];
        }

        if (empty($baseUrl)) {
            $baseUrl = "https://{$domain}.myfreshworks.com/crm/sales";
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null && !$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach Freshmarketer API at {$baseUrl}. Check the domain and access token.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Freshmarketer API error: {$error}",
                ];
            }

            $userName = $json['user']['first_name'] ?? $json['user']['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Freshmarketer as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'domain' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Declare all available tools with their class, type, name, description, and icon.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'freshmarketer_list_campaigns' => [
                'class' => FreshmarketerListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List marketing campaigns with pagination and optional status filter.',
                'icon' => 'ph:megaphone',
            ],
            'freshmarketer_get_campaign' => [
                'class' => FreshmarketerGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details of a specific campaign.',
                'icon' => 'ph:megaphone',
            ],
            'freshmarketer_create_campaign' => [
                'class' => FreshmarketerCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create a new marketing campaign.',
                'icon' => 'ph:plus-circle',
            ],
            'freshmarketer_list_segments' => [
                'class' => FreshmarketerListSegments::class,
                'type' => 'read',
                'name' => 'List Segments',
                'description' => 'List contact segments with pagination.',
                'icon' => 'ph:users-three',
            ],
            'freshmarketer_get_segment' => [
                'class' => FreshmarketerGetSegment::class,
                'type' => 'read',
                'name' => 'Get Segment',
                'description' => 'Get details of a specific segment.',
                'icon' => 'ph:users-three',
            ],
            'freshmarketer_list_users' => [
                'class' => FreshmarketerListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Freshmarketer account.',
                'icon' => 'ph:user-list',
            ],
            'freshmarketer_get_current_user' => [
                'class' => FreshmarketerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshmarketer.md';
    }

    /**
     * Credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Custom Base URL', 'required' => false],
        ];
    }

    /**
     * Confirm this is a valid integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account context.
     *
     * @param  string  $class   Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FreshmarketerService(
                accessToken: $creds->get('freshmarketer', 'access_token', '', $account),
                domain: $creds->get('freshmarketer', 'domain', '', $account),
                baseUrl: $creds->get('freshmarketer', 'base_url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshmarketerService::class));
    }
}
