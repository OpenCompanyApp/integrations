<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Webflow\Tools\WebflowCreateItem;
use OpenCompany\Integrations\Webflow\Tools\WebflowCreateWebhook;
use OpenCompany\Integrations\Webflow\Tools\WebflowDeleteItem;
use OpenCompany\Integrations\Webflow\Tools\WebflowDeleteWebhook;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetCollection;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetCurrentUser;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetItem;
use OpenCompany\Integrations\Webflow\Tools\WebflowGetSite;
use OpenCompany\Integrations\Webflow\Tools\WebflowListAssets;
use OpenCompany\Integrations\Webflow\Tools\WebflowListCollections;
use OpenCompany\Integrations\Webflow\Tools\WebflowListItems;
use OpenCompany\Integrations\Webflow\Tools\WebflowListSites;
use OpenCompany\Integrations\Webflow\Tools\WebflowListWebhooks;
use OpenCompany\Integrations\Webflow\Tools\WebflowPublishSite;
use OpenCompany\Integrations\Webflow\Tools\WebflowUpdateItem;

/**
 * Registers all available Webflow tools and provides integration metadata, configuration schema, and connection testing.
 */
class WebflowToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'webflow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'cms, website builder',
            'description' => 'Website & CMS management',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:webflow',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Webflow',
            'description' => 'Sites, collections, items, webhooks, and assets',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:webflow',
            'category' => 'cms',
            'badge' => 'verified',
            'docs_url' => 'https://developers.webflow.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'Your Webflow API token',
                'hint' => 'Generate a personal access token in your <a href="https://webflow.com/dashboard/account/sites" target="_blank">Webflow account settings</a>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Generate one in Webflow → Account Settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'accept-version' => '2.0',
            ])->timeout(10)->get('https://api.webflow.com/v2/user');

            if ($response->successful()) {
                $data = $response->json();
                $email = $data['email'] ?? 'Unknown user';

                return [
                    'success' => true,
                    'message' => "Connected to Webflow as \"{$email}\".",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Webflow API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Sites
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
            'webflow_publish_site' => [
                'class' => WebflowPublishSite::class,
                'type' => 'write',
                'name' => 'Publish Site',
                'description' => 'Publish a Webflow site.',
                'icon' => 'ph:rocket-launch',
            ],
            // Collections
            'webflow_list_collections' => [
                'class' => WebflowListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all collections for a Webflow site.',
                'icon' => 'ph:folder',
            ],
            'webflow_get_collection' => [
                'class' => WebflowGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get a Webflow collection by its ID.',
                'icon' => 'ph:folder',
            ],
            // Items
            'webflow_list_items' => [
                'class' => WebflowListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items in a Webflow collection.',
                'icon' => 'ph:list',
            ],
            'webflow_get_item' => [
                'class' => WebflowGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get a single item from a Webflow collection.',
                'icon' => 'ph:file-text',
            ],
            'webflow_create_item' => [
                'class' => WebflowCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item in a Webflow collection.',
                'icon' => 'ph:plus-circle',
            ],
            'webflow_update_item' => [
                'class' => WebflowUpdateItem::class,
                'type' => 'write',
                'name' => 'Update Item',
                'description' => 'Update an existing item in a Webflow collection.',
                'icon' => 'ph:pencil-simple',
            ],
            'webflow_delete_item' => [
                'class' => WebflowDeleteItem::class,
                'type' => 'write',
                'name' => 'Delete Item',
                'description' => 'Delete an item from a Webflow collection.',
                'icon' => 'ph:trash',
            ],
            // Webhooks
            'webflow_list_webhooks' => [
                'class' => WebflowListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List all webhooks for a Webflow site.',
                'icon' => 'ph:webhooks-logo',
            ],
            'webflow_create_webhook' => [
                'class' => WebflowCreateWebhook::class,
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a webhook for a Webflow site.',
                'icon' => 'ph:webhooks-logo',
            ],
            'webflow_delete_webhook' => [
                'class' => WebflowDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a webhook from a Webflow site.',
                'icon' => 'ph:webhooks-logo',
            ],
            // Users
            'webflow_get_current_user' => [
                'class' => WebflowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Webflow user.',
                'icon' => 'ph:user',
            ],
            // Assets
            'webflow_list_assets' => [
                'class' => WebflowListAssets::class,
                'type' => 'read',
                'name' => 'List Assets',
                'description' => 'List all assets for a Webflow site.',
                'icon' => 'ph:image',
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
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the WebflowService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): WebflowService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new WebflowService(
                apiKey: $creds->get('webflow', 'api_key', '', $account),
            );
        }

        return app(WebflowService::class);
    }
}
