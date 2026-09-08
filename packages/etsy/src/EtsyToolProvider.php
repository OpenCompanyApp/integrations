<?php

namespace OpenCompany\Integrations\Etsy;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Etsy\Tools\EtsyApiDelete;
use OpenCompany\Integrations\Etsy\Tools\EtsyApiGet;
use OpenCompany\Integrations\Etsy\Tools\EtsyApiPost;
use OpenCompany\Integrations\Etsy\Tools\EtsyApiPut;
use OpenCompany\Integrations\Etsy\Tools\EtsyCreateListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyDeleteListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetCurrentUser;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetListingInventory;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetReceipt;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetShop;
use OpenCompany\Integrations\Etsy\Tools\EtsyListListingImages;
use OpenCompany\Integrations\Etsy\Tools\EtsyListListings;
use OpenCompany\Integrations\Etsy\Tools\EtsyListOrders;
use OpenCompany\Integrations\Etsy\Tools\EtsyListReceiptTransactions;
use OpenCompany\Integrations\Etsy\Tools\EtsyListSellerTaxonomyNodes;
use OpenCompany\Integrations\Etsy\Tools\EtsyListShippingProfiles;
use OpenCompany\Integrations\Etsy\Tools\EtsyListShopSections;
use OpenCompany\Integrations\Etsy\Tools\EtsyUpdateListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyUpdateListingInventory;
use OpenCompany\Integrations\Etsy\Tools\EtsyUploadListingImage;

/**
 * Exposes Etsy tools and credential metadata to host applications.
 */
class EtsyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [
                    'Etsy requires both an OAuth bearer token and the app keystring in the x-api-key header. Older single-secret configs fall back to using access_token as x-api-key.',
                ],
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
        return 'etsy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Etsy',
            'description' => 'Etsy shop management',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:etsy',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Etsy',
            'description' => 'Manage Etsy shops, listings, images, inventory, receipts, shipping profiles, sections, and taxonomy.',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:etsy',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.etsy.com/documentation/reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'OAuth Access Token',
                'placeholder' => 'Enter your Etsy OAuth access token',
                'hint' => 'OAuth token with the scopes needed for the tools you plan to use.',
                'required' => true,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'App API Key',
                'placeholder' => 'Enter your Etsy app keystring',
                'hint' => 'The x-api-key value from the Etsy developer console.',
                'required' => false,
            ],
            [
                'key' => 'shop_id',
                'type' => 'string',
                'label' => 'Shop ID',
                'placeholder' => '123456789',
                'hint' => 'Your Etsy shop ID.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://openapi.etsy.com/v3/application',
                'hint' => 'Etsy Open API base URL. api.etsy.com and openapi.etsy.com are both documented by Etsy.',
                'default' => 'https://openapi.etsy.com/v3/application',
            ],
        ];
    }

    /**
     * Verify the access token by fetching the authenticated user.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = trim((string) ($config['access_token'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $service = new EtsyService(
                accessToken: $accessToken,
                shopId: (string) ($config['shop_id'] ?? ''),
                baseUrl: (string) ($config['base_url'] ?? 'https://openapi.etsy.com/v3/application'),
                apiKey: (string) ($config['api_key'] ?? ''),
            );
            $json = $service->getCurrentUser();

            $userId = $json['user_id'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Etsy API as user ID {$userId}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'api_key' => 'nullable|string',
            'shop_id' => 'required|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'etsy_get_shop' => ['class' => EtsyGetShop::class, 'type' => 'read', 'name' => 'Get Shop', 'description' => 'Get configured Etsy shop profile.', 'icon' => 'ph:storefront'],
            'etsy_list_listings' => ['class' => EtsyListListings::class, 'type' => 'read', 'name' => 'List Listings', 'description' => 'List shop listings.', 'icon' => 'ph:list'],
            'etsy_get_listing' => ['class' => EtsyGetListing::class, 'type' => 'read', 'name' => 'Get Listing', 'description' => 'Get one listing.', 'icon' => 'ph:package'],
            'etsy_create_listing' => ['class' => EtsyCreateListing::class, 'type' => 'write', 'name' => 'Create Listing', 'description' => 'Create a draft listing.', 'icon' => 'ph:plus-circle'],
            'etsy_update_listing' => ['class' => EtsyUpdateListing::class, 'type' => 'write', 'name' => 'Update Listing', 'description' => 'Update a listing.', 'icon' => 'ph:pencil-simple'],
            'etsy_delete_listing' => ['class' => EtsyDeleteListing::class, 'type' => 'write', 'name' => 'Delete Listing', 'description' => 'Delete a listing.', 'icon' => 'ph:trash'],
            'etsy_list_listing_images' => ['class' => EtsyListListingImages::class, 'type' => 'read', 'name' => 'List Listing Images', 'description' => 'List listing images.', 'icon' => 'ph:image'],
            'etsy_upload_listing_image' => ['class' => EtsyUploadListingImage::class, 'type' => 'write', 'name' => 'Upload Listing Image', 'description' => 'Upload a listing image.', 'icon' => 'ph:image-square'],
            'etsy_get_listing_inventory' => ['class' => EtsyGetListingInventory::class, 'type' => 'read', 'name' => 'Get Listing Inventory', 'description' => 'Get listing inventory.', 'icon' => 'ph:warehouse'],
            'etsy_update_listing_inventory' => ['class' => EtsyUpdateListingInventory::class, 'type' => 'write', 'name' => 'Update Listing Inventory', 'description' => 'Update listing inventory.', 'icon' => 'ph:warehouse'],
            'etsy_list_orders' => ['class' => EtsyListOrders::class, 'type' => 'read', 'name' => 'List Orders', 'description' => 'List receipts/orders.', 'icon' => 'ph:receipt'],
            'etsy_get_receipt' => ['class' => EtsyGetReceipt::class, 'type' => 'read', 'name' => 'Get Receipt', 'description' => 'Get one receipt/order.', 'icon' => 'ph:receipt'],
            'etsy_list_receipt_transactions' => ['class' => EtsyListReceiptTransactions::class, 'type' => 'read', 'name' => 'List Receipt Transactions', 'description' => 'List receipt line items.', 'icon' => 'ph:list-checks'],
            'etsy_list_shop_sections' => ['class' => EtsyListShopSections::class, 'type' => 'read', 'name' => 'List Shop Sections', 'description' => 'List shop sections.', 'icon' => 'ph:folders'],
            'etsy_list_shipping_profiles' => ['class' => EtsyListShippingProfiles::class, 'type' => 'read', 'name' => 'List Shipping Profiles', 'description' => 'List shop shipping profiles.', 'icon' => 'ph:truck'],
            'etsy_list_seller_taxonomy_nodes' => ['class' => EtsyListSellerTaxonomyNodes::class, 'type' => 'read', 'name' => 'List Seller Taxonomy Nodes', 'description' => 'List seller taxonomy nodes.', 'icon' => 'ph:tree-structure'],
            'etsy_get_current_user' => ['class' => EtsyGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get authenticated Etsy user.', 'icon' => 'ph:user-circle'],
            'etsy_api_get' => ['class' => EtsyApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call an Etsy GET endpoint.', 'icon' => 'ph:terminal-window'],
            'etsy_api_post' => ['class' => EtsyApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call an Etsy POST endpoint.', 'icon' => 'ph:terminal-window'],
            'etsy_api_put' => ['class' => EtsyApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call an Etsy PUT endpoint.', 'icon' => 'ph:terminal-window'],
            'etsy_api_delete' => ['class' => EtsyApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call an Etsy DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/etsy.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'App API Key', 'required' => false],
            ['key' => 'shop_id', 'type' => 'string', 'label' => 'Shop ID', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://openapi.etsy.com/v3/application'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Etsy service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): EtsyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new EtsyService(
                accessToken: $creds->get('etsy', 'access_token', '', $account),
                shopId: $creds->get('etsy', 'shop_id', '', $account),
                baseUrl: $creds->get('etsy', 'base_url', 'https://openapi.etsy.com/v3/application', $account),
                apiKey: $creds->get('etsy', 'api_key', '', $account),
            );
        }

        return app(EtsyService::class);
    }
}
