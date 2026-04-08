# Zoho Invoice Integration

Integration with [Zoho Invoice](https://www.zoho.com/invoice/) for managing invoices, contacts, items, and payments.

## Installation

```bash
composer require opencompanyapp/integration-zoho-invoice
```

## Configuration

Add to your `config/ai-tools.php`:

```php
'zoho_invoice' => [
    'access_token'     => env('ZOHO_INVOICE_ACCESS_TOKEN'),
    'base_url'         => env('ZOHO_INVOICE_BASE_URL', 'https://invoice.zoho.com/api/v3'),
    'organization_id'  => env('ZOHO_INVOICE_ORGANIZATION_ID', ''),
],
```

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `zohoinvoice_list_invoices` | read | List invoices with filters (status, customer, date range) |
| `zohoinvoice_get_invoice` | read | Get a single invoice by ID |
| `zohoinvoice_create_invoice` | write | Create a new invoice |
| `zohoinvoice_list_contacts` | read | List contacts (customers and vendors) |
| `zohoinvoice_list_items` | read | List items (products and services) |
| `zohoinvoice_list_payments` | read | List payments received |
| `zohoinvoice_get_current_user` | read | Get the authenticated user's profile |

## Authentication

This integration uses a Zoho OAuth access token. Generate one from the [Zoho API Console](https://api-console.zoho.com).

## Base URL

The default base URL is `https://invoice.zoho.com/api/v3`. If your organization is in a different region, update the base URL:

- **EU**: `https://invoice.zoho.eu/api/v3`
- **India**: `https://invoice.zoho.in/api/v3`
- **Australia**: `https://invoice.zoho.com.au/api/v3`
- **Japan**: `https://invoice.zoho.jp/api/v3`

## License

MIT
