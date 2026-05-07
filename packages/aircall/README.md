# Integration: Aircall

Aircall integration for the OpenCompany integration ecosystem. It wraps the
official Aircall Public API for calls, users, teams, numbers, contacts, tags,
webhooks, dialer campaigns, and conversation intelligence endpoints.

API reference: https://developer.aircall.io/api-references/

## Configuration

Aircall uses OAuth/manual access tokens. Store the resulting token as
`access_token`.

```php
return [
    'aircall' => [
        'access_token' => env('AIRCALL_ACCESS_TOKEN'),
        'url' => env('AIRCALL_URL', 'https://api.aircall.io'),
    ],
];
```

## Tool Coverage

The provider exposes 81 tools:

- Auth and account: ping, current user, company, integration
- Users: v1 users, v2 users, availability, assigned numbers, outbound call and dial actions
- Teams: list, get, create, delete, add/remove users
- Calls: list, search, get, transfer, comment, tag, archive, recording controls, insight cards
- Conversation intelligence: transcription, realtime transcription, sentiments, topics, summary, custom summary, action items, playbook result, evaluations
- Dialer campaigns: get, create, delete, list/add/delete campaign phone numbers
- Numbers: list, get, update, music/messages, number configuration
- Contacts: list, get, create, update, delete, update/delete phone numbers and emails
- Tags: list, get, create, update, delete
- Webhooks: list, get, create, update, delete
- Raw helpers: `aircall_api_get`, `aircall_api_post`, `aircall_api_put`, `aircall_api_delete`

Raw helpers accept relative paths such as `/calls` or `/v2/users`; unversioned
paths are normalized to `/v1/...`. Absolute URLs and parent-directory paths are
rejected.

## Notes

- Aircall's user v1 endpoints are documented as being replaced by v2 user endpoints; both are available here because the public API still documents both surfaces.
- Recording, voicemail, and conversation intelligence links may be short-lived according to Aircall's API docs.

## License

MIT
