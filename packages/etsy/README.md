# Integration: Etsy

> Etsy Open API v3 integration for Laravel agents. Manage shops, listings, listing images, inventory, receipts, shipping profiles, sections, taxonomy, and documented fallback endpoints.

Give AI agents a structured interface to an Etsy seller account through the official Etsy Open API. The package keeps common shop operations as first-class tools and includes guarded generic helpers for documented endpoints that are not yet promoted to dedicated wrappers.

## Installation

```console
composer require opencompanyapp/integration-etsy
```

Laravel auto-discovers the service provider.

## Configuration

Etsy private shop operations require an OAuth access token, an Etsy app keystring for the `x-api-key` header, and the shop ID.

```php
return [
    'etsy' => [
        'access_token' => env('ETSY_ACCESS_TOKEN'),
        'api_key'      => env('ETSY_API_KEY'),
        'shop_id'      => env('ETSY_SHOP_ID'),
        'base_url'     => env('ETSY_BASE_URL', 'https://openapi.etsy.com/v3/application'),
    ],
];
```

`api_key` is optional for older single-secret host configs: when omitted, the integration falls back to using `access_token` as `x-api-key`. New installs should provide both values.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `etsy_get_shop` | read | Get the configured shop profile. |
| `etsy_list_listings` | read | List shop listings with state and pagination filters. |
| `etsy_get_listing` | read | Get one listing by ID. |
| `etsy_create_listing` | write | Create a draft listing in the configured shop. |
| `etsy_update_listing` | write | Update listing fields such as title, price, quantity, state, section, or shipping profile. |
| `etsy_delete_listing` | write | Delete a listing from the configured shop. |
| `etsy_list_listing_images` | read | List images attached to a listing. |
| `etsy_upload_listing_image` | write | Upload a local image file to a listing. |
| `etsy_get_listing_inventory` | read | Get listing products, offerings, SKUs, prices, and quantities. |
| `etsy_update_listing_inventory` | write | Update listing inventory products and offerings. |
| `etsy_list_orders` | read | List shop receipts/orders with pagination and paid/shipped filters. |
| `etsy_get_receipt` | read | Get one receipt/order. |
| `etsy_list_receipt_transactions` | read | List transaction line items for a receipt. |
| `etsy_list_shop_sections` | read | List shop sections. |
| `etsy_list_shipping_profiles` | read | List shipping profiles. |
| `etsy_list_seller_taxonomy_nodes` | read | List seller taxonomy nodes for listing categories. |
| `etsy_get_current_user` | read | Get the authenticated Etsy user. |
| `etsy_api_get` | read | Call a documented Etsy GET endpoint relative to the configured base URL. |
| `etsy_api_post` | write | Call a documented Etsy POST endpoint relative to the configured base URL. |
| `etsy_api_put` | write | Call a documented Etsy PUT endpoint relative to the configured base URL. |
| `etsy_api_delete` | write | Call a documented Etsy DELETE endpoint relative to the configured base URL. |

## Service Usage

```php
use OpenCompany\Integrations\Etsy\EtsyService;

$service = app(EtsyService::class);

$shop = $service->getShop();
$listings = $service->listListings(['state' => 'active', 'limit' => 25]);
$listing = $service->getListing(1234567890);

$draft = $service->createListing([
    'title' => 'Handmade Ceramic Mug',
    'description' => 'A wheel-thrown mug with a blue glaze.',
    'price' => 28.00,
    'quantity' => 10,
    'shipping_profile_id' => 567890,
    'taxonomy_id' => 1234,
    'who_made' => 'i_did',
    'when_made' => 'made_to_order',
    'is_supply' => false,
]);

$updated = $service->updateListing(1234567890, [
    'title' => 'Updated Ceramic Mug',
    'state' => 'active',
]);

$inventory = $service->getListingInventory(1234567890);
$orders = $service->listOrders(['was_paid' => true, 'was_shipped' => false]);
$shippingProfiles = $service->listShippingProfiles();
```

## Generic Endpoint Helpers

Use generic helpers only for documented Etsy Open API endpoints that are not yet first-class tools:

```php
$taxonomy = $service->apiGet('/seller-taxonomy/nodes');
$response = $service->apiPut('/listings/1234567890/inventory', [
    'products' => [],
]);
```

Absolute URLs are rejected so agents cannot bypass the configured Etsy API host.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- Etsy seller account, OAuth token, app keystring, and shop ID

## License

MIT - see [LICENSE](LICENSE).
