<?php

namespace OpenCompany\Integrations\Abyssale;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleApiGet;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleApiPost;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleCreateBannerExport;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleCreateDynamicImageUrl;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleCreateProject;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleDuplicateWorkspaceTemplate;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGenerateImage;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGenerateMultiFormatMedia;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGenerateMultiPagePdf;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetDesign;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetDesignFormat;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetDuplicationRequest;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetFile;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListDesigns;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListFonts;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListProjects;

/**
 * Exposes the Abyssale integration catalog, credentials, and tool factory.
 */
class AbyssaleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key_header',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Abyssale expects the API key in the x-api-key header.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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
        return 'abyssale';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Abyssale',
            'description' => 'Creative automation and visual generation',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:abyssale',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Abyssale',
            'description' => 'Automated image, video, PDF, HTML5, export, project, and dynamic-image generation',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:abyssale',
            'category' => 'rendering',
            'badge' => 'verified',
            'docs_url' => 'https://api-reference.abyssale.com/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate credentials with a lightweight design-list request.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) (($config['url'] ?? '') ?: 'https://api.abyssale.com'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Abyssale API key is required.'];
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/designs');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Abyssale API returned an error: '.(is_string($error) ? $error : json_encode($error)),
                ];
            }

            return ['success' => true, 'message' => 'Connected to Abyssale.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'abyssale_list_designs' => $this->tool(AbyssaleListDesigns::class, 'read', 'List Designs', 'List Abyssale designs available to the API key.'),
            'abyssale_get_design' => $this->tool(AbyssaleGetDesign::class, 'read', 'Get Design', 'Get design metadata, formats, and editable elements.'),
            'abyssale_get_design_format' => $this->tool(AbyssaleGetDesignFormat::class, 'read', 'Get Design Format', 'Get details for a specific design format.'),
            'abyssale_generate_image' => $this->tool(AbyssaleGenerateImage::class, 'write', 'Generate Image', 'Synchronously generate one static image.'),
            'abyssale_generate_multi_format_media' => $this->tool(AbyssaleGenerateMultiFormatMedia::class, 'write', 'Generate Multi-Format Media', 'Asynchronously generate images, videos, PDFs, GIFs, or HTML5.'),
            'abyssale_list_fonts' => $this->tool(AbyssaleListFonts::class, 'read', 'List Fonts', 'List custom and Google fonts.'),
            'abyssale_create_banner_export' => $this->tool(AbyssaleCreateBannerExport::class, 'write', 'Create Banner Export', 'Create an asynchronous ZIP export for generated banners.'),
            'abyssale_get_file' => $this->tool(AbyssaleGetFile::class, 'read', 'Get File', 'Get a generated file by banner ID.'),
            'abyssale_list_projects' => $this->tool(AbyssaleListProjects::class, 'read', 'List Projects', 'List Abyssale projects.'),
            'abyssale_create_project' => $this->tool(AbyssaleCreateProject::class, 'write', 'Create Project', 'Create an Abyssale project.'),
            'abyssale_duplicate_workspace_template' => $this->tool(AbyssaleDuplicateWorkspaceTemplate::class, 'write', 'Duplicate Workspace Template', 'Duplicate a workspace template into a project.'),
            'abyssale_get_duplication_request' => $this->tool(AbyssaleGetDuplicationRequest::class, 'read', 'Get Duplication Request', 'Get duplication request status.'),
            'abyssale_create_dynamic_image_url' => $this->tool(AbyssaleCreateDynamicImageUrl::class, 'write', 'Create Dynamic Image URL', 'Create or retrieve a dynamic image URL for a design.'),
            'abyssale_generate_multi_page_pdf' => $this->tool(AbyssaleGenerateMultiPagePdf::class, 'write', 'Generate Multi-Page PDF', 'Asynchronously generate a multi-page PDF.'),
            'abyssale_api_get' => $this->tool(AbyssaleApiGet::class, 'read', 'Abyssale API GET', 'Call a documented Abyssale GET endpoint not yet wrapped by a named tool.'),
            'abyssale_api_post' => $this->tool(AbyssaleApiPost::class, 'write', 'Abyssale API POST', 'Call a documented Abyssale POST endpoint not yet wrapped by a named tool.'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/abyssale.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.abyssale.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context, may include an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Abyssale API client for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context with optional account key.
     */
    private function resolveService(array $context = []): AbyssaleService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AbyssaleService(
                apiKey: $creds->get('abyssale', 'access_token', '', $account),
                baseUrl: $creds->get('abyssale', 'url', 'https://api.abyssale.com', $account),
            );
        }

        return app(AbyssaleService::class);
    }

    /**
     * Build catalog metadata for a tool class.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array<string, mixed>
     */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => 'ph:wrench',
        ];
    }
}
