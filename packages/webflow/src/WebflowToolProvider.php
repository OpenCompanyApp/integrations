<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Webflow\Tools\WebflowCreateItem;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetCurrentUser;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetItem;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetSite;
use OpenCompany\Integrations\Webflow\Tools\WebflowListCollections;
use OpenCompany\Integrations\Webflow\Tools\WebflowListItems;
use OpenCompany\Integrations\Webflow\Tools\WebflowListSites;

class WebflowToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'webflow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sites, collections, items',
            'description' => 'CMS management',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:webflow',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Webflow',
            'description' => 'Design-driven CMS — manage sites, collections, and items',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:webflow',
            'category' => 'cms',
            'badge' => 'verified',
            'docs_url' => 'https://developers.webflow.com/data/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Webflow access token',
                'hint' => 'Generate an access token in your Webflow project settings under "Integrations" or use an OAuth app',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.webflow.com',
                'hint' => 'Use <code>https://api.webflow.com</code> for the standard Webflow API',
                'default' => 'https://api.webflow.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.webflow.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Webflow API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? 'Unknown error';

                return [
                    'success' => false,
                    'error' => "Webflow API error: {$error}",
                ];
            }

            $user = $json['user'] ?? $json;

            return [
                'success' => true,
                'message' => "Connected to Webflow API as " . ($user['email'] ?? 'authenticated user') . ".",
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
            'webflow_list_sites' => [
                'class' => WebflowListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all Webflow sites the authenticated user has access to.',
                'icon' => 'ph:globe',
            ],
            'webflow_get_site' => [
                'class' => WebflowGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific Webflow site.',
                'icon' => 'ph:globe',
            ],
            'webflow_list_collections' => [
                'class' => WebflowListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List CMS collections for a Webflow site.',
                'icon' => 'ph:folders',
            ],
            'webflow_list_items' => [
                'class' => WebflowListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items in a Webflow CMS collection.',
                'icon' => 'ph:list',
            ],
            'webflow_get_item' => [
                'class' => WebflowGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get a single CMS item from a collection.',
                'icon' => 'ph:file-text',
            ],
            'webflow_create_item' => [
                'class' => WebflowCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item in a Webflow CMS collection.',
                'icon' => 'ph:plus',
            ],
            'webflow_get_current_user' => [
                'class' => WebflowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Webflow user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/webflow.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.webflow.com'],
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

            $service = new WebflowService(
                accessToken: $creds->get('webflow', 'access_token', '', $account),
                baseUrl: $creds->get('webflow', 'url', 'https://api.webflow.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(WebflowService::class));
    }
}
