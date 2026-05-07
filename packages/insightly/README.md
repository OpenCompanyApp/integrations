# Insightly CRM Integration

Insightly CRM integration for OpenCompany and KosmoKrator agents. It wraps the
official Insightly v3.1 REST API for contacts, organizations, leads,
opportunities, projects, tasks, events, notes, users, teams, pipelines, and
reference metadata.

Official API docs: <https://api.na1.insightly.com/v3.1/Help>

## Configuration

The integration uses the Insightly API key from User Settings. Insightly expects
HTTP Basic authentication with the API key base64-encoded in the Authorization
header.

```php
return [
    'insightly' => [
        'api_key' => env('INSIGHTLY_API_KEY'),
        'base_url' => env('INSIGHTLY_BASE_URL', 'https://api.na1.insightly.com'),
    ],
];
```

The `access_token` key is still accepted as a legacy alias, but new host setup
screens should store `api_key`.

## Coverage

The provider exposes focused tools for:

- Core CRM records: contacts, organizations, leads, opportunities, and projects.
- Activity records: tasks, events, notes, and note comments.
- Search: field search, updated-after search, and tag search for supported
  primary objects.
- Users and teams: users, teams, team members, and current user checks.
- Metadata: pipelines, pipeline stages, activity sets, countries, currencies,
  tags, permissions, instance metadata, task categories, lead sources, lead
  statuses, opportunity categories, project categories, and custom fields.

Update tools follow Insightly's collection-level PUT shape: pass the tool's
`id` argument and the tool sends the matching API field such as `CONTACT_ID`,
`TASK_ID`, or `EVENT_ID` in the request body.

## Tool Examples

```lua
local contacts = app.integrations.insightly.list_contacts({
  top = 25,
  brief = true
})

local tagged = app.integrations.insightly.search_opportunities_by_tag({
  tagName = "renewal",
  top = 10
})

local task = app.integrations.insightly.create_task({
  TITLE = "Follow up",
  DUE_DATE = "2026-05-20T12:00:00Z",
  OPPORTUNITY_ID = 12345,
  RESPONSIBLE_USER_ID = 678
})

local fields = app.integrations.insightly.list_custom_fields({
  objectName = "Contacts"
})
```

## Development

Run syntax checks for package changes:

```console
find packages/insightly/src tests/Insightly -name '*.php' -print0 | xargs -0 -n1 php -l
composer validate packages/insightly/composer.json
php build-catalog.php
```

Tests use fake hosts and fake API keys only.

## License

MIT
