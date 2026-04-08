<?php

namespace OpenCompany\Integrations\Dub;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Dub\Tools\DubListLinks;
use OpenCompany\Integrations\Dub\Tools\DubGetLink;
use OpenCompany\Integrations\Dub\Tools\DubCreateLink;
use OpenCompany\Integrations\Dub\Tools\DubListDomains;
use OpenCompany\Integrations\Dub\Tools\DubGetDomain;
use OpenCompany\Integrations\Dub\Tools\DubListTags;
use OpenCompany\Integrations\Dub\Tools\DubGetCurrentUser;

class DubToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'dub';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'links, domains, tags',
            'description' => 'Link management',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:dub',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Dub.co',
            'description' => 'Short link management and analytics platform',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:dub',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://dub.co/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Dub.co API token',
                'hint' => 'Generate an API token in your Dub.co workspace settings under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.dub.co',
                'hint' => 'Use <code>https://api.dub.co</code> for the cloud API, or your self-hosted URL',
                'default' => 'https://api.dub.co',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.dub.co', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Dub.co API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['name'] ?? 'Unknown') ;
            $workspace = $json['default_workspace'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Dub.co API as {$userName}" . ($workspace ? " (workspace: {$workspace})" : '') . ".",
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
            'dub_list_links' => [
                'class' => DubListLinks::class,
                'type' => 'read',
                'name' => 'List Links',
                'description' => 'List short links with optional filtering.',
                'icon' => 'ph:list',
            ],
            'dub_get_link' => [
                'class' => DubGetLink::class,
                'type' => 'read',
                'name' => 'Get Link',
                'description' => 'Get details of a specific short link.',
                'icon' => 'ph:link',
            ],
            'dub_create_link' => [
                'class' => DubCreateLink::class,
                'type' => 'write',
                'name' => 'Create Link',
                'description' => 'Create a new short link.',
                'icon' => 'ph:plus-circle',
            ],
            'dub_list_domains' => [
                'class' => DubListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List configured domains.',
                'icon' => 'ph:globe',
            ],
            'dub_get_domain' => [
                'class' => DubGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details of a specific domain.',
                'icon' => 'ph:globe',
            ],
            'dub_list_tags' => [
                'class' => DubListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List link tags.',
                'icon' => 'ph:tag',
            ],
            'dub_get_current_user' => [
                'class' => DubGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/dub.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.dub.co'],
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

            $service = new DubService(
                accessToken: $creds->get('dub', 'access_token', '', $account),
                baseUrl: $creds->get('dub', 'base_url', 'https://api.dub.co', $account),
            );

            return new $class($service);
        }

        return new $class(app(DubService::class));
    }
}
