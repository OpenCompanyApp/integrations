# Zendesk Sell Integration

Zendesk Sell integration for OpenCompany and KosmoKrator agents. It wraps the
official Sales CRM v2 Core API for contacts, leads, deals, activities, products,
users, pipelines, stages, and source/reason reference data.

Official API docs: <https://developer.zendesk.com/api-reference/sales-crm/resources/introduction/>

## Configuration

Zendesk Sell uses bearer-token authentication.

```php
return [
    'zendesk-sell' => [
        'access_token' => env('ZENDESK_SELL_ACCESS_TOKEN'),
        'url' => env('ZENDESK_SELL_URL', 'https://api.getbase.com'),
    ],
];
```

## Coverage

The package exposes focused tools for:

- Contacts: list, get, create, update, delete, and upsert.
- Leads: list, get, create, update, delete, and upsert.
- Deals: list, get, create, update, delete, and upsert.
- Activities: notes and tasks with list, get, create, update, and delete.
- Products: list, get, create, update, and delete.
- Metadata: users, pipelines, stages, deal sources, lead sources, and loss
  reasons.

Create, update, and upsert tools send Zendesk Sell's documented
`{ "data": ... }` request body envelope.

## Examples

```js
local deals = app.integrations["zendesk-sell"].list_deals({
  page = 1,
  per_page = 25,
  status = "open"
})

local task = app.integrations["zendesk-sell"].create_task({
  content = "Send renewal proposal",
  resource_type = "deal",
  resource_id = 12345,
  due_date = "2026-05-20"
})

local lead = app.integrations["zendesk-sell"].upsert_lead({
  email = "ada@example.test",
  last_name = "Example",
  first_name = "Ada",
  organization_name = "Example Co"
})
```

## Development

```console
find packages/zendesk-sell/src tests/ZendeskSell -name '*.php' -print0 | xargs -0 -n1 php -l
composer validate packages/zendesk-sell/composer.json
php build-catalog.php
```

Tests use fake hosts and fake tokens only.

## License

MIT
