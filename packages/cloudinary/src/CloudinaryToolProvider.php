<?php

namespace OpenCompany\Integrations\Cloudinary;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryApiGet;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryCreateFolder;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryDeleteFolder;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryDeleteResource;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryGetResource;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryGetUsage;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListFolders;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListResources;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListResourcesByTag;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListSubfolders;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListTags;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListTransformations;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListUploadPresets;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryPing;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinarySearchFolders;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinarySearchResources;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryUpload;

/**
 * Exposes Cloudinary Upload and Admin API tools.
 */
class CloudinaryToolProvider implements ConfigurableIntegration, HasIntegrationCapabilities, ToolProvider
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
                'strategy' => 'api_key_secret',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Cloudinary Admin API uses API key and API secret with HTTP Basic Auth. The access_token field remains accepted for backward compatibility.',
                ],
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
        return 'cloudinary';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Cloudinary',
            'description' => 'Media asset upload, management, search, folders, tags, and usage',
            'icon' => 'ph:image-square',
            'logo' => 'ph:image-square',
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
            'name' => 'Cloudinary',
            'description' => 'Cloudinary Upload and Admin API coverage for media assets, folders, tags, transformations, upload presets, search, and usage.',
            'icon' => 'ph:image-square',
            'logo' => 'ph:image-square',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://cloudinary.com/documentation/admin_api',
        ];
    }

    /**
     * Configuration schema for the integration settings form.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'cloud_name', 'type' => 'string', 'label' => 'Cloud Name', 'placeholder' => 'demo', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => '123456789012345', 'required' => true],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'placeholder' => 'API secret', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Optional legacy token', 'required' => false],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'default' => 'https://api.cloudinary.com/v1_1', 'required' => false],
        ];
    }

    /**
     * Test the connection using the Cloudinary Admin API ping endpoint.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $cloudName = (string) ($config['cloud_name'] ?? '');
        $apiKey = (string) ($config['api_key'] ?? '');
        $apiSecret = (string) ($config['api_secret'] ?? '');
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.cloudinary.com/v1_1'), '/');

        if ($cloudName === '' || (($apiKey === '' || $apiSecret === '') && $accessToken === '')) {
            return ['success' => false, 'error' => 'Cloud name and API key/secret or access token are required.'];
        }

        try {
            $headers = ['Accept' => 'application/json'];
            if ($apiKey !== '' && $apiSecret !== '') {
                $headers['Authorization'] = 'Basic ' . base64_encode($apiKey . ':' . $apiSecret);
            } else {
                $headers['Authorization'] = 'Bearer ' . $accessToken;
            }

            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/' . $cloudName . '/ping');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Cloudinary (cloud: {$cloudName}).",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Cloudinary API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'cloud_name' => 'nullable|string',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'cloudinary_upload' => $this->tool(CloudinaryUpload::class, 'Upload Asset', 'Upload an asset with the Cloudinary Upload API.', 'write'),
            'cloudinary_list_resources' => $this->tool(CloudinaryListResources::class, 'List Resources', 'List media resources by resource and delivery type.'),
            'cloudinary_search_resources' => $this->tool(CloudinarySearchResources::class, 'Search Resources', 'Search media resources with the Admin API expression language.'),
            'cloudinary_get_resource' => $this->tool(CloudinaryGetResource::class, 'Get Resource', 'Get details for a specific media resource.'),
            'cloudinary_delete_resource' => $this->tool(CloudinaryDeleteResource::class, 'Delete Resource', 'Delete a media resource by public ID.', 'write'),
            'cloudinary_list_resources_by_tag' => $this->tool(CloudinaryListResourcesByTag::class, 'List Resources By Tag', 'List assets with a specific tag.'),
            'cloudinary_list_tags' => $this->tool(CloudinaryListTags::class, 'List Tags', 'List tags used by assets.'),
            'cloudinary_list_folders' => $this->tool(CloudinaryListFolders::class, 'List Folders', 'List root asset folders.'),
            'cloudinary_list_subfolders' => $this->tool(CloudinaryListSubfolders::class, 'List Subfolders', 'List folders below a parent folder.'),
            'cloudinary_search_folders' => $this->tool(CloudinarySearchFolders::class, 'Search Folders', 'Search asset folders.'),
            'cloudinary_create_folder' => $this->tool(CloudinaryCreateFolder::class, 'Create Folder', 'Create an asset folder.', 'write'),
            'cloudinary_delete_folder' => $this->tool(CloudinaryDeleteFolder::class, 'Delete Folder', 'Delete an empty asset folder.', 'write'),
            'cloudinary_list_transformations' => $this->tool(CloudinaryListTransformations::class, 'List Transformations', 'List named transformations.'),
            'cloudinary_list_upload_presets' => $this->tool(CloudinaryListUploadPresets::class, 'List Upload Presets', 'List upload presets.'),
            'cloudinary_get_usage' => $this->tool(CloudinaryGetUsage::class, 'Get Usage', 'Get Cloudinary usage details.'),
            'cloudinary_ping' => $this->tool(CloudinaryPing::class, 'Ping', 'Ping Cloudinary servers.'),
            'cloudinary_api_get' => $this->tool(CloudinaryApiGet::class, 'Cloudinary API GET', 'Call a read-only Admin API endpoint.'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cloudinary.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Cloudinary service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): CloudinaryService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CloudinaryService(
                accessToken: $creds->get('cloudinary', 'access_token', '', $account),
                cloudName: $creds->get('cloudinary', 'cloud_name', '', $account),
                baseUrl: $creds->get('cloudinary', 'base_url', 'https://api.cloudinary.com/v1_1', $account),
                apiKey: $creds->get('cloudinary', 'api_key', '', $account),
                apiSecret: $creds->get('cloudinary', 'api_secret', '', $account),
            );
        }

        return app(CloudinaryService::class);
    }

    /**
     * Build standard tool metadata.
     *
     * @return array<string, mixed>
     */
    private function tool(string $class, string $name, string $description, string $type = 'read'): array
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
