<?php

namespace OpenCompany\Integrations\Bubble;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bubble\Tools\BubbleCreateRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleDeleteRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleGetRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleGetSwagger;
use OpenCompany\Integrations\Bubble\Tools\BubbleListRecords;
use OpenCompany\Integrations\Bubble\Tools\BubbleReplaceRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleTriggerWorkflow;
use OpenCompany\Integrations\Bubble\Tools\BubbleTriggerWorkflowGet;
use OpenCompany\Integrations\Bubble\Tools\BubbleUpdateRecord;

/**
 * Tool provider for Bubble's built-in API.
 *
 * Exposes Data API record operations, Workflow API triggers, and Swagger discovery.
 */
class BubbleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'bubble';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Bubble',
            'description' => 'App data and backend workflows',
            'icon' => 'ph:circle-dot',
            'logo' => 'simple-icons:bubble',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bubble',
            'description' => 'Manage Bubble Data API records, trigger backend Workflow API endpoints, and inspect the app Swagger specification',
            'icon' => 'ph:circle-dot',
            'logo' => 'simple-icons:bubble',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://manual.bubble.io/core-resources/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Enter your Bubble API token', 'hint' => 'Generate an API token in your Bubble app under Settings > API.', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'App URL', 'placeholder' => 'https://myapp.bubbleapps.io', 'hint' => 'The root URL of your Bubble app, without /api/1.1.', 'required' => true],
            ['key' => 'api_path', 'type' => 'string', 'label' => 'API Path', 'placeholder' => '/api/1.1', 'hint' => 'Use /version-test/api/1.1 for development mode.', 'default' => '/api/1.1', 'required' => false],
        ];
    }

    /**
     * Test the Bubble API connection.
     *
     * @param  array<string, mixed>  $config  Configuration values
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['hostname'] ?? ''), '/');
        $apiPath = '/' . trim((string) ($config['api_path'] ?? '/api/1.1'), '/');

        if ($apiKey === '' || $baseUrl === '') {
            return ['success' => false, 'error' => 'API key and app URL are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . $apiPath . '/meta');

            if ($response->status() === 401 || $response->status() === 403) {
                return ['success' => false, 'error' => 'Connected to Bubble, but the API key was rejected.'];
            }

            if (! $response->successful()) {
                return ['success' => false, 'error' => "Bubble API returned HTTP {$response->status()}. Check the app URL, API path, and API settings."];
            }

            return ['success' => true, 'message' => "Connected to Bubble API at {$baseUrl}{$apiPath}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'hostname' => 'nullable|url',
            'api_path' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'bubble_get_swagger' => ['class' => BubbleGetSwagger::class, 'type' => 'read', 'name' => 'Get Swagger', 'description' => 'Get Bubble API Swagger specification.', 'icon' => 'ph:file-code'],
            'bubble_list_records' => ['class' => BubbleListRecords::class, 'type' => 'read', 'name' => 'List Records', 'description' => 'List records from a Bubble data type.', 'icon' => 'ph:list'],
            'bubble_get_record' => ['class' => BubbleGetRecord::class, 'type' => 'read', 'name' => 'Get Record', 'description' => 'Get one Bubble record.', 'icon' => 'ph:magnifying-glass'],
            'bubble_create_record' => ['class' => BubbleCreateRecord::class, 'type' => 'write', 'name' => 'Create Record', 'description' => 'Create a Bubble record.', 'icon' => 'ph:plus'],
            'bubble_update_record' => ['class' => BubbleUpdateRecord::class, 'type' => 'write', 'name' => 'Update Record', 'description' => 'Patch a Bubble record.', 'icon' => 'ph:pencil'],
            'bubble_replace_record' => ['class' => BubbleReplaceRecord::class, 'type' => 'write', 'name' => 'Replace Record', 'description' => 'Replace a Bubble record.', 'icon' => 'ph:arrows-clockwise'],
            'bubble_delete_record' => ['class' => BubbleDeleteRecord::class, 'type' => 'write', 'name' => 'Delete Record', 'description' => 'Delete a Bubble record.', 'icon' => 'ph:trash'],
            'bubble_trigger_workflow' => ['class' => BubbleTriggerWorkflow::class, 'type' => 'write', 'name' => 'Trigger Workflow', 'description' => 'Trigger POST Bubble API workflow.', 'icon' => 'ph:play'],
            'bubble_trigger_workflow_get' => ['class' => BubbleTriggerWorkflowGet::class, 'type' => 'write', 'name' => 'Trigger Workflow GET', 'description' => 'Trigger GET Bubble API workflow.', 'icon' => 'ph:play-circle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bubble.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'App URL', 'required' => true],
            ['key' => 'api_path', 'type' => 'string', 'label' => 'API Path', 'required' => false, 'default' => '/api/1.1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Bubble service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): BubbleService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BubbleService(
                apiKey: $creds->get('bubble', 'api_key', '', $account),
                baseUrl: $creds->get('bubble', 'hostname', '', $account),
                apiPath: $creds->get('bubble', 'api_path', '/api/1.1', $account),
            );
        }

        return app(BubbleService::class);
    }
}
