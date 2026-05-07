# Braintrust

Namespace: `braintrust`

Braintrust provides LLM evals, observability logs, datasets, prompts, functions,
scorers, and AI proxy calls. This integration uses the Braintrust REST API with
`Authorization: Bearer <api_key>` against your configured data plane URL.

Default data plane URLs:

- US: `https://api.braintrust.dev`
- EU: `https://api-eu.braintrust.dev`
- Self-hosted: your Braintrust universal API URL

## Usage notes

- List endpoints accept a `query` object. Complex query values such as
  `metadata` are JSON-encoded before being sent because Braintrust documents
  metadata filters as JSON strings.
- Write endpoints accept a `body` object that matches the official Braintrust
  API request schema. This keeps the integration current as Braintrust adds
  fields without exposing unsupported fake parameters.
- Fetch, insert, feedback, eval, function invoke, BTQL, and proxy tools require
  a non-empty `body` object.
- Returned data is parsed JSON when the API returns JSON. Empty delete responses
  are normalized to `{ success = true, status = <http_status> }`.

## Core tools

- `braintrust_list_projects`, `braintrust_create_project`,
  `braintrust_get_project`, `braintrust_update_project`,
  `braintrust_delete_project`
- `braintrust_insert_logs`, `braintrust_fetch_logs`,
  `braintrust_feedback_logs`
- `braintrust_list_experiments`, `braintrust_create_experiment`,
  `braintrust_get_experiment`, `braintrust_update_experiment`,
  `braintrust_delete_experiment`, `braintrust_insert_experiment`,
  `braintrust_fetch_experiment`, `braintrust_feedback_experiment`,
  `braintrust_summarize_experiment`
- `braintrust_list_datasets`, `braintrust_create_dataset`,
  `braintrust_get_dataset`, `braintrust_update_dataset`,
  `braintrust_delete_dataset`, `braintrust_insert_dataset`,
  `braintrust_fetch_dataset`, `braintrust_feedback_dataset`,
  `braintrust_summarize_dataset`
- `braintrust_list_prompts`, `braintrust_create_prompt`,
  `braintrust_upsert_prompt`, `braintrust_get_prompt`,
  `braintrust_update_prompt`, `braintrust_delete_prompt`
- `braintrust_list_functions`, `braintrust_create_function`,
  `braintrust_upsert_function`, `braintrust_get_function`,
  `braintrust_update_function`, `braintrust_delete_function`,
  `braintrust_invoke_function`
- `braintrust_query_btql`, `braintrust_launch_eval`
- `braintrust_proxy_chat_completions`, `braintrust_proxy_completions`,
  `braintrust_proxy_embeddings`, `braintrust_proxy_auto`
- `braintrust_list_project_scores`, `braintrust_list_project_tags`,
  `braintrust_list_dataset_snapshots`, `braintrust_list_groups`,
  `braintrust_list_roles`, `braintrust_list_users`,
  `braintrust_list_organizations`

## Examples

List projects:

```lua
local projects = braintrust_list_projects({
  query = { limit = 10 }
})
```

Filter experiments by nested metadata:

```lua
local experiments = braintrust_list_experiments({
  query = {
    project_id = "00000000-0000-0000-0000-000000000000",
    metadata = { env = "test", model = { name = "gpt-5-mini" } }
  }
})
```

Insert dataset rows:

```lua
local result = braintrust_insert_dataset({
  dataset_id = "00000000-0000-0000-0000-000000000000",
  body = {
    events = {
      {
        id = "row-1",
        input = { question = "What is 2+2?" },
        expected = "4"
      }
    }
  }
})
```

Query BTQL:

```lua
local rows = braintrust_query_btql({
  body = {
    query = "SELECT id, input, output FROM project_logs('00000000-0000-0000-0000-000000000000') LIMIT 10",
    fmt = "json"
  }
})
```

Invoke a function:

```lua
local output = braintrust_invoke_function({
  function_id = "00000000-0000-0000-0000-000000000000",
  body = {
    input = { text = "Summarize this safely." },
    environment = "production"
  }
})
```

Use the proxy for chat completions:

```lua
local completion = braintrust_proxy_chat_completions({
  body = {
    model = "openai/gpt-4o-mini",
    messages = {
      { role = "user", content = "Write a concise release note." }
    }
  }
})
```

## Coverage notes

This package intentionally exposes stable REST operations that are useful to
agents and safe to shape through JSON bodies. It does not expose raw credential
management, service token mutation, AI secret mutation, or ACL mutation tools
yet, because those are high-risk administrative surfaces that should get
separate least-privilege UX and tests before being enabled for agents.
