<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetCurrentUser;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetPerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListDeals;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListOrganizations;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListPersons;

/**
 * Tool provider for Pipedrive CRM integration.
 *
 * Implements ConfigurableIntegration for multi-account support, config schema,
 * connection testing, and credential field definitions. Registers all Pipedrive
 * CRM tools (deals, persons, organizations, user).
 */
class PipedriveToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'pipedrive';
    }

    /**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'deals, persons, organizations',
            'description' => 'CRM & sales pipeline',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:pipedrive',
        ];
    }

    /**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Pipedrive',
            'description' => 'Sales CRM & pipeline management platform',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:pipedrive',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://developers.pipedrive.com/docs/api/v1/',
        ];
    }

    /**
     * Get the configuration schema for the Pipedrive integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_token',
                'type'        => 'secret',
                'label'       => 'API Token',
                'placeholder' => 'Enter your Pipedrive API token',
                'hint'        => 'Find your API token in Pipedrive Settings → Personal → API',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.pipedrive.com/v1',
                'hint'        => 'Change only if using a custom Pipedrive API endpoint',
                'default'     => 'https://api.pipedrive.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Pipedrive API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_token and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl  = rtrim($config['url'] ?? 'https://api.pipedrive.com/v1', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type'  => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach Pipedrive API at {$baseUrl}. Check the URL.",
                ];
            }

            $data = $json['data'] ?? [];
            $name = trim(($data['name'] ?? '') . ' ' . ($data['email'] ?? []));

            return [
                'success' => true,
                'message' => "Connected to Pipedrive API as " . ($name ?: 'authenticated user') . '.',
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
            'api_token' => 'nullable|string',
            'url'       => 'nullable|url',
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
            'pipedrive_list_deals' => [
                'class'       => PipedriveListDeals::class,
                'type'        => 'read',
                'name'        => 'List Deals',
                'description' => 'List deals in Pipedrive with optional filters.',
                'icon'        => 'ph:list',
            ],
            'pipedrive_get_deal' => [
                'class'       => PipedriveGetDeal::class,
                'type'        => 'read',
                'name'        => 'Get Deal',
                'description' => 'Get details for a single deal.',
                'icon'        => 'ph:handshake',
            ],
            'pipedrive_create_deal' => [
                'class'       => PipedriveCreateDeal::class,
                'type'        => 'write',
                'name'        => 'Create Deal',
                'description' => 'Create a new deal in Pipedrive.',
                'icon'        => 'ph:plus-circle',
            ],
            'pipedrive_list_persons' => [
                'class'       => PipedriveListPersons::class,
                'type'        => 'read',
                'name'        => 'List Persons',
                'description' => 'List persons (contacts) in Pipedrive.',
                'icon'        => 'ph:users',
            ],
            'pipedrive_get_person' => [
                'class'       => PipedriveGetPerson::class,
                'type'        => 'read',
                'name'        => 'Get Person',
                'description' => 'Get details for a single person.',
                'icon'        => 'ph:user',
            ],
            'pipedrive_list_organizations' => [
                'class'       => PipedriveListOrganizations::class,
                'type'        => 'read',
                'name'        => 'List Organizations',
                'description' => 'List organizations in Pipedrive.',
                'icon'        => 'ph:buildings',
            ],
            'pipedrive_get_current_user' => [
                'class'       => PipedriveGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pipedrive.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pipedrive.com/v1'],
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
     * Create a tool instance, optionally scoped to a specific account.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise the default app-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', '', $account),
                baseUrl: $creds->get('pipedrive', 'url', 'https://api.pipedrive.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PipedriveService::class));
    }
}
