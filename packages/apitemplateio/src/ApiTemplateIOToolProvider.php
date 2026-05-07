<?php

namespace OpenCompany\Integrations\ApiTemplateIO;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreateImage;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdf;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdfFromHtml;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdfFromMarkdown;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdfFromUrl;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIODeleteObject;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOGetCurrentUser;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOGetTemplate;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOListObjects;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOListTemplates;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOMergePdfs;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOUpdateTemplate;

/**
 * Tool provider for the APITemplate.io integration.
 *
 * Exposes the documented REST API v2 surface for PDF generation, image generation,
 * generated-object management, account information, and template management.
 */
class ApiTemplateIOToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe setup and runtime capabilities for catalog and host UIs.
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
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
        return 'apitemplateio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'APITemplate.io',
            'description' => 'PDF and image generation',
            'icon' => 'ph:file-pdf',
            'logo' => 'simple-icons:apitemplateio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'APITemplate.io',
            'description' => 'Generate PDFs and images from templates, HTML, URLs, Markdown, and PDF merge workflows',
            'icon' => 'ph:file-pdf',
            'logo' => 'simple-icons:apitemplateio',
            'category' => 'rendering',
            'badge' => 'verified',
            'docs_url' => 'https://apitemplate.io/apiv2/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your APITemplate.io API key',
                'hint' => 'Find your API key in the APITemplate.io dashboard API Integration section.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://rest.apitemplate.io',
                'hint' => 'Override for a regional endpoint such as https://rest-us.apitemplate.io or https://rest-de.apitemplate.io.',
                'default' => 'https://rest.apitemplate.io',
            ],
        ];
    }

    /**
     * Test the configured APITemplate.io credentials.
     *
     * @param  array<string, mixed>  $config  Integration configuration
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://rest.apitemplate.io'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/account-information');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to APITemplate.io at {$baseUrl}.",
                ];
            }

            $json = $response->json();

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}: " . ($json['message'] ?? $json['error'] ?? 'Unknown error'),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'apitemplateio_create_pdf' => [
                'class' => ApiTemplateIOCreatePdf::class,
                'type' => 'write',
                'name' => 'Create PDF',
                'description' => 'Generate a PDF document from a saved template.',
                'icon' => 'ph:file-pdf',
            ],
            'apitemplateio_create_image' => [
                'class' => ApiTemplateIOCreateImage::class,
                'type' => 'write',
                'name' => 'Create Image',
                'description' => 'Generate images from a visual template.',
                'icon' => 'ph:image',
            ],
            'apitemplateio_create_pdf_from_html' => [
                'class' => ApiTemplateIOCreatePdfFromHtml::class,
                'type' => 'write',
                'name' => 'Create PDF From HTML',
                'description' => 'Generate a PDF directly from HTML content.',
                'icon' => 'ph:code',
            ],
            'apitemplateio_create_pdf_from_url' => [
                'class' => ApiTemplateIOCreatePdfFromUrl::class,
                'type' => 'write',
                'name' => 'Create PDF From URL',
                'description' => 'Generate a PDF by rendering a public URL.',
                'icon' => 'ph:globe',
            ],
            'apitemplateio_create_pdf_from_markdown' => [
                'class' => ApiTemplateIOCreatePdfFromMarkdown::class,
                'type' => 'write',
                'name' => 'Create PDF From Markdown',
                'description' => 'Generate a PDF from Markdown content.',
                'icon' => 'ph:markdown-logo',
            ],
            'apitemplateio_merge_pdfs' => [
                'class' => ApiTemplateIOMergePdfs::class,
                'type' => 'write',
                'name' => 'Merge PDFs',
                'description' => 'Merge multiple PDF URLs into one PDF.',
                'icon' => 'ph:files',
            ],
            'apitemplateio_list_objects' => [
                'class' => ApiTemplateIOListObjects::class,
                'type' => 'read',
                'name' => 'List Generated Objects',
                'description' => 'List generated PDFs and images.',
                'icon' => 'ph:archive',
            ],
            'apitemplateio_delete_object' => [
                'class' => ApiTemplateIODeleteObject::class,
                'type' => 'write',
                'name' => 'Delete Generated Object',
                'description' => 'Delete a generated PDF or image by transaction reference.',
                'icon' => 'ph:trash',
            ],
            'apitemplateio_get_current_user' => [
                'class' => ApiTemplateIOGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Account Information',
                'description' => 'Get account information for the configured API key.',
                'icon' => 'ph:user',
            ],
            'apitemplateio_list_templates' => [
                'class' => ApiTemplateIOListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List saved templates with documented filters.',
                'icon' => 'ph:files',
            ],
            'apitemplateio_get_template' => [
                'class' => ApiTemplateIOGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details for a saved PDF template.',
                'icon' => 'ph:file-text',
            ],
            'apitemplateio_update_template' => [
                'class' => ApiTemplateIOUpdateTemplate::class,
                'type' => 'write',
                'name' => 'Update Template',
                'description' => 'Update a saved PDF template.',
                'icon' => 'ph:pencil-simple',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/apitemplateio.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://rest.apitemplate.io'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the API service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): ApiTemplateIOService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ApiTemplateIOService(
                apiKey: $creds->get('apitemplateio', 'api_key', '', $account),
                baseUrl: $creds->get('apitemplateio', 'url', 'https://rest.apitemplate.io', $account),
            );
        }

        return app(ApiTemplateIOService::class);
    }
}
