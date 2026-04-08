<?php

namespace OpenCompany\Integrations\ApiTemplateIO;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdf;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreateImage;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOListTemplates;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOGetTemplate;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOGetCurrentUser;

/**
 * Tool provider for the API Template IO integration.
 *
 * Defines the integration metadata, configuration schema, credential fields,
 * available tools, and supports multi-account usage via createTool().
 */
class ApiTemplateIOToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the app name identifier.
     *
     * @return string The integration identifier.
     */
    public function appName(): string
    {
        return 'apitemplateio';
    }

    /**
     * Get the app metadata for display in the integration registry.
     *
     * @return array<string, mixed> App metadata (label, description, icons).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'PDF, images, templates',
            'description' => 'Document & image generation',
            'icon' => 'ph:file-pdf',
            'logo' => 'simple-icons:apitemplateio',
        ];
    }

    /**
     * Get the integration metadata for the OpenCompany integration catalog.
     *
     * @return array<string, mixed> Integration metadata including category and docs URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'API Template IO',
            'description' => 'Generate PDFs and images from reusable templates',
            'icon' => 'ph:file-pdf',
            'logo' => 'simple-icons:apitemplateio',
            'category' => 'documents',
            'badge' => 'verified',
            'docs_url' => 'https://apitemplate.io/apiv2/',
        ];
    }

    /**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>> The configuration field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your API Template IO API key',
                'hint' => 'Find your API key in the API Template IO dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.apitemplate.io/v1',
                'hint' => 'Override only if using a custom or regional endpoint',
                'default' => 'https://api.apitemplate.io/v1',
            ],
        ];
    }

    /**
     * Test the connection to the API Template IO API using the provided config.
     *
     * @param array<string, mixed> $config The configuration to test.
     *
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.apitemplate.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach API Template IO at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to API Template IO at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}: " . ($json['message'] ?? 'Unknown error'),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the integration configuration.
     *
     * @return array<string, mixed> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'apitemplateio_create_pdf' => [
                'class' => ApiTemplateIOCreatePdf::class,
                'type' => 'write',
                'name' => 'Create PDF',
                'description' => 'Generate a PDF document from a template.',
                'icon' => 'ph:file-pdf',
            ],
            'apitemplateio_create_image' => [
                'class' => ApiTemplateIOCreateImage::class,
                'type' => 'write',
                'name' => 'Create Image',
                'description' => 'Generate an image (PNG or JPEG) from a template.',
                'icon' => 'ph:image',
            ],
            'apitemplateio_list_templates' => [
                'class' => ApiTemplateIOListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available templates with pagination.',
                'icon' => 'ph:files',
            ],
            'apitemplateio_get_template' => [
                'class' => ApiTemplateIOGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details for a specific template.',
                'icon' => 'ph:file-text',
            ],
            'apitemplateio_get_current_user' => [
                'class' => ApiTemplateIOGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file for this integration.
     *
     * @return string|null The absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/apitemplateio.md';
    }

    /**
     * Get the credential field definitions for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.apitemplate.io/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * Supports multi-account usage by resolving credentials for the given account
     * context and injecting them into a fresh ApiTemplateIOService instance.
     *
     * @param string               $class   The tool class to instantiate.
     * @param array<string, mixed> $context Optional context with 'account' for multi-account support.
     *
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ApiTemplateIOService(
                apiKey: $creds->get('apitemplateio', 'api_key', '', $account),
                baseUrl: $creds->get('apitemplateio', 'url', 'https://api.apitemplate.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ApiTemplateIOService::class));
    }
}
