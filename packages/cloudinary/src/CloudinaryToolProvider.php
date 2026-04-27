<?php

namespace OpenCompany\Integrations\Cloudinary;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryUpload;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListResources;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryGetResource;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryDeleteResource;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListFolders;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CloudinaryToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * The machine name of this integration.
     */
    public function appName(): string
    {
        return 'cloudinary';
    }    /**
     * Configuration schema for the integration settings form.
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
                'placeholder' => 'Enter your Cloudinary OAuth access token',
                'hint' => 'Generate an OAuth access token in your Cloudinary account settings under "Access Keys"',
                'required' => true,
            ],
            [
                'key' => 'cloud_name',
                'type' => 'string',
                'label' => 'Cloud Name',
                'placeholder' => 'your_cloud_name',
                'hint' => 'Found in your Cloudinary dashboard — this is the subdomain used in API URLs',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cloudinary.com/v1_1',
                'hint' => 'Defaults to the public Cloudinary API. Change only for private endpoints.',
                'default' => 'https://api.cloudinary.com/v1_1',
            ],
        ];
    }

    /**
     * Test the connection using the supplied configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $cloudName = $config['cloud_name'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.cloudinary.com/v1_1', '/');

        if (empty($accessToken) || empty($cloudName)) {
            return ['success' => false, 'error' => 'Access token and cloud name are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/' . $cloudName . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Cloudinary API. Check your cloud name and base URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Cloudinary (cloud: {$cloudName}).",
            ];
        } catch (\Exception $e) {
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
            'access_token' => 'nullable|string',
            'cloud_name' => 'nullable|string',
            'base_url' => 'nullable|url',
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
            'cloudinary_upload' => [
                'class' => CloudinaryUpload::class,
                'type' => 'write',
                'name' => 'Upload',
                'description' => 'Upload an image to Cloudinary.',
                'icon' => 'ph:upload-simple',
            ],
            'cloudinary_list_resources' => [
                'class' => CloudinaryListResources::class,
                'type' => 'read',
                'name' => 'List Resources',
                'description' => 'List media resources in your Cloudinary cloud.',
                'icon' => 'ph:list',
            ],
            'cloudinary_get_resource' => [
                'class' => CloudinaryGetResource::class,
                'type' => 'read',
                'name' => 'Get Resource',
                'description' => 'Get details of a specific media resource.',
                'icon' => 'ph:magnifying-glass',
            ],
            'cloudinary_delete_resource' => [
                'class' => CloudinaryDeleteResource::class,
                'type' => 'write',
                'name' => 'Delete Resource',
                'description' => 'Delete a media resource from Cloudinary.',
                'icon' => 'ph:trash',
            ],
            'cloudinary_list_folders' => [
                'class' => CloudinaryListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List all folders in your Cloudinary cloud.',
                'icon' => 'ph:folder',
            ],
            'cloudinary_get_current_user' => [
                'class' => CloudinaryGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the currently authenticated Cloudinary user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file, relative to the package root.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cloudinary.md';
    }

    /**
     * Credential fields used for account-level configuration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'cloud_name', 'type' => 'string', 'label' => 'Cloud Name', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cloudinary.com/v1_1'],
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new CloudinaryService(
                accessToken: $creds->get('cloudinary', 'access_token', '', $account),
                cloudName: $creds->get('cloudinary', 'cloud_name', '', $account),
                baseUrl: $creds->get('cloudinary', 'base_url', 'https://api.cloudinary.com/v1_1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CloudinaryService::class));
    }
}
