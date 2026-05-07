# Fastly

Lua namespace: `fastly`

This integration exposes Fastly API operations derived from Fastly's maintained generated PHP client and public API reference. It covers services, versions, domains, VCL, dictionaries, ACLs, config stores, secret stores, logging endpoints, purge, TLS, stats, IAM, product controls, and observability endpoints.

## Authentication

Configure `api_token` with a Fastly API token. The integration sends it as the `Fastly-Key` header. Most endpoints use `https://api.fastly.com`; realtime stats endpoints use `https://rt.fastly.com`. Override `api_url` or `rt_url` only for a deliberate proxy or test host.

## Payload Notes

Fastly's generated client uses path, query, header, form, and JSON body parameters. Tool parameters preserve generated client names such as `service_id`, `version_id`, `page_number`, and `filter_tls_domains_id`. Form-backed endpoints send form-urlencoded data. JSON body-backed endpoints accept either the generated body parameter name or `body`.

## Common Workflows

- List and inspect services with `fastly_service_list_services`, `fastly_service_get_service`, and `fastly_service_get_service_detail`.
- Manage versions with `fastly_version_*`, then activate or validate changes.
- Purge content with `fastly_purge_*` tools.
- Manage dictionaries, ACLs, config stores, secret stores, logging endpoints, domains, TLS, and VCL with their generated tool families.
- Query usage and realtime metrics with `fastly_stats_*`, `fastly_realtime_*`, and observability tools.
