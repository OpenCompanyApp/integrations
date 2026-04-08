<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Attio\Tools\AttioListRecords;
use OpenCompany\Integrations\Attio\Tools\AttioGetRecord;
use OpenCompany\Integrations\Attio\Tools\AttioCreateRecord;
use OpenCompany\Integrations\Attio\Tools\AttioListObjects;
use OpenCompany\Integrations\Attio\Tools\AttioGetObject;
use OpenCompany\Integrations\Attio\Tools\AttioListWorkspaces;
use OpenCompany\Integrations\Attio\Tools\AttioGetCurrentUser;

class AttioToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The integration app name identifier.
     */
    public function appName(): string
    {
        return 'attio';
    }

    /**
     * Short metadata for the app display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'records, objects, workspaces',
            'description' => 'CRM & Sales',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:attio',
        ];
    }

    /**
     * Full integration metadata for the UI.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Attio',
            'description' => 'Modern CRM platform for managing contacts, companies, deals and more',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:attio',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developers.attio.com/docs',
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
                'placeholder' => 'Enter your Attio API access token',
                'hint' => 'Generate an access token in your Attio workspace settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.attio.com',
                'hint' => 'Use the default Attio API URL, or a custom endpoint if applicable',
                'default' => 'https://api.attio.com',
            ],
        ];
    }

    /**
     * Test the connection to the Attio API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.attio.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/self');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Attio API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['data']['first_name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Attio API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Return all available tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'attio_list_records' => [
                'class' => AttioListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records for an object type with filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'attio_get_record' => [
                'class' => AttioGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single record by ID.',
                'icon' => 'ph:eye',
            ],
            'attio_create_record' => [
                'class' => AttioCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record for an object type.',
                'icon' => 'ph:plus',
            ],
            'attio_list_objects' => [
                'class' => AttioListObjects::class,
                'type' => 'read',
                'name' => 'List Objects',
                'description' => 'List all object types in the workspace.',
                'icon' => 'ph:squares-four',
            ],
            'attio_get_object' => [
                'class' => AttioGetObject::class,
                'type' => 'read',
                'name' => 'Get Object',
                'description' => 'Get details for a specific object type.',
                'icon' => 'ph:square',
            ],
            'attio_list_workspaces' => [
                'class' => AttioListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces accessible to the authenticated user.',
                'icon' => 'ph:buildings',
            ],
            'attio_get_current_user' => [
                'class' => AttioGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua docs file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/attio.md';
    }

    /**
     * Credential fields for quick configuration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.attio.com'],
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AttioService(
                accessToken: $creds->get('attio', 'access_token', '', $account),
                baseUrl: $creds->get('attio', 'base_url', 'https://api.attio.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AttioService::class));
    }
}
