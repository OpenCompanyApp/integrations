# Avalara Lua Tools

Namespace: `avalara`

The Avalara package exposes AvaTax API operations from the official AvaTax REST API v2 Swagger document. Use these tools for tax calculation, transaction lifecycle work, companies, certificates, customers, items, locations, nexus, returns-adjacent records, subscriptions, users, definitions, and utility calls.

## Authentication Notes

Configure either `access_token` or both `account_id` and `license_key`. Use `base_url = "https://sandbox-rest.avatax.com"` for sandbox credentials. If `company_id` is configured, company-scoped tools can omit `company_id` when the official path parameter is `companyId` or `companyid`.

## Parameter Mapping

Tool parameters are snake_case. Avalara query names are restored before the HTTP request:

- `top` maps to `$top`
- `skip` maps to `$skip`
- `filter` maps to `$filter`
- `order_by` maps to `$orderBy`
- `include` maps to `$include`
- `company_id` maps to `companyId` or `companyid` in paths

Use `query` to pass additional documented query parameters by their original Avalara names. Use `body` for JSON request models on write operations.

## Examples

```lua
local ping = app.integrations.avalara.ping({})
print(ping.version)

local companies = app.integrations.avalara.query_companies({
  top = 25,
  filter = "isActive eq true"
})

local tax = app.integrations.avalara.create_transaction({
  include = "Summary,Addresses",
  body = {
    companyCode = "DEFAULT",
    type = "SalesOrder",
    customerCode = "CUST-100",
    lines = {
      { number = "1", quantity = 1, amount = 100.00, taxCode = "P0000000" }
    },
    addresses = {
      shipFrom = { line1 = "100 Main St", city = "Seattle", region = "WA", country = "US", postalCode = "98101" },
      shipTo = { line1 = "200 Market St", city = "Portland", region = "OR", country = "US", postalCode = "97201" }
    }
  }
})
```

## Common Tools

| Tool | Endpoint | Area |
|------|----------|------|
| `avalara_create_ap_config_setting` | POST `/api/v2/companies/{companyid}/apconfigsetting` | APConfigSetting |
| `avalara_get_ap_config_setting_by_company` | GET `/api/v2/companies/{companyid}/apconfigsetting` | APConfigSetting |
| `avalara_query_ap_config_setting` | GET `/api/v2/apconfigsetting` | APConfigSetting |
| `avalara_update_ap_config_setting` | PUT `/api/v2/companies/{companyid}/apconfigsetting` | APConfigSetting |
| `avalara_account_reset_license_key` | POST `/api/v2/accounts/{id}/resetlicensekey` | Accounts |
| `avalara_activate_account` | POST `/api/v2/accounts/{id}/activate` | Accounts |
| `avalara_audit_account` | GET `/api/v2/accounts/{id}/audit` | Accounts |
| `avalara_create_license_key` | POST `/api/v2/accounts/{id}/licensekey` | Accounts |
| `avalara_delete_license_key` | DELETE `/api/v2/accounts/{id}/licensekey/{licensekeyname}` | Accounts |
| `avalara_get_account` | GET `/api/v2/accounts/{id}` | Accounts |
| `avalara_get_account_configuration` | GET `/api/v2/accounts/{id}/configuration` | Accounts |
| `avalara_get_license_key` | GET `/api/v2/accounts/{id}/licensekey/{licensekeyname}` | Accounts |
| `avalara_get_license_keys` | GET `/api/v2/accounts/{id}/licensekeys` | Accounts |
| `avalara_list_mrs_accounts` | GET `/api/v2/accounts/mrs` | Accounts |
| `avalara_query_accounts` | GET `/api/v2/accounts` | Accounts |
| `avalara_set_account_configuration` | POST `/api/v2/accounts/{id}/configuration` | Accounts |
| `avalara_resolve_address` | GET `/api/v2/addresses/resolve` | Addresses |
| `avalara_resolve_address_post` | POST `/api/v2/addresses/resolve` | Addresses |
| `avalara_create_ava_file_forms` | POST `/api/v2/avafileforms` | AvaFileForms |
| `avalara_delete_ava_file_form` | DELETE `/api/v2/avafileforms/{id}` | AvaFileForms |
| `avalara_get_ava_file_form` | GET `/api/v2/avafileforms/{id}` | AvaFileForms |
| `avalara_query_ava_file_forms` | GET `/api/v2/avafileforms` | AvaFileForms |
| `avalara_update_ava_file_form` | PUT `/api/v2/avafileforms/{id}` | AvaFileForms |
| `avalara_cancel_batch` | POST `/api/v2/companies/{companyId}/batches/{id}/cancel` | Batches |
| `avalara_create_advanced_rules_batch` | POST `/api/v2/companies/{companyId}/batches/advancedrules` | Batches |
| `avalara_create_batches` | POST `/api/v2/companies/{companyId}/batches` | Batches |
| `avalara_create_item_import_batch` | POST `/api/v2/companies/{companyId}/batches/items` | Batches |
| `avalara_create_transaction_batch` | POST `/api/v2/companies/{companyId}/batches/transactions` | Batches |
| `avalara_delete_batch` | DELETE `/api/v2/companies/{companyId}/batches/{id}` | Batches |
| `avalara_download_batch` | GET `/api/v2/companies/{companyId}/batches/{batchId}/files/{id}/attachment` | Batches |
| `avalara_get_batch` | GET `/api/v2/companies/{companyId}/batches/{id}` | Batches |
| `avalara_list_batches_by_company` | GET `/api/v2/companies/{companyId}/batches` | Batches |
| `avalara_query_batches` | GET `/api/v2/batches` | Batches |
| `avalara_create_cert_express_invitation` | POST `/api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites` | CertExpressInvites |
| `avalara_get_cert_express_invitation` | GET `/api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites/{id}` | CertExpressInvites |
| `avalara_list_cert_express_invitations` | GET `/api/v2/companies/{companyId}/certexpressinvites` | CertExpressInvites |
| `avalara_create_certificates` | POST `/api/v2/companies/{companyId}/certificates` | Certificates |
| `avalara_delete_certificate` | DELETE `/api/v2/companies/{companyId}/certificates/{id}` | Certificates |
| `avalara_delete_certificate_custom_fields` | DELETE `/api/v2/companies/{companyId}/certificates/{id}/custom-fields` | Certificates |
| `avalara_download_certificate_image` | GET `/api/v2/companies/{companyId}/certificates/{id}/attachment` | Certificates |
| `avalara_get_certificate` | GET `/api/v2/companies/{companyId}/certificates/{id}` | Certificates |
| `avalara_get_certificate_setup` | GET `/api/v2/companies/{companyId}/certificates/setup` | Certificates |
| `avalara_link_attributes_to_certificate` | POST `/api/v2/companies/{companyId}/certificates/{id}/attributes/link` | Certificates |
| `avalara_link_customers_to_certificate` | POST `/api/v2/companies/{companyId}/certificates/{id}/customers/link` | Certificates |
| `avalara_list_attributes_for_certificate` | GET `/api/v2/companies/{companyId}/certificates/{id}/attributes` | Certificates |
| `avalara_list_custom_fields_for_certificate` | GET `/api/v2/companies/{companyId}/certificates/{id}/custom-fields` | Certificates |
| `avalara_list_customers_for_certificate` | GET `/api/v2/companies/{companyId}/certificates/{id}/customers` | Certificates |
| `avalara_query_certificates` | GET `/api/v2/companies/{companyId}/certificates` | Certificates |
| `avalara_request_certificate_setup` | POST `/api/v2/companies/{companyId}/certificates/setup` | Certificates |
| `avalara_unlink_attributes_from_certificate` | POST `/api/v2/companies/{companyId}/certificates/{id}/attributes/unlink` | Certificates |
| `avalara_unlink_customers_from_certificate` | POST `/api/v2/companies/{companyId}/certificates/{id}/customers/unlink` | Certificates |
| `avalara_update_certificate` | PUT `/api/v2/companies/{companyId}/certificates/{id}` | Certificates |
| `avalara_update_certificate_custom_fields` | PUT `/api/v2/companies/{companyId}/certificates/{id}/custom-fields` | Certificates |
| `avalara_upload_certificate_image` | POST `/api/v2/companies/{companyId}/certificates/{id}/attachment` | Certificates |
| `avalara_list_location_by_account` | GET `/api/v2/companies/{accountId}/clerk/locations` | Clerk |
| `avalara_get_communication_certificate` | GET `/companies/{companyId}/communication-certificates/{certificateId}` | CommunicationCertificates |
| `avalara_list_communication_certificates` | GET `/companies/{companyId}/communication-certificates` | CommunicationCertificates |
| `avalara_certify_integration` | GET `/api/v2/companies/{id}/certify` | Companies |
| `avalara_change_filing_status` | POST `/api/v2/companies/{id}/filingstatus` | Companies |
| `avalara_company_initialize` | POST `/api/v2/companies/initialize` | Companies |
| `avalara_create_companies` | POST `/api/v2/companies` | Companies |
| `avalara_create_company_parameters` | POST `/api/v2/companies/{companyId}/parameters` | Companies |
| `avalara_create_funding_request` | POST `/api/v2/companies/{id}/funding/setup` | Companies |
| `avalara_delete_company` | DELETE `/api/v2/companies/{id}` | Companies |
| `avalara_delete_company_parameter` | DELETE `/api/v2/companies/{companyId}/parameters/{id}` | Companies |
| `avalara_funding_configuration_by_company` | GET `/api/v2/companies/{companyId}/funding/configuration` | Companies |
| `avalara_funding_configurations_by_company_and_currency` | GET `/api/v2/companies/{companyId}/funding/configurations` | Companies |
| `avalara_get_all_customers_and_suppliers_with_country_params` | GET `/api/v2/companies/{companyId}/supplierandcustomers/withcountryparams` | Companies |
| `avalara_get_company` | GET `/api/v2/companies/{id}` | Companies |
| `avalara_get_company_configuration` | GET `/api/v2/companies/{id}/configuration` | Companies |
| `avalara_get_company_parameter_detail` | GET `/api/v2/companies/{companyId}/parameters/{id}` | Companies |
| `avalara_get_filing_status` | GET `/api/v2/companies/{id}/filingstatus` | Companies |
| `avalara_list_ach_entry_details_for_company` | GET `/api/v2/companies/{id}/paymentdetails/{periodyear}/{periodmonth}` | Companies |
| `avalara_list_company_parameter_details` | GET `/api/v2/companies/{companyId}/parameters` | Companies |
| `avalara_list_funding_requests_by_company` | GET `/api/v2/companies/{id}/funding` | Companies |
| `avalara_list_mrs_companies` | GET `/api/v2/companies/mrs` | Companies |
| `avalara_list_vat_numbers` | GET `/api/v2/companies/{companyId}/vatnumbers` | Companies |
| `avalara_query_companies` | GET `/api/v2/companies` | Companies |
| `avalara_set_company_configuration` | POST `/api/v2/companies/{id}/configuration` | Companies |
| `avalara_update_company` | PUT `/api/v2/companies/{id}` | Companies |
| `avalara_update_company_parameter_detail` | PUT `/api/v2/companies/{companyId}/parameters/{id}` | Companies |
| `avalara_query_juris_names` | GET `/api/v2/compliance/jurisnames/{country}/{region}` | Compliance |
| `avalara_query_rate_options` | GET `/api/v2/compliance/rateOptions/{country}/{region}` | Compliance |
| `avalara_query_state_config` | GET `/api/v2/compliance/stateconfig` | Compliance |
| `avalara_query_state_reporting_codes` | GET `/api/v2/compliance/stateReportingCodes/{country}/{region}` | Compliance |
| `avalara_query_tax_type_mappings` | GET `/api/v2/compliance/taxtypemappings` | Compliance |
| `avalara_create_contacts` | POST `/api/v2/companies/{companyId}/contacts` | Contacts |
| `avalara_delete_contact` | DELETE `/api/v2/companies/{companyId}/contacts/{id}` | Contacts |
| `avalara_get_contact` | GET `/api/v2/companies/{companyId}/contacts/{id}` | Contacts |
| `avalara_list_contacts_by_company` | GET `/api/v2/companies/{companyId}/contacts` | Contacts |
| `avalara_query_contacts` | GET `/api/v2/contacts` | Contacts |
| `avalara_update_contact` | PUT `/api/v2/companies/{companyId}/contacts/{id}` | Contacts |
| `avalara_bulk_upload_cost_centers` | POST `/api/v2/companies/{companyid}/costcenters/$upload` | CostCenter |
| `avalara_create_cost_center` | POST `/api/v2/companies/{companyid}/costcenters` | CostCenter |
| `avalara_delete_cost_center` | DELETE `/api/v2/companies/{companyid}/costcenters/{costcenterid}` | CostCenter |
| `avalara_get_cost_center_by_id` | GET `/api/v2/companies/{companyid}/costcenters/{costcenterid}` | CostCenter |
| `avalara_list_cost_centers_by_company` | GET `/api/v2/companies/{companyid}/costcenters` | CostCenter |
| `avalara_query_cost_centers` | GET `/api/v2/costcenters` | CostCenter |
| `avalara_update_cost_center` | PUT `/api/v2/companies/{companyid}/costcenters/{costcenterid}` | CostCenter |
| `avalara_create_customers` | POST `/api/v2/companies/{companyId}/customers` | Customers |

The full generated catalog contains all AvaTax API operations exposed by Avalara's official spec.
