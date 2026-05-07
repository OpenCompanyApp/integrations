# Codemagic

Namespace: `codemagic`

Use the Codemagic integration to manage mobile CI/CD applications through the Codemagic REST API. Authentication uses a Codemagic API token in the `x-auth-token` header.

## Common Workflows

- Use `codemagic_list_apps`, `codemagic_get_app`, `codemagic_create_app`, and `codemagic_create_private_app` for application discovery and repository onboarding.
- Use `codemagic_start_build` and `codemagic_cancel_build` to run or cancel builds.
- Use `codemagic_get_artifact` and `codemagic_create_artifact_public_url` for build artifact download links.
- Use `codemagic_list_caches`, `codemagic_delete_caches`, and `codemagic_delete_cache` for app cache inspection and cleanup.
- Use `codemagic_api_get`, `codemagic_api_post`, `codemagic_api_patch`, and `codemagic_api_delete` for safe relative API paths not covered by first-class tools. Full URLs are rejected.

## Argument Notes

Application tools use `app_id`. Build cancellation uses `build_id`. Artifact tools use `secure_filename`, which may include nested path segments copied from a Codemagic artifact URL. Cache deletion uses `cache_id`.

Write tools accept Codemagic JSON request bodies through `payload`. Read/raw tools accept optional query parameters through `query`.

## Examples

```lua
local apps = tools.codemagic_list_apps({})

local build = tools.codemagic_start_build({
  payload = {
    appId = "app-id",
    workflowId = "release",
    branch = "main",
    labels = { "nightly" }
  }
})

local public_artifact = tools.codemagic_create_artifact_public_url({
  secure_filename = "secure/build/path/app.ipa",
  payload = {
    expiresAt = 1767225600
  }
})
```

## Return Shapes

The integration returns decoded Codemagic JSON responses directly. Empty successful responses are normalized to:

```json
{"success": true}
```

Text responses are normalized to:

```json
{"value": "raw response text"}
```

Codemagic marks these REST APIs as preview in parts of the official docs. If a route changes or is unavailable for an account, the tool returns Codemagic's HTTP error rather than inventing a successful response.
