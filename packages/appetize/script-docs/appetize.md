# Appetize

Use the `appetize` namespace to manage Appetize-hosted mobile app builds, app groups, usage reports, and supported device metadata.

Authentication uses an Appetize organization API token sent as the `X-API-KEY` header. Private Enterprise instances can override the API base URL in integration settings.

## Common usage

- Use `appetize_list_apps` with `query.nextKey` to page through account apps.
- Use `appetize_get_app` with a build public key, or an app-group public key beginning with `ag_`.
- Use `appetize_create_app` with a `payload` that includes `platform` and a public app file `url`.
- Use `appetize_update_app` to replace a build or update settings for an existing public key.
- Use `appetize_get_usage_summary` with `query.startMonth` and `query.nextKey` for monthly session totals.
- Use `appetize_list_devices` to fetch supported devices and OS versions from the v2 service endpoint.

## Tool notes

`appetize_list_apps` returns Appetize's paginated shape, typically including `hasMore`, `nextKey`, and `data`.

`appetize_list_all_apps` calls the non-paginated Appetize endpoint. Prefer `appetize_list_apps` for large accounts.

`appetize_create_app` accepts the documented Appetize create-app JSON body. A minimal Android example:

```js
appetize_create_app({
  payload: {
    platform: "android",
    url: "https://example.test/app.apk",
    note: "QA smoke build",
  }
})
```
`appetize_get_usage_summary` returns usage rows grouped by month and public key. A paginated example:

```js
appetize_get_usage_summary({
  query: {
    startMonth: "2026-05",
    nextKey: "cursor",
  }
})
```
`appetize_api_get`, `appetize_api_post`, and `appetize_api_delete` are escape hatches for documented Appetize endpoints that do not yet have first-class tools. They only accept relative paths such as `/v1/apps`; full URLs are rejected.
