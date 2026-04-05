<?php

namespace OpenCompany\Integrations\Pinterest;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pinterest\Tools\PinterestCreateBoard;
use OpenCompany\Integrations\Pinterest\Tools\PinterestCreatePin;
use OpenCompany\Integrations\Pinterest\Tools\PinterestDeletePin;
use OpenCompany\Integrations\Pinterest\Tools\PinterestGetCurrentUser;
use OpenCompany\Integrations\Pinterest\Tools\PinterestGetBoard;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListBoards;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListPins;

class PinterestToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'pinterest';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'boards, pins, user',
            'description' => 'Visual discovery and bookmarking',
            'icon' => 'ph:pinterest-logo',
            'logo' => 'simple-icons:pinterest',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pinterest',
            'description' => 'Manage boards and pins on Pinterest',
            'icon' => 'ph:pinterest-logo',
            'logo' => 'simple-icons:pinterest',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://developers.pinterest.com/docs/getting-started/introduction/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Pinterest access token',
                'hint' => 'Generate an access token in your Pinterest developer app settings',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pinterest.com/v5',
                'hint' => 'The Pinterest v5 API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.pinterest.com/v5',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.pinterest.com/v5', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user_account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pinterest API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Pinterest API returned an error: {$error}",
                ];
            }

            $username = $json['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Pinterest as @{$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'pinterest_list_boards' => [
                'class' => PinterestListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List all boards for the authenticated Pinterest user.',
                'icon' => 'ph:squares-four',
            ],
            'pinterest_get_board' => [
                'class' => PinterestGetBoard::class,
                'type' => 'read',
                'name' => 'Get Board',
                'description' => 'Get details for a specific Pinterest board.',
                'icon' => 'ph:squares-four',
            ],
            'pinterest_create_board' => [
                'class' => PinterestCreateBoard::class,
                'type' => 'write',
                'name' => 'Create Board',
                'description' => 'Create a new Pinterest board.',
                'icon' => 'ph:plus-square',
            ],
            'pinterest_list_pins' => [
                'class' => PinterestListPins::class,
                'type' => 'read',
                'name' => 'List Pins',
                'description' => 'List pins on a specific Pinterest board.',
                'icon' => 'ph:pin',
            ],
            'pinterest_create_pin' => [
                'class' => PinterestCreatePin::class,
                'type' => 'write',
                'name' => 'Create Pin',
                'description' => 'Create a new pin on a Pinterest board.',
                'icon' => 'ph:pin',
            ],
            'pinterest_delete_pin' => [
                'class' => PinterestDeletePin::class,
                'type' => 'write',
                'name' => 'Delete Pin',
                'description' => 'Delete a pin from Pinterest.',
                'icon' => 'ph:trash',
            ],
            'pinterest_get_current_user' => [
                'class' => PinterestGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Pinterest user\'s account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pinterest.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pinterest.com/v5'],
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

            $service = new PinterestService(
                accessToken: $creds->get('pinterest', 'access_token', '', $account),
                baseUrl: $creds->get('pinterest', 'base_url', 'https://api.pinterest.com/v5', $account),
            );

            return new $class($service);
        }

        return new $class(app(PinterestService::class));
    }
}
