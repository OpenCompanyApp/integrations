# Replicate JavaScript Reference

Namespace: `replicate`

This integration covers Replicate's official HTTP API OpenAPI schema from `https://api.replicate.com/openapi.json`. Tools map directly to documented operations for account, collections, deployments, files, hardware, models, predictions, search, trainings, and webhook signing secrets.

All tools return Replicate's JSON response directly. File downloads return `{ body, content_type }` when Replicate responds with non-JSON content.

## Common Patterns

Read account details:

```js
var account = app.integrations.replicate.get_account({})
```
Create a prediction by version:

```js
var prediction = app.integrations.replicate.create_prediction({
  version: "replicate-version-id",
  input: { prompt: "a quiet forest trail" },
})
```
Create a prediction using an official model:

```js
var prediction = app.integrations.replicate.create_model_prediction({
  model_owner: "black-forest-labs",
  model_name: "flux-schnell",
  input: { prompt: "a quiet forest trail" },
})
```
Create a prediction using a deployment:

```js
var prediction = app.integrations.replicate.create_deployment_prediction({
  deployment_owner: "example-org",
  deployment_name: "image-worker",
  input: { prompt: "a quiet forest trail" },
})
```
Cancel a prediction:

```js
app.integrations.replicate.cancel_prediction({
  prediction_id: "prediction-id",
})
```
Search public models:

```js
var result = app.integrations.replicate.search_models({
  body: "image generation",
})
```
Upload a file:

```js
var file = app.integrations.replicate.create_file({
  body: {
    content: "/tmp/example.png",
    filename: "example.png",
    type: "image/png",
    metadata: { source: "agent" },
  }
})
```
## Tool Families

- Account: `get_account`
- Collections: `list_collections`, `get_collection`
- Deployments: `list_deployments`, `create_deployment`, `get_deployment`, `update_deployment`, `delete_deployment`, `create_deployment_prediction`
- Files: `list_files`, `create_file`, `get_file`, `delete_file`, `download_file`
- Hardware: `list_hardware`
- Models: `list_models`, `create_model`, `search_models`, `get_model`, `update_model`, `delete_model`, `list_model_examples`, `create_model_prediction`, `get_model_readme`, `list_model_versions`, `get_model_version`, `delete_model_version`
- Predictions: `list_predictions`, `create_prediction`, `get_prediction`, `cancel_prediction`
- Search: `search`
- Trainings: `list_trainings`, `create_training`, `get_training`, `cancel_training`
- Webhooks: `get_default_webhook_secret`

For operations with a request body, pass either `body = { ... }` or pass body fields directly when there is no ambiguity. Headers from the OpenAPI schema, such as `Prefer` and `Cancel-After`, can be passed by their exact name or snake_case form.
