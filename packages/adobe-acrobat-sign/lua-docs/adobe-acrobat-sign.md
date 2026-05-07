# Adobe Acrobat Sign

Lua namespace: `adobe-acrobat-sign`

This integration exposes Adobe Acrobat Sign REST v6 operations generated from Adobe's published Swagger JSON resources. It covers agreements, base URI discovery, groups, library documents, mega signs, transient document uploads, users, webhooks, widgets, and workflows.

## Authentication

Configure `access_token` with an Adobe Acrobat Sign OAuth bearer token that has the scopes required by the operation. Configure `api_url` to the regional REST v6 base URL for the account, for example `https://api.na1.adobesign.com/api/rest/v6`. Use `adobe_acrobat_sign_base_uris_get_base_uris` to discover the correct regional API access point for a token.

## Common Workflows

- Discover base URLs with `adobe_acrobat_sign_base_uris_get_base_uris`.
- Create or inspect agreements with `adobe_acrobat_sign_agreements_create_agreement`, `adobe_acrobat_sign_agreements_get_agreement_info`, and related document, event, reminder, and state tools.
- Manage users and groups with the generated `adobe_acrobat_sign_users_*` and `adobe_acrobat_sign_groups_*` tools.
- Create transient upload documents with `adobe_acrobat_sign_transient_documents_create_transient_document`. The file parameter accepts a local file path or a host-provided upload descriptor.
- Manage webhooks, widgets, mega signs, library documents, and workflows with their respective generated tool families.

## Payload Notes

Most write operations accept a `body` object matching Adobe's Swagger model. Header parameters such as `x_api_user` and `x_on_behalf_of_user` are exposed when Adobe documents them. The `Authorization` header is supplied by the integration from `access_token`, so agents should not pass it as a tool argument.
