# Phantombuster Lua API Reference

Namespace: `app.integrations.phantombuster`

Use this integration to manage Phantombuster agents, launches, containers,
outputs, scripts, branches, and organization metadata. Returned values are the
parsed JSON response from the Phantombuster API. Raw container output is returned
as `{ body = "..." }` when the API responds with plain text.

## Agents

| Function | Purpose |
|----------|---------|
| `list_agents({ input_types?, output_types?, agent_ids?, with_argument?, with_agent_slots_factor? })` | List agents in the current organization. |
| `get_agent({ id, with_manifest?, with_agent_object?, with_code?, with_slaves?, with_sub_slaves? })` | Get one agent by ID. |
| `launch_agent({ id, argument?, arguments?, bonus_argument?, save_argument?, payload? })` | Launch one agent and return its launch container response. |
| `save_agent({ id?, name?, script?, branch?, environment?, launch_type?, argument?, payload? })` | Create or update an agent. |
| `stop_agent({ id })` | Stop a running agent. |
| `delete_agent({ id })` | Delete an agent. |
| `list_deleted_agents({})` | List deleted agents. |
| `fetch_agent_output({ id, from_output_pos?, prev_container_id?, prev_status?, prev_runtime_event_index? })` | Fetch incremental output from the latest relevant container for an agent. |

Example:

```lua
local agents = app.integrations.phantombuster.list_agents({
  with_argument = true
})

local launch = app.integrations.phantombuster.launch_agent({
  id = agents.agents[1].id,
  bonus_argument = { profileUrl = "https://example.test/profile" }
})

print(launch.containerId or launch.id)
```

## Containers

| Function | Purpose |
|----------|---------|
| `list_containers({ agent_id, before_ended_at?, limit?, mode?, with_runtime_events? })` | List containers for one agent. |
| `get_container({ id, with_result_object?, with_output?, with_runtime_events?, with_newer_and_older_container_id? })` | Get a container by ID. |
| `fetch_container_output({ id, mode? })` | Fetch container output. `mode` can be `json` or `raw`. |
| `fetch_container_result_object({ id })` | Fetch the result object associated with a container. |

`list_containers` requires an agent ID because Phantombuster's v2
`/containers/fetch-all` endpoint is scoped to one agent.

## Scripts, Branches, And Organization

| Function | Purpose |
|----------|---------|
| `list_scripts({})` | List scripts available to the current user. |
| `get_script({ id })` | Get one script by ID. |
| `save_script({ payload })` | Create or update a script with the official `/scripts/save` payload. |
| `delete_script({ id })` | Delete a script. |
| `list_branches({})` | List script branches for the current organization. |
| `get_organization({ with_global_object?, with_proxies?, with_crm_integrations?, with_custom_prompts? })` | Fetch current organization metadata. |
| `get_ip_location({ ip })` | Resolve country metadata for an IP address. |

Use `payload` for large or fast-changing official Phantombuster request bodies.
Keep examples and tests on fake values such as `example.test`.

## Generic API Helpers

| Function | Purpose |
|----------|---------|
| `api_get({ path, params? })` | Send GET to a relative API path. |
| `api_post({ path, payload? })` | Send POST to a relative API path. |
| `api_put({ path, payload? })` | Send PUT to a relative API path. |
| `api_delete({ path, payload? })` | Send DELETE to a relative API path. |

Generic helpers reject absolute URLs. Use paths like `/agents/fetch-all`,
`/containers/fetch-output`, or `/orgs/fetch` so hosts retain control of the API
base URL and credentials.

## Current User

`get_current_user({})` fetches the authenticated Phantombuster user from `/user`.
Use it to verify which account a configured API key represents.

## Multi-Account Usage

All functions work the same way under account-specific namespaces:

```lua
app.integrations.phantombuster.list_agents({})
app.integrations.phantombuster.default.list_agents({})
app.integrations.phantombuster.client.list_agents({})
```
