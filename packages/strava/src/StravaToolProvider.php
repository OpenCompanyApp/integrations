<?php

namespace OpenCompany\Integrations\Strava;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Strava\Tools\StravaCreateActivity;
use OpenCompany\Integrations\Strava\Tools\StravaGetActivity;
use OpenCompany\Integrations\Strava\Tools\StravaGetAthlete;
use OpenCompany\Integrations\Strava\Tools\StravaGetCurrentUser;
use OpenCompany\Integrations\Strava\Tools\StravaListActivities;
use OpenCompany\Integrations\Strava\Tools\StravaListClubs;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class StravaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used for registration and credential resolution.
     */
    public function appName(): string
    {
        return 'strava';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Strava',
            'description' => 'Strava fitness/activity integration for Laravel — list activities, view athlete…',
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
            'name' => 'Strava',
            'description' => 'Strava fitness/activity integration for Laravel — list activities, view athlete profiles, manage clubs.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
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
                'placeholder' => 'Enter your Strava access token',
                'hint' => 'Obtain an access token from your Strava API application settings at <a href="https://www.strava.com/settings/api" target="_blank">strava.com/settings/api</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.strava.com/api/v3',
                'hint' => 'The Strava API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://www.strava.com/api/v3',
            ],
        ];
    }

    /**
     * Test the connection to the Strava API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.strava.com/api/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/athlete');

            if ($response->successful()) {
                $athlete = $response->json();
                $name = trim(($athlete['firstname'] ?? '') . ' ' . ($athlete['lastname'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Strava as {$name}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Strava API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'strava_list_activities' => [
                'class' => StravaListActivities::class,
                'type' => 'read',
                'name' => 'List Activities',
                'description' => 'List recent activities for the authenticated athlete.',
                'icon' => 'ph:list',
            ],
            'strava_get_activity' => [
                'class' => StravaGetActivity::class,
                'type' => 'read',
                'name' => 'Get Activity',
                'description' => 'Get detailed information about a specific activity.',
                'icon' => 'ph:clipboard-text',
            ],
            'strava_create_activity' => [
                'class' => StravaCreateActivity::class,
                'type' => 'write',
                'name' => 'Create Activity',
                'description' => 'Create a manual activity on Strava.',
                'icon' => 'ph:plus-circle',
            ],
            'strava_get_athlete' => [
                'class' => StravaGetAthlete::class,
                'type' => 'read',
                'name' => 'Get Athlete',
                'description' => 'Get the authenticated athlete\'s profile.',
                'icon' => 'ph:user',
            ],
            'strava_list_clubs' => [
                'class' => StravaListClubs::class,
                'type' => 'read',
                'name' => 'List Clubs',
                'description' => 'List clubs the authenticated athlete belongs to.',
                'icon' => 'ph:users-three',
            ],
            'strava_get_current_user' => [
                'class' => StravaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user\'s Strava profile (alias for Get Athlete).',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/strava.md';
    }

    /**
     * Credential fields used for account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.strava.com/api/v3'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the StravaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): StravaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new StravaService(
                accessToken: $creds->get('strava', 'access_token', '', $account),
                baseUrl: $creds->get('strava', 'url', 'https://www.strava.com/api/v3', $account),
            );
        }

        return app(StravaService::class);
    }
}
