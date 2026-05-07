# Freshworks CRM Integration

Freshworks CRM integration for OpenCompany agents. It exposes Freshsales/Freshworks CRM contacts, sales accounts, deals, tasks, appointments, notes, phone call logs, sales activities, search, lookup, filters, and field metadata through one tool per API operation.

## Install

```bash
composer require opencompanyapp/integration-freshworks-crm
```

## Configuration

```php
'freshworks_crm' => [
    'api_key' => env('FRESHWORKS_CRM_API_KEY'),
    'domain' => env('FRESHWORKS_CRM_DOMAIN'),
    'base_url' => env('FRESHWORKS_CRM_BASE_URL'),
],
```

If `base_url` is omitted, the provider builds `https://{domain}.myfreshworks.com/crm/sales`.

## Tool Coverage

| Area | Tools |
| --- | --- |
| Contacts | `freshworks_crm_list_contacts`, `freshworks_crm_get_contact`, `freshworks_crm_create_contact`, `freshworks_crm_update_contact`, `freshworks_crm_delete_contact`, `freshworks_crm_list_contact_filters`, `freshworks_crm_get_contact_view`, `freshworks_crm_bulk_upsert_contacts` |
| Sales accounts | `freshworks_crm_list_accounts`, `freshworks_crm_get_account`, `freshworks_crm_create_account`, `freshworks_crm_update_account`, `freshworks_crm_delete_account`, `freshworks_crm_list_account_filters`, `freshworks_crm_bulk_upsert_accounts` |
| Deals | `freshworks_crm_list_deals`, `freshworks_crm_get_deal`, `freshworks_crm_create_deal`, `freshworks_crm_update_deal`, `freshworks_crm_delete_deal`, `freshworks_crm_list_deal_filters`, `freshworks_crm_get_deal_view`, `freshworks_crm_bulk_upsert_deals` |
| Tasks | `freshworks_crm_list_tasks`, `freshworks_crm_get_task`, `freshworks_crm_create_task`, `freshworks_crm_update_task`, `freshworks_crm_delete_task` |
| Appointments | `freshworks_crm_list_appointments`, `freshworks_crm_get_appointment`, `freshworks_crm_create_appointment`, `freshworks_crm_update_appointment`, `freshworks_crm_delete_appointment` |
| Notes and calls | `freshworks_crm_create_note`, `freshworks_crm_get_note`, `freshworks_crm_update_note`, `freshworks_crm_delete_note`, `freshworks_crm_create_phone_call` |
| Sales activities | `freshworks_crm_list_sales_activities`, `freshworks_crm_get_sales_activity`, `freshworks_crm_create_sales_activity`, `freshworks_crm_update_sales_activity`, `freshworks_crm_delete_sales_activity` |
| Search and metadata | `freshworks_crm_get_current_user`, `freshworks_crm_search`, `freshworks_crm_lookup`, `freshworks_crm_filtered_search_contact`, `freshworks_crm_list_contact_fields`, `freshworks_crm_list_account_fields`, `freshworks_crm_list_deal_fields`, `freshworks_crm_list_sales_activity_fields` |

## Notes

- The API base URL should end with `/crm/sales`.
- Freshworks CRM module create/update requests are wrapped under their documented root keys, such as `contact`, `deal`, `task`, and `appointment`.
- Lua usage examples live in `lua-docs/freshworks-crm.md`.

## License

MIT
