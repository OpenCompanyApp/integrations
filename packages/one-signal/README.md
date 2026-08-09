# OneSignal Integration

OneSignal messaging and user-engagement integration for OpenCompany and KosmoKrator agents.

This package targets the current OneSignal REST API at `https://api.onesignal.com`. It keeps legacy device/player tools for compatibility, but new work should prefer the user and subscription tools.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | yes | OneSignal App API key for messaging/users, or Organization API key for app administration |
| `app_id` | string | yes | Default OneSignal App ID |
| `url` | url | no | API base URL, default `https://api.onesignal.com` |

## Tool Coverage

| Area | Tools |
|------|-------|
| Messages | list, get, create, cancel |
| Users | create, get, update, delete |
| Aliases | get identity, create/update alias, delete alias, identity by subscription, alias by subscription |
| Subscriptions | create, update, transfer |
| Segments | list, get, create, update, delete |
| Templates | list, get, create, update, delete |
| Analytics | view outcomes |
| Apps | list, get, update |
| Legacy devices | list devices, get device |
| Utilities | safe raw GET/POST/PATCH/DELETE |

## Notes

- Current OneSignal docs use `Authorization: Key YOUR_API_KEY`; this package sends that header.
- Most messaging, user, subscription, segment, template, and outcome tools default to the configured `app_id`, but accept `app_id` to override per call.
- `onesignal_list_apps` and `onesignal_update_app` may require an Organization API key rather than an App API key.
- Raw API helper paths must be relative, such as `/notifications`; absolute URLs are rejected.

## API Reference

See [script-docs/one-signal.md](script-docs/one-signal.md) for JavaScript usage examples.

## License

MIT
