<?php

namespace OpenCompany\Integrations\Gainsight;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gainsight\Tools\GainsightListCompanies;
use OpenCompany\Integrations\Gainsight\Tools\GainsightGetCompany;
use OpenCompany\Integrations\Gainsight\Tools\GainsightListUsers;
use OpenCompany\Integrations\Gainsight\Tools\GainsightGetUser;
use OpenCompany\Integrations\Gainsight\Tools\GainsightListSurveys;
use OpenCompany\Integrations\Gainsight\Tools\GainsightGetSurvey;
use OpenCompany\Integrations\Gainsight\Tools\GainsightGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class GainsightToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'gainsight';
    }

/**
     * Get metadata for display in the OpenCompany UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Gainsight',
            'description' => 'Customer success',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:gainsight',
        ];
    }

/**
     * Get integration metadata for the marketplace / integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Gainsight',
            'description' => 'Customer success platform — companies, users, and surveys',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:gainsight',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://support.gainsight.com/s/article/Gainsight-API-Documentation',
        ];
    }/**
     * Get the configuration schema for Gainsight credentials.
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
                'placeholder' => 'Enter your Gainsight API access token',
                'hint' => 'Find your access token in Gainsight Administration → Connectors 2.0 → OAuth',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.gainsight.com/v1',
                'hint' => 'Override only if using a Gainsight API proxy or alternative endpoint',
                'default' => 'https://api.gainsight.com/v1',
            ],
        ];
    }

    /**
     * Test the Gainsight API connection using the provided credentials.
     *
     * @param  array  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.gainsight.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access token is required'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)
              ->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gainsight API at {$baseUrl}. Check the URL and credentials.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['errors'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $userName = $json['name'] ?? $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Gainsight API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of available Gainsight tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'gainsight_list_companies' => [
                'class' => GainsightListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List companies from Gainsight.',
                'icon' => 'ph:buildings',
            ],
            'gainsight_get_company' => [
                'class' => GainsightGetCompany::class,
                'type' => 'read',
                'name' => 'Get Company',
                'description' => 'Get detailed information about a specific company.',
                'icon' => 'ph:buildings',
            ],
            'gainsight_list_users' => [
                'class' => GainsightListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Gainsight users.',
                'icon' => 'ph:users',
            ],
            'gainsight_get_user' => [
                'class' => GainsightGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get detailed information about a specific user.',
                'icon' => 'ph:user',
            ],
            'gainsight_list_surveys' => [
                'class' => GainsightListSurveys::class,
                'type' => 'read',
                'name' => 'List Surveys',
                'description' => 'List surveys from Gainsight.',
                'icon' => 'ph:clipboard-text',
            ],
            'gainsight_get_survey' => [
                'class' => GainsightGetSurvey::class,
                'type' => 'read',
                'name' => 'Get Survey',
                'description' => 'Get detailed information about a specific survey.',
                'icon' => 'ph:clipboard-text',
            ],
            'gainsight_get_current_user' => [
                'class' => GainsightGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Gainsight user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gainsight.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Gainsight API URL', 'required' => false, 'default' => 'https://api.gainsight.com/v1'],
        ];
    }

    /**
     * Confirm this is a full integration (not just a set of tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array  $context  Context containing an optional 'account' key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GainsightService(
                accessToken: $creds->get('gainsight', 'access_token', '', $account),
                baseUrl: $creds->get('gainsight', 'url', 'https://api.gainsight.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GainsightService::class));
    }
}
