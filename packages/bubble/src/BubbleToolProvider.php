<?php

namespace OpenCompany\Integrations\Bubble;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bubble\Tools\BubbleListRecords;
use OpenCompany\Integrations\Bubble\Tools\BubbleGetRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleCreateRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleUpdateRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleDeleteRecord;

/**
 * Tool provider for the Bubble integration.
 *
 * Implements ConfigurableIntegration for multi-account support,
 * connection testing, and configuration schema.
 */
class BubbleToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application identifier used for namespacing.
     */
    public function appName(): string
    {
        return 'bubble';
    }

    /**
     * Short metadata shown in tool listings and UI badges.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'list, get, create, update, delete',
            'description' => 'No-code app platform',
            'icon' => 'ph:circle-dot',
            'logo' => 'simple-icons:bubble',
        ];
    }

    /**
     * Full integration metadata for the integrations registry.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Bubble',
            'description' => 'No-code platform — manage records from your Bubble application',
            'icon' => 'ph:circle-dot',
            'logo' => 'simple-icons:bubble',
            'category' => 'no-code',
            'badge' => 'verified',
            'docs_url' => 'https://manual.bubble.io/core-resources/api/data-api',
        ];
    }

    /**
     * Configuration schema for the Bubble integration.
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
                'placeholder' => 'Enter your Bubble API token',
                'hint' => 'Generate an API token in your Bubble app under Settings → API → Data API',
                'required' => true,
            ],
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'App URL',
                'placeholder' => 'https://myapp.bubbleapps.io',
                'hint' => 'The full URL of your Bubble app (e.g. <code>https://myapp.bubbleapps.io</code> or your custom domain)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Bubble API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['hostname'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No app URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/obj');

            $status = $response->status();

            // 200 = success, 401 = bad key but URL is reachable, 404 = wrong path but URL reachable
            if ($status === 401) {
                return [
                    'success' => false,
                    'error' => 'Connected to Bubble, but the API key was rejected. Check your API token.',
                ];
            }

            if ($status >= 500) {
                return [
                    'success' => false,
                    'error' => "Bubble server returned an error (HTTP {$status}). Try again later.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Bubble API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'hostname' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'bubble_list_records' => [
                'class' => BubbleListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from a Bubble data type with optional filters.',
                'icon' => 'ph:list',
            ],
            'bubble_get_record' => [
                'class' => BubbleGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single record by ID.',
                'icon' => 'ph:magnifying-glass',
            ],
            'bubble_create_record' => [
                'class' => BubbleCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in a Bubble data type.',
                'icon' => 'ph:plus',
            ],
            'bubble_update_record' => [
                'class' => BubbleUpdateRecord::class,
                'type' => 'write',
                'name' => 'Update Record',
                'description' => 'Update an existing record by ID.',
                'icon' => 'ph:pencil',
            ],
            'bubble_delete_record' => [
                'class' => BubbleDeleteRecord::class,
                'type' => 'write',
                'name' => 'Delete Record',
                'description' => 'Delete a record by ID.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bubble.md';
    }

    /**
     * Credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'App URL', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BubbleService(
                apiKey: $creds->get('bubble', 'api_key', '', $account),
                baseUrl: $creds->get('bubble', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BubbleService::class));
    }
}
