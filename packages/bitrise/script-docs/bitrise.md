# Bitrise

Namespace: `bitrise`

Use the Bitrise integration to manage Bitrise CI/CD apps through API v0.1. Authentication uses a personal access token or Workspace API token passed in the `Authorization` header.

## Common Workflows

- Use `bitrise_list_apps`, `bitrise_get_app`, `bitrise_update_app`, and `bitrise_delete_app` to inspect and administer apps.
- Use `bitrise_register_app`, `bitrise_register_ssh_key`, and `bitrise_finish_app` for the multi-step app registration flow.
- Use `bitrise_get_bitrise_yml`, `bitrise_upload_bitrise_yml`, `bitrise_get_bitrise_yml_config`, and `bitrise_update_bitrise_yml_config` to inspect or update configuration YAML.
- Use `bitrise_trigger_build`, `bitrise_abort_build`, `bitrise_list_app_builds`, `bitrise_get_build`, `bitrise_get_build_log`, and `bitrise_list_archived_builds` for build operations.
- Use `bitrise_register_webhook`, `bitrise_list_outgoing_webhooks`, `bitrise_create_outgoing_webhook`, `bitrise_update_outgoing_webhook`, and `bitrise_delete_outgoing_webhook` for incoming and outgoing webhooks.
- Use `bitrise_list_artifacts`, `bitrise_get_artifact`, `bitrise_update_artifact`, and `bitrise_delete_artifact` for build artifacts.
- Use `bitrise_list_secrets`, `bitrise_get_secret_value`, `bitrise_put_secret`, and `bitrise_delete_secret` for app secrets. Bitrise only returns a secret value when it is unprotected.
- Use `bitrise_list_android_keystore_files`, `bitrise_create_android_keystore_file`, and `bitrise_delete_android_keystore_file` for Android signing files.
- Use `bitrise_api_get`, `bitrise_api_post`, `bitrise_api_put`, `bitrise_api_patch`, and `bitrise_api_delete` for safe relative paths not covered by first-class tools. Full URLs are rejected.

## Argument Notes

Most app-scoped tools require `app_slug`. Build-scoped tools require `app_slug` and `build_slug`. Artifact tools also require `artifact_slug`; outgoing webhook tools use `webhook_slug`; Android keystore deletion uses `file_slug`; secret tools use `secret_name`.

Read tools accept optional filters and pagination via `query`. Write tools accept the Bitrise JSON body through `payload`.

## Examples

```js
var apps = tools.bitrise_list_apps({
  query: { limit: 20 },
})

var build = tools.bitrise_trigger_build({
  app_slug: "app-slug",
  payload: {
    hook_info: { type: "bitrise" },
    build_params: {
      branch: "main",
      workflow_id: "primary",
    }
  }
})

var log = tools.bitrise_get_build_log({
  app_slug: "app-slug",
  build_slug: "build-slug",
})

var secret = tools.bitrise_put_secret({
  app_slug: "app-slug",
  secret_name: "DEPLOY_TOKEN",
  payload: {
    value: "dummy-token",
    is_protected: true,
    expand_in_step_inputs: true,
  }
})
```
## Return Shapes

The integration returns decoded Bitrise JSON responses directly. Empty successful responses are normalized to:

```json
{"success": true}
```

Text responses are normalized to:

```json
{"value": "raw response text"}
```

Some Bitrise endpoints require owner/admin roles on the app team, and older archived build data has separate endpoints. When Bitrise returns an HTTP error, the tool returns that as an error instead of fabricating a successful response.
