# Integration: Baserow

Expose Baserow database operations to OpenCompany and KosmoKrator agents through the official Baserow REST API.

## Coverage

This package covers the main database API surface agents need for structured data work:

- databases and table discovery
- table metadata
- field listing, inspection, creation, updates, and deletion
- row list, get, create, update, move, and delete
- batch row create, update, and delete
- current user checks
- safe raw relative API helpers for API endpoints not yet wrapped by a dedicated tool

The legacy `baserow_list_tables` slug is preserved for compatibility, but it lists rows in a table. New agents should use `baserow_list_rows` for row listing and `baserow_list_database_tables` for table discovery.

## Configuration

```php
return [
    'baserow' => [
        'access_token' => env('BASEROW_ACCESS_TOKEN'),
        'auth_scheme'  => env('BASEROW_AUTH_SCHEME', 'Token'),
        'url'          => env('BASEROW_URL', 'https://api.baserow.io'),
    ],
];
```

Baserow database tokens use the `Token` authorization scheme. Some host-provisioned account tokens may require `JWT` or `Bearer`; the auth scheme is configurable for that reason.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `baserow_list_databases` | read | List databases available to the authenticated account |
| `baserow_list_all_tables` | read | List all tables visible to the configured database token |
| `baserow_list_database_tables` | read | List tables inside a specific database |
| `baserow_get_table` | read | Get table metadata |
| `baserow_list_fields` | read | List fields in a table |
| `baserow_get_field` | read | Get one field definition |
| `baserow_create_field` | write | Create a field |
| `baserow_update_field` | write | Update a field |
| `baserow_delete_field` | write | Delete a field |
| `baserow_list_rows` | read | List rows with filtering, search, sorting, and pagination |
| `baserow_list_tables` | read | Legacy row-listing slug |
| `baserow_get_row` | read | Get one row |
| `baserow_create_row` | write | Create one row |
| `baserow_update_row` | write | Update one row |
| `baserow_move_row` | write | Move one row |
| `baserow_delete_row` | write | Delete one row |
| `baserow_batch_create` | write | Create multiple rows |
| `baserow_batch_update` | write | Update multiple rows |
| `baserow_batch_delete` | write | Delete multiple rows |
| `baserow_get_current_user` | read | Get the authenticated user |
| `baserow_api_get` | read | Call a relative API path with GET |
| `baserow_api_post` | write | Call a relative API path with POST |
| `baserow_api_patch` | write | Call a relative API path with PATCH |
| `baserow_api_delete` | write | Call a relative API path with DELETE |

## Service Usage

```php
use OpenCompany\Integrations\Baserow\BaserowService;

$service = new BaserowService('token-test', 'https://api.baserow.io', 'Token');

$tables = $service->listDatabaseTables(123);
$fields = $service->listFields(456);
$rows = $service->listRows(456, ['user_field_names' => true, 'search' => 'Acme']);

$created = $service->createRow(456, [
    'Name' => 'Acme',
    'Status' => 'Active',
], ['user_field_names' => true]);
```

## Documentation

See the official Baserow REST API documentation at <https://baserow.io/api-docs>.

## License

MIT
