# Microsoft Ruby Script Documentation Review

Reviewed 2026-09-08 for the mruby migration. This review covers only the Ruby
examples in the five Microsoft packages below. It does not invoke Microsoft
Graph or any other provider API.

## Corrected callable contracts

| Package | Exact documented tool slug | Required workflow parameters |
| --- | --- | --- |
| Microsoft Entra ID | `microsoft_entra_id_users_user_list_user` | none |
| Microsoft Excel | `microsoft_excel_drives_items_workbook_list_worksheets` | `drive_id`, `drive_item_id` |
| Microsoft Excel | `microsoft_excel_drives_drive_items_drive_item_workbook_worksheets_workbook_worksheet_range_b0fa` | `drive_id`, `drive_item_id`, `workbook_worksheet_id`, `address` |
| Microsoft Intune | `microsoft_intune_device_management_list_managed_devices` | none |
| Microsoft Places | `microsoft_places_places_place_list_place_as_room` | none |
| Microsoft SharePoint | `microsoft_sharepoint_sites_site_list_site` | none |
| Microsoft SharePoint | `microsoft_sharepoint_sites_list_lists` | `site_id` |
| Microsoft SharePoint | `microsoft_sharepoint_sites_lists_list_items` | `site_id`, `list_id` |

Each Ruby example calls `app.call("integrations.<app>.<exact tool slug>",
keywords)` without placing an additional `app` segment inside the string. The
full slugs are intentional: generated Microsoft Graph display names collide,
and only the full catalog slug identifies the endpoint unambiguously.

## Normalized output contract

The inspected services return decoded Graph JSON unchanged. Collection calls
therefore expose Graph's `value` array and, when supplied, `@odata.nextLink`;
the examples read `result["value"] || []`. A JSON resource response is its
decoded resource object (for example Excel range `values`). Empty `202` and
`204` responses return `success: true` and `status`; Microsoft Places also
retains `location` for its empty/redirect-compatible responses. Non-JSON
SharePoint content remains `body`, `status`, and `content_type`.

## Evidence

- Provider catalog inspection verified every listed slug and every required
  workflow parameter against the five current `*ToolProvider::tools()` maps.
- The pinned `/Users/rutger/Sites/bowerbird-ruby-engine/target/debug/ruby-engine`
  compiled all five edited Ruby blocks successfully using the host autoloader
  at `/Users/rutger/Sites/opencompany-mruby/vendor/autoload.php`.

## Remaining limitation

This is contract and syntax validation only. It deliberately does not prove
tenant permissions, Graph response contents, pagination links, or write
behavior against a live Microsoft tenant.
