<?php

namespace OpenCompany\Integrations\Clearbit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichPerson;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichCompany;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitReveal;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitProspect;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitListAutocomplete;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ClearbitToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'clearbit';
    }    /**
     * Configuration schema for the Clearbit integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Clearbit API key',
                'hint' => 'Find your API key in the Clearbit dashboard under <strong>Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://person.clearbit.com/v2',
                'hint' => 'Use <code>https://person.clearbit.com/v2</code> (default) or <code>https://company.clearbit.com/v2</code>. A single base URL is used for all endpoints.',
                'default' => 'https://person.clearbit.com/v2',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://person.clearbit.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Clearbit API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Clearbit API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'clearbit_enrich_person' => [
                'class' => ClearbitEnrichPerson::class,
                'type' => 'read',
                'name' => 'Enrich Person',
                'description' => 'Look up a person\'s social, employment, and demographic data by email.',
                'icon' => 'ph:user-circle',
            ],
            'clearbit_enrich_company' => [
                'class' => ClearbitEnrichCompany::class,
                'type' => 'read',
                'name' => 'Enrich Company',
                'description' => 'Look up company metrics, categorization, and social profiles by domain.',
                'icon' => 'ph:buildings',
            ],
            'clearbit_reveal' => [
                'class' => ClearbitReveal::class,
                'type' => 'read',
                'name' => 'Reveal',
                'description' => 'Identify the company and person behind an IP address.',
                'icon' => 'ph:eye',
            ],
            'clearbit_prospect' => [
                'class' => ClearbitProspect::class,
                'type' => 'read',
                'name' => 'Prospect',
                'description' => 'Find people by job title and/or company name.',
                'icon' => 'ph:users',
            ],
            'clearbit_list_autocomplete' => [
                'class' => ClearbitListAutocomplete::class,
                'type' => 'read',
                'name' => 'Company Autocomplete',
                'description' => 'Search for companies by name (autocomplete / type-ahead).',
                'icon' => 'ph:magnifying-glass',
            ],
            'clearbit_get_current_user' => [
                'class' => ClearbitGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the authenticated user\'s Clearbit account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/clearbit.md';
    }

    /**
     * Credential fields for quick reference.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://person.clearbit.com/v2'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with an 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ClearbitService(
                apiKey: $creds->get('clearbit', 'api_key', '', $account),
                baseUrl: $creds->get('clearbit', 'url', 'https://person.clearbit.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(ClearbitService::class));
    }
}
