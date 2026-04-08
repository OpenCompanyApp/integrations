<?php

namespace OpenCompany\Integrations\Beamer;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Beamer\Tools\BeamerListPosts;
use OpenCompany\Integrations\Beamer\Tools\BeamerGetPost;
use OpenCompany\Integrations\Beamer\Tools\BeamerCreatePost;
use OpenCompany\Integrations\Beamer\Tools\BeamerListComments;
use OpenCompany\Integrations\Beamer\Tools\BeamerGetCurrentUser;
use OpenCompany\Integrations\Beamer\Tools\BeamerListCategories;

class BeamerToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'beamer';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'posts, comments, categories',
            'description' => 'Changelog & announcements',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:beamer',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Beamer',
            'description' => 'Changelog, announcements, and user notifications platform',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:beamer',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://www.getbeamer.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Beamer API key',
                'hint' => 'Find your API key in Beamer Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getbeamer.com/v0',
                'hint' => 'Override only if using a custom Beamer instance',
                'default' => 'https://api.getbeamer.com/v0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getbeamer.com/v0', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Beamer API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            $name = trim(($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Beamer API as {$name}.",
            ];
        } catch (\Exception $e) {
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
            'beamer_list_posts' => [
                'class' => BeamerListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List changelog posts and announcements.',
                'icon' => 'ph:list',
            ],
            'beamer_get_post' => [
                'class' => BeamerGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Retrieve a single post by ID.',
                'icon' => 'ph:article',
            ],
            'beamer_create_post' => [
                'class' => BeamerCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new changelog post or announcement.',
                'icon' => 'ph:plus-circle',
            ],
            'beamer_list_comments' => [
                'class' => BeamerListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on a specific post.',
                'icon' => 'ph:chat-circle',
            ],
            'beamer_get_current_user' => [
                'class' => BeamerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Beamer user profile.',
                'icon' => 'ph:user-circle',
            ],
            'beamer_list_categories' => [
                'class' => BeamerListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List all post categories.',
                'icon' => 'ph:folder',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/beamer.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Beamer API URL', 'required' => false, 'default' => 'https://api.getbeamer.com/v0'],
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

            $service = new BeamerService(
                apiKey: $creds->get('beamer', 'api_key', '', $account),
                baseUrl: $creds->get('beamer', 'url', 'https://api.getbeamer.com/v0', $account),
            );

            return new $class($service);
        }

        return new $class(app(BeamerService::class));
    }
}
