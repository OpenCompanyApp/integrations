# Integration: Google Contacts

> Google Contacts (People API) integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list connections, manage contacts and contact groups, access other contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Contacts. Search and list contacts, create new ones, manage contact groups, and retrieve "Other Contacts" — all through the [Google People API](https://developers.google.com/people).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Contacts tool lets AI agents search and manage contact information, create new contacts, and organize contact groups — giving agents access to your team's address book.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-contacts
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth2 access token with the `https://www.googleapis.com/auth/contacts` scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google_contacts' => [
        'access_token' => env('GOOGLE_CONTACTS_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_PEOPLE_API_URL', 'https://people.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `google_contacts_list_connections` | read | List contacts (connections) with pagination and sync support |
| `google_contacts_get_connection` | read | Get a specific contact by resource name |
| `google_contacts_create_contact` | write | Create a new contact with names, emails, phones, and notes |
| `google_contacts_list_contact_groups` | read | List all contact groups (My Contacts, Starred, custom groups) |
| `google_contacts_get_contact_group` | read | Get a specific contact group with member list |
| `google_contacts_list_other_contacts` | read | List "Other Contacts" (auto-populated by Google) |
| `google_contacts_get_current_user` | read | Get the authenticated user's profile information |

## Quick Start

```php
use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsListConnections;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsCreateContact;

// Create tools
$service = app(GoogleContactsService::class);
$tools = [
    new GoogleContactsListConnections($service),
    new GoogleContactsCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find John Doe in my contacts and show me his phone number');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google_contacts');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsListConnections::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;

$service = app(GoogleContactsService::class);

// List contacts
$contacts = $service->listConnections(pageSize: 50);

// Get a specific contact
$contact = $service->getConnection('people/c123456789');

// Create a contact
$newContact = $service->createContact(
    names: [['givenName' => 'Jane', 'familyName' => 'Smith']],
    emailAddresses: [['value' => 'jane@example.com']],
    phoneNumbers: [['value' => '+15551234567']],
    biographies: [['value' => 'Met at conference']],
);

// List contact groups
$groups = $service->listContactGroups();

// List other contacts
$other = $service->listOtherContacts(pageSize: 100);

// Get current user
$user = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A Google account with OAuth2 access token (People API contacts scope)

## License

MIT — see [LICENSE](LICENSE)
