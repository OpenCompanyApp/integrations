<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Canva\Tools\CanvaListDesigns;
use OpenCompany\Integrations\Canva\Tools\CanvaGetDesign;
use OpenCompany\Integrations\Canva\Tools\CanvaCreateDesign;
use OpenCompany\Integrations\Canva\Tools\CanvaListFolders;
use OpenCompany\Integrations\Canva\Tools\CanvaGetFolder;
use OpenCompany\Integrations\Canva\Tools\CanvaUploadAsset;
use OpenCompany\Integrations\Canva\Tools\CanvaGetCurrentUser;

class CanvaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'canva';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'designs, folders, assets, user',
            'description' => 'Graphic design platform',
            'icon' => 'ph:paint-brush',
            'logo' => 'simple-icons:canva',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Canva',
            'description' => 'Graphic design platform — create and manage designs, folders, and assets',
            'icon' => 'ph:paint-brush',
            'logo' => 'simple-icons:canva',
            'category' => 'design',
            'badge' => 'verified',
            'docs_url' => 'https://www.canva.dev/docs/connect/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Canva Connect API access token',
                'hint' => 'Generate an access token from the <a href="https://www.canva.com/developers/apps/" target="_blank">Canva Developer Portal</a> for your Connect integration',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.canva.com',
                'hint' => 'The Canva Connect API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.canva.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.canva.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($response->successful() && isset($json['user'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Canva API as {$json['user']['display_name']}.",
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Canva API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => false,
                'error' => "Canva API returned an error (HTTP {$response->status()}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'canva_list_designs' => [
                'class' => CanvaListDesigns::class,
                'type' => 'read',
                'name' => 'List Designs',
                'description' => 'List designs the user has access to.',
                'icon' => 'ph:paint-brush',
            ],
            'canva_get_design' => [
                'class' => CanvaGetDesign::class,
                'type' => 'read',
                'name' => 'Get Design',
                'description' => 'Get details of a specific design.',
                'icon' => 'ph:paint-brush',
            ],
            'canva_create_design' => [
                'class' => CanvaCreateDesign::class,
                'type' => 'write',
                'name' => 'Create Design',
                'description' => 'Create a new design in Canva.',
                'icon' => 'ph:plus',
            ],
            'canva_list_folders' => [
                'class' => CanvaListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List folders the user has access to.',
                'icon' => 'ph:folder',
            ],
            'canva_get_folder' => [
                'class' => CanvaGetFolder::class,
                'type' => 'read',
                'name' => 'Get Folder',
                'description' => 'Get details of a specific folder.',
                'icon' => 'ph:folder',
            ],
            'canva_upload_asset' => [
                'class' => CanvaUploadAsset::class,
                'type' => 'write',
                'name' => 'Upload Asset',
                'description' => 'Upload an asset to Canva from a URL.',
                'icon' => 'ph:upload',
            ],
            'canva_get_current_user' => [
                'class' => CanvaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/canva.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Canva API URL', 'required' => false, 'default' => 'https://api.canva.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new CanvaService(
                accessToken: $creds->get('canva', 'access_token', '', $account),
                baseUrl: $creds->get('canva', 'url', 'https://api.canva.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(CanvaService::class));
    }
}
