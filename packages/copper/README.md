# Copper CRM Integration

Copper CRM integration for OpenCompany agents. It exposes Copper people, companies, opportunities, leads, projects, tasks, activities, users, pipelines, statuses, tags, custom field definitions, and webhooks through one tool per API operation.

## Install

```bash
composer require opencompanyapp/integration-copper
```

## Configuration

Copper requires all API calls to include the API key, the `developer_api` application header, and the Copper account email.

```php
'copper' => [
    'api_key' => env('COPPER_API_KEY'),
    'email' => env('COPPER_ACCOUNT_EMAIL'),
    'url' => env('COPPER_API_URL', 'https://api.copper.com/developer_api/v1'),
],
```

## Tool Coverage

| Area | Tools |
| --- | --- |
| People / contacts | `copper_list_contacts`, `copper_get_contact`, `copper_get_contact_by_email`, `copper_create_contact`, `copper_update_contact`, `copper_delete_contact` |
| Companies | `copper_list_companies`, `copper_get_company`, `copper_create_company`, `copper_update_company`, `copper_delete_company` |
| Opportunities | `copper_list_opportunities`, `copper_get_opportunity`, `copper_create_opportunity`, `copper_update_opportunity`, `copper_delete_opportunity` |
| Leads | `copper_list_leads`, `copper_get_lead`, `copper_create_lead`, `copper_update_lead`, `copper_delete_lead` |
| Projects | `copper_list_projects`, `copper_get_project`, `copper_create_project`, `copper_update_project`, `copper_delete_project` |
| Tasks | `copper_list_tasks`, `copper_get_task`, `copper_create_task`, `copper_update_task`, `copper_delete_task` |
| Activities | `copper_list_activities`, `copper_get_activity`, `copper_create_activity`, `copper_update_activity`, `copper_delete_activity`, `copper_list_activity_types` |
| Users and account | `copper_get_current_user`, `copper_list_users`, `copper_get_user`, `copper_get_account_details` |
| Configuration | `copper_list_pipelines`, `copper_list_pipeline_stages`, `copper_list_pipeline_stages_in_pipeline`, `copper_list_lead_statuses`, `copper_list_customer_sources`, `copper_list_loss_reasons`, `copper_list_contact_types`, `copper_list_tags`, `copper_list_custom_field_definitions` |
| Webhooks | `copper_list_webhooks`, `copper_get_webhook`, `copper_create_webhook`, `copper_update_webhook`, `copper_delete_webhook` |

## Notes

- Copper's official API calls contact records "people". Existing contact-named tools are kept for compatibility and map to `/people` endpoints.
- Search endpoints use POST bodies and support Copper pagination fields such as `page_size` and `page_number`.
- The default API base URL is `https://api.copper.com/developer_api/v1`.
- Lua usage examples live in `lua-docs/copper.md`.

## License

MIT
