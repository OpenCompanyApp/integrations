# Magento Integration

Magento is an open-source e-commerce platform that enables online merchants to manage products, orders, customers, and more.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | Yes | Your Magento API access token. Generate one in Magento Admin under **System → Integrations** or via OAuth. |
| `url` | url | No | API base URL. Default: `https://api.magento.com/v1`. |

## Authentication

All requests use Bearer token authentication via the `Authorization: Bearer <token>` header. The access token must have the appropriate permissions for the endpoints you intend to use.

## Tools

### magento_list_products

List products from the Magento catalog.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search_criteria` | string | No | Search criteria filter expression (e.g., `"name:like:%shirt%"`). |
| `page_size` | integer | No | Number of products per page (default: 20). |
| `current_page` | integer | No | Current page number for pagination (starts at 1). |

**Example:**

```js
magento_list_products({ page_size: 50, current_page: 1 })
```
---

### magento_get_product

Get details of a specific product by its SKU.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sku` | string | Yes | The product SKU (Stock Keeping Unit) to retrieve. |

**Example:**

```js
magento_get_product({ sku: "WSH01-XS-Red" })
```
---

### magento_create_product

Create a new product in the Magento catalog.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sku` | string | Yes | Unique product SKU. |
| `name` | string | Yes | Product name. |
| `price` | number | Yes | Product price (e.g., `29.99`). |
| `attribute_set_id` | integer | No | Attribute set ID (default: 4 for Default). |
| `type_id` | string | No | Product type (`simple`, `configurable`, `virtual`, etc.). Default: `"simple"`. |
| `weight` | number | No | Product weight. |
| `description` | string | No | Full product description. |
| `short_description` | string | No | Short product description. |
| `visibility` | integer | No | Visibility (1=Not Visible, 2=Catalog, 3=Search, 4=Catalog & Search). Default: 4. |
| `status` | integer | No | Product status (1=Enabled, 2=Disabled). Default: 1. |

**Example:**

```js
magento_create_product({
    sku: "TSHIRT-001",
    name: "Cotton T-Shirt",
    price: 29.99,
    type_id: "simple",
    description: "A comfortable cotton t-shirt.",
})
```
---

### magento_list_orders

List orders from the Magento store.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search_criteria` | string | No | Search criteria filter expression (e.g., `"status:pending"`). |
| `page_size` | integer | No | Number of orders per page (default: 20). |
| `current_page` | integer | No | Current page number for pagination (starts at 1). |

**Example:**

```js
magento_list_orders({ page_size: 50, current_page: 1 })
```
---

### magento_get_order

Get details of a specific order by its ID.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | Yes | The order increment ID or entity ID. |

**Example:**

```js
magento_get_order({ order_id: "000000001" })
```
---

### magento_list_customers

List customers from the Magento store.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search_criteria` | string | No | Search criteria filter expression. |
| `page_size` | integer | No | Number of customers per page (default: 20). |
| `current_page` | integer | No | Current page number for pagination (starts at 1). |

**Example:**

```js
magento_list_customers({ page_size: 50, current_page: 1 })
```
---

### magento_get_current_user

Verify Magento API connectivity and get current user information. Useful as a health check.

**Parameters:** None.

**Example:**

```js
magento_get_current_user()
```
---

## Notes

- The `sku` is Magento's unique product identifier.
- Search criteria follow Magento's REST API filter syntax.
- Product prices are in the store's base currency.
- Always use the correct base URL for your Magento instance.
