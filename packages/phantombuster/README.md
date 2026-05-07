# Integration: Phantombuster

Phantombuster integration for OpenCompany agent tooling. It exposes the
Phantombuster API for agents, launches, containers, outputs, scripts, branches,
organization metadata, current user checks, and generic relative API calls.

## Configuration

This package uses a stored Phantombuster API key. In OpenCompany and
KosmoKrator, configure credentials through the integration settings UI. For
standalone usage, bind a `CredentialResolver` value for:

```php
[
    'phantombuster' => [
        'api_key' => env('PHANTOMBUSTER_API_KEY'),
        'url' => env('PHANTOMBUSTER_URL', 'https://api.phantombuster.com/api/v2'),
    ],
]
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `phantombuster_list_agents` | read | List agents |
| `phantombuster_get_agent` | read | Get one agent |
| `phantombuster_launch_agent` | write | Launch an agent |
| `phantombuster_save_agent` | write | Create or update an agent |
| `phantombuster_stop_agent` | write | Stop a running agent |
| `phantombuster_delete_agent` | write | Delete an agent |
| `phantombuster_list_deleted_agents` | read | List deleted agents |
| `phantombuster_fetch_agent_output` | read | Fetch incremental agent output |
| `phantombuster_list_containers` | read | List containers for an agent |
| `phantombuster_get_container` | read | Get one container |
| `phantombuster_fetch_container_output` | read | Fetch container output |
| `phantombuster_fetch_container_result_object` | read | Fetch a container result object |
| `phantombuster_list_scripts` | read | List scripts |
| `phantombuster_get_script` | read | Get one script |
| `phantombuster_save_script` | write | Create or update a script |
| `phantombuster_delete_script` | write | Delete a script |
| `phantombuster_list_branches` | read | List script branches |
| `phantombuster_get_organization` | read | Get organization metadata |
| `phantombuster_get_ip_location` | read | Resolve IP country metadata |
| `phantombuster_get_current_user` | read | Get authenticated user profile |
| `phantombuster_api_get` | read | Call a relative API GET endpoint |
| `phantombuster_api_post` | write | Call a relative API POST endpoint |
| `phantombuster_api_put` | write | Call a relative API PUT endpoint |
| `phantombuster_api_delete` | write | Call a relative API DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Phantombuster\PhantombusterService;

$service = app(PhantombusterService::class);

$user = $service->getCurrentUser();
$agents = $service->listAgents(['withArgument' => true]);
$agent = $service->getAgent('agent_123', ['withManifest' => true]);
$launch = $service->launchAgent('agent_123', [
    'bonusArgument' => ['profileUrl' => 'https://example.test/profile'],
]);
$containers = $service->listContainers('agent_123', ['limit' => 10]);
$output = $service->fetchContainerOutput('container_123', 'json');
$scripts = $service->listScripts();
$org = $service->getOrganization(['withProxies' => true]);
```

## Notes For Agents

Use first-class tools for documented Phantombuster resources. Use generic API
helpers only for newer or less common endpoints, and pass relative paths such as
`/agents/fetch-all` or `/containers/fetch-output`. Absolute URLs are rejected so
hosts keep control over credentials and API base URL handling.

The v2 `containers/fetch-all` endpoint is scoped to a single agent, so
`phantombuster_list_containers` requires `agent_id`.

## Requirements

- PHP 8.2+
- `opencompanyapp/integration-core`
- A Phantombuster account with an API key

## License

MIT
