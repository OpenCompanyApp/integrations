# Sauce Labs

Namespace: `sauce-labs`

Use the Sauce Labs integration to inspect and manage Sauce Labs REST API resources across platform status, VDC jobs, v2 builds, real device jobs, private devices, and Sauce Connect tunnels. Authentication uses HTTP Basic credentials: `username` and `access_key`.

## Common Workflows

- Use `sauce_labs_get_status` and `sauce_labs_list_platforms` before scheduling tests or validating regional availability.
- Use `sauce_labs_list_jobs`, `sauce_labs_get_job`, `sauce_labs_update_job`, `sauce_labs_stop_job`, `sauce_labs_delete_job`, `sauce_labs_list_job_assets`, and `sauce_labs_get_job_asset` for VDC jobs.
- Use `sauce_labs_list_builds`, `sauce_labs_get_build`, `sauce_labs_get_job_build`, and `sauce_labs_list_build_jobs` for v2 build reporting. `build_source` is usually `vdc` or `rdc`.
- Use `sauce_labs_list_rdc_jobs`, `sauce_labs_get_rdc_job`, `sauce_labs_get_rdc_job_asset`, `sauce_labs_stop_rdc_job`, and `sauce_labs_delete_rdc_job` for real device cloud jobs.
- Use `sauce_labs_list_private_devices` to inspect private real devices.
- Use `sauce_labs_list_tunnels`, `sauce_labs_get_tunnel`, `sauce_labs_get_tunnel_jobs_count`, and `sauce_labs_stop_tunnel` for Sauce Connect tunnels.
- Use `sauce_labs_api_get`, `sauce_labs_api_put`, and `sauce_labs_api_delete` for safe relative API paths not covered by first-class tools. Full URLs are rejected.

## Argument Notes

Most legacy job and tunnel endpoints include `username`; omit it on list calls to default to the configured username. V2 build tools require `build_source` (`vdc` or `rdc`). Asset tools use `file_name` for VDC assets and `asset_type` for RDC assets.

Read tools accept optional filters through `query`. Write tools accept request bodies through `payload`.

## Examples

```js
var status = tools.sauce_labs_get_status({})

var builds = tools.sauce_labs_list_builds({
  build_source: "vdc",
  query: { limit: 20, sort: "desc" },
})

var assets = tools.sauce_labs_list_job_assets({
  username: "sauce-user",
  job_id: "job-id",
})

var tunnel = tools.sauce_labs_get_tunnel_jobs_count({
  username: "sauce-user",
  tunnel_id: "tunnel-id",
})
```
## Return Shapes

The integration returns decoded Sauce Labs JSON responses directly. Empty successful responses are normalized to:

```json
{"success": true}
```

Text or asset responses are normalized to:

```json
{"value": "raw response text"}
```

Sauce Labs uses regional API hosts. The default is `https://api.us-west-1.saucelabs.com`; set the API URL credential for other regions such as EU Central.
