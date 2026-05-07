<?php

namespace OpenCompany\Integrations\Replicate;

/**
 * Official Replicate OpenAPI operation metadata.
 *
 * Generated from https://api.replicate.com/openapi.json.
 */
final class ReplicateOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'replicate_cancel_prediction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCancelPrediction',
    'class_basename' => 'ReplicateCancelPrediction',
    'operation_id' => 'predictions.cancel',
    'method' => 'POST',
    'path' => '/predictions/{prediction_id}/cancel',
    'summary' => 'Cancel a prediction',
    'description' => 'Cancel a prediction that is currently running.

Example cURL request that creates a prediction and then cancels it:

```console
# First, create a prediction
PREDICTION_ID=$(curl -s -X POST \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H "Content-Type: application/json" \\
  -d \'{
    "input": {
      "prompt": "a video that may take a while to generate"
    }
  }\' \\
  https://api.replicate.com/v1/models/minimax/video-01/predictions | jq -r \'.id\')

# Echo the prediction ID
echo "Created prediction with ID: $PREDICTION_ID"

# Cancel the prediction
curl -s -X POST \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/predictions/$PREDICTION_ID/cancel
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'prediction_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the prediction to cancel.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_cancel_training' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCancelTraining',
    'class_basename' => 'ReplicateCancelTraining',
    'operation_id' => 'trainings.cancel',
    'method' => 'POST',
    'path' => '/trainings/{training_id}/cancel',
    'summary' => 'Cancel a training',
    'description' => 'Cancel a training',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'training_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the training you want to cancel.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_create_deployment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateDeployment',
    'class_basename' => 'ReplicateCreateDeployment',
    'operation_id' => 'deployments.create',
    'method' => 'POST',
    'path' => '/deployments',
    'summary' => 'Create a deployment',
    'description' => 'Create a new deployment:

Example cURL request:

```console
curl -s \\
  -X POST \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H "Content-Type: application/json" \\
  -d \'{
        "name": "my-app-image-generator",
        "model": "stability-ai/sdxl",
        "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
        "hardware": "gpu-t4",
        "min_instances": 0,
        "max_instances": 3
      }\' \\
  https://api.replicate.com/v1/deployments
```

The response will be a JSON object describing the deployment:

```json
{
  "owner": "acme",
  "name": "my-app-image-generator",
  "current_release": {
    "number": 1,
    "model": "stability-ai/sdxl",
    "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
    "created_at": "2024-02-15T16:32:57.018467Z",
    "created_by": {
      "type": "organization",
      "username": "acme",
      "name": "Acme Corp, Inc.",
      "avatar_url": "https://cdn.replicate.com/avatars/acme.png",
      "github_url": "https://github.com/acme"
    },
    "configuration": {
      "hardware": "gpu-t4",
      "min_instances": 1,
      "max_instances": 5
    }
  }
}
```',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_deployment_prediction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateDeploymentPrediction',
    'class_basename' => 'ReplicateCreateDeploymentPrediction',
    'operation_id' => 'deployments.predictions.create',
    'method' => 'POST',
    'path' => '/deployments/{deployment_owner}/{deployment_name}/predictions',
    'summary' => 'Create a prediction using a deployment',
    'description' => 'Create a prediction for the deployment and inputs you provide.

Example cURL request:

```console
curl -s -X POST -H \'Prefer: wait\' \\
  -d \'{"input": {"prompt": "A photo of a bear riding a bicycle over the moon"}}\' \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: application/json\' \\
  https://api.replicate.com/v1/deployments/acme/my-app-image-generator/predictions
```

The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint.

For a complete overview of the `deployments.predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deployment_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the deployment.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployment_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the deployment.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'Prefer',
        'in' => 'header',
        'required' => false,
        'description' => 'Leave the request open and wait for the model to finish generating output. Set to `wait=n` where n is a number of seconds between 1 and 60.

See [sync mode](https://replicate.com/docs/topics/predictions/create-a-prediction#sync-mode) for more information.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'Cancel-After',
        'in' => 'header',
        'required' => false,
        'description' => 'The maximum time the prediction can run before it is automatically canceled. The lifetime is measured from when the prediction is created.

The duration can be specified as string with an optional unit suffix:
- `s` for seconds (e.g., `30s`, `90s`)
- `m` for minutes (e.g., `5m`, `15m`)
- `h` for hours (e.g., `1h`, `2h30m`)
- defaults to seconds if no unit suffix is provided (e.g. `30` is the same as `30s`)

You can combine units for more precision (e.g., `1h30m45s`).

The minimum allowed duration is 5 seconds.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_file' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateFile',
    'class_basename' => 'ReplicateCreateFile',
    'operation_id' => 'files.create',
    'method' => 'POST',
    'path' => '/files',
    'summary' => 'Create a file',
    'description' => 'Create a file by uploading its content and optional metadata.

Example cURL request:

```console
curl -X POST https://api.replicate.com/v1/files \\
  -H "Authorization: Token $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: multipart/form-data\' \\
  -F \'content=@/path/to/archive.zip;type=application/zip;filename=example.zip\' \\
  -F \'metadata={"customer_reference_id": 123};type=application/json\'
```

The request must include:
- `content`: The file content (required)
- `type`: The content / MIME type for the file (defaults to `application/octet-stream`)
- `filename`: The filename (required,  255 bytes, valid UTF-8)
- `metadata`: User-provided metadata associated with the file (defaults to `{}`, must be valid JSON)',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'multipart/form-data',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_model' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateModel',
    'class_basename' => 'ReplicateCreateModel',
    'operation_id' => 'models.create',
    'method' => 'POST',
    'path' => '/models',
    'summary' => 'Create a model',
    'description' => 'Create a model.

Example cURL request:

```console
curl -s -X POST \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: application/json\' \\
  -d \'{"owner": "alice", "name": "hot-dog-detector", "description": "Detect hot dogs in images", "visibility": "public", "hardware": "cpu"}\' \\
  https://api.replicate.com/v1/models
```

The response will be a model object in the following format:

```json
{
  "url": "https://replicate.com/alice/hot-dog-detector",
  "owner": "alice",
  "name": "hot-dog-detector",
  "description": "Detect hot dogs in images",
  "visibility": "public",
  "github_url": null,
  "paper_url": null,
  "license_url": null,
  "run_count": 0,
  "cover_image_url": null,
  "default_example": null,
  "latest_version": null,
}
```

Note that there is a limit of 1,000 models per account. For most purposes, we recommend using a single model and pushing new [versions](https://replicate.com/docs/how-does-replicate-work#versions) of the model as you make changes to it.',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_model_prediction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateModelPrediction',
    'class_basename' => 'ReplicateCreateModelPrediction',
    'operation_id' => 'models.predictions.create',
    'method' => 'POST',
    'path' => '/models/{model_owner}/{model_name}/predictions',
    'summary' => 'Create a prediction using an official model',
    'description' => 'Create a prediction using an [official model](https://replicate.com/changelog/2025-01-29-official-models).

If you\'re _not_ running an official model, use the [`predictions.create`](#predictions.create) operation instead.

Example cURL request:

```console
curl -s -X POST -H \'Prefer: wait\' \\
  -d \'{"input": {"prompt": "Write a short poem about the weather."}}\' \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: application/json\' \\
  https://api.replicate.com/v1/models/meta/meta-llama-3-70b-instruct/predictions
```

The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint.

For a complete overview of the `deployments.predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'Prefer',
        'in' => 'header',
        'required' => false,
        'description' => 'Leave the request open and wait for the model to finish generating output. Set to `wait=n` where n is a number of seconds between 1 and 60.

See [sync mode](https://replicate.com/docs/topics/predictions/create-a-prediction#sync-mode) for more information.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'Cancel-After',
        'in' => 'header',
        'required' => false,
        'description' => 'The maximum time the prediction can run before it is automatically canceled. The lifetime is measured from when the prediction is created.

The duration can be specified as string with an optional unit suffix:
- `s` for seconds (e.g., `30s`, `90s`)
- `m` for minutes (e.g., `5m`, `15m`)
- `h` for hours (e.g., `1h`, `2h30m`)
- defaults to seconds if no unit suffix is provided (e.g. `30` is the same as `30s`)

You can combine units for more precision (e.g., `1h30m45s`).

The minimum allowed duration is 5 seconds.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_prediction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreatePrediction',
    'class_basename' => 'ReplicateCreatePrediction',
    'operation_id' => 'predictions.create',
    'method' => 'POST',
    'path' => '/predictions',
    'summary' => 'Create a prediction',
    'description' => 'Create a prediction for the model version and inputs you provide.

Example cURL request:

```console
curl -s -X POST -H \'Prefer: wait\' \\
  -d \'{"version": "replicate/hello-world:5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", "input": {"text": "Alice"}}\' \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: application/json\' \\
  https://api.replicate.com/v1/predictions
```

The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint.

For a complete overview of the `predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'Prefer',
        'in' => 'header',
        'required' => false,
        'description' => 'Leave the request open and wait for the model to finish generating output. Set to `wait=n` where n is a number of seconds between 1 and 60.

See [sync mode](https://replicate.com/docs/topics/predictions/create-a-prediction#sync-mode) for more information.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Cancel-After',
        'in' => 'header',
        'required' => false,
        'description' => 'The maximum time the prediction can run before it is automatically canceled. The lifetime is measured from when the prediction is created.

The duration can be specified as string with an optional unit suffix:
- `s` for seconds (e.g., `30s`, `90s`)
- `m` for minutes (e.g., `5m`, `15m`)
- `h` for hours (e.g., `1h`, `2h30m`)
- defaults to seconds if no unit suffix is provided (e.g. `30` is the same as `30s`)

You can combine units for more precision (e.g., `1h30m45s`).

The minimum allowed duration is 5 seconds.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_create_training' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateCreateTraining',
    'class_basename' => 'ReplicateCreateTraining',
    'operation_id' => 'trainings.create',
    'method' => 'POST',
    'path' => '/models/{model_owner}/{model_name}/versions/{version_id}/trainings',
    'summary' => 'Create a training',
    'description' => 'Start a new training of the model version you specify.

Example request body:

```json
{
  "destination": "{new_owner}/{new_name}",
  "input": {
    "train_data": "https://example.com/my-input-images.zip",
  },
  "webhook": "https://example.com/my-webhook",
}
```

Example cURL request:

```console
curl -s -X POST \\
  -d \'{"destination": "{new_owner}/{new_name}", "input": {"input_images": "https://example.com/my-input-images.zip"}}\' \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H \'Content-Type: application/json\' \\
  https://api.replicate.com/v1/models/stability-ai/sdxl/versions/da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf/trainings
```

The response will be the training object:

```json
{
  "id": "zz4ibbonubfz7carwiefibzgga",
  "model": "stability-ai/sdxl",
  "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
  "input": {
    "input_images": "https://example.com/my-input-images.zip"
  },
  "logs": "",
  "error": null,
  "status": "starting",
  "created_at": "2023-09-08T16:32:56.990893084Z",
  "urls": {
    "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga",
     "get": "https://api.replicate.com/v1/predictions/zz4ibbonubfz7carwiefibzgga",
     "cancel": "https://api.replicate.com/v1/predictions/zz4ibbonubfz7carwiefibzgga/cancel"
  }
}
```

As models can take several minutes or more to train, the result will not be available immediately. To get the final result of the training you should either provide a `webhook` HTTPS URL for us to call when the results are ready, or poll the [get a training](#trainings.get) endpoint until it has finished.

When a training completes, it creates a new [version](https://replicate.com/docs/how-does-replicate-work#terminology) of the model at the specified destination.

To find some models to train on, check out the [trainable language models collection](https://replicate.com/collections/trainable-language-models).',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'version_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the version.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_delete_deployment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateDeleteDeployment',
    'class_basename' => 'ReplicateDeleteDeployment',
    'operation_id' => 'deployments.delete',
    'method' => 'DELETE',
    'path' => '/deployments/{deployment_owner}/{deployment_name}',
    'summary' => 'Delete a deployment',
    'description' => 'Delete a deployment

Deployment deletion has some restrictions:

- You can only delete deployments that have been offline and unused for at least 15 minutes.

Example cURL request:

```command
curl -s -X DELETE \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/deployments/acme/my-app-image-generator
```

The response will be an empty 204, indicating the deployment has been deleted.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deployment_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the deployment.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployment_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the deployment.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_delete_file' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateDeleteFile',
    'class_basename' => 'ReplicateDeleteFile',
    'operation_id' => 'files.delete',
    'method' => 'DELETE',
    'path' => '/files/{file_id}',
    'summary' => 'Delete a file',
    'description' => 'Delete a file. Once a file has been deleted, subsequent requests to the file resource return 404 Not found.

Example cURL request:

```console
curl -X DELETE \\
  -H "Authorization: Token $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'file_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the file to delete',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_delete_model' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateDeleteModel',
    'class_basename' => 'ReplicateDeleteModel',
    'operation_id' => 'models.delete',
    'method' => 'DELETE',
    'path' => '/models/{model_owner}/{model_name}',
    'summary' => 'Delete a model',
    'description' => 'Delete a model

Model deletion has some restrictions:

- You can only delete models you own.
- You can only delete private models.
- You can only delete models that have no versions associated with them. Currently you\'ll need to [delete the model\'s versions](#models.versions.delete) before you can delete the model itself.

Example cURL request:

```command
curl -s -X DELETE \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world
```

The response will be an empty 204, indicating the model has been deleted.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_delete_model_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateDeleteModelVersion',
    'class_basename' => 'ReplicateDeleteModelVersion',
    'operation_id' => 'models.versions.delete',
    'method' => 'DELETE',
    'path' => '/models/{model_owner}/{model_name}/versions/{version_id}',
    'summary' => 'Delete a model version',
    'description' => 'Delete a model version and all associated predictions, including all output files.

Model version deletion has some restrictions:

- You can only delete versions from models you own.
- You can only delete versions from private models.
- You cannot delete a version if someone other than you has run predictions with it.
- You cannot delete a version if it is being used as the base model for a fine tune/training.
- You cannot delete a version if it has an associated deployment.
- You cannot delete a version if another model version is overridden to use it.

Example cURL request:

```command
curl -s -X DELETE \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world/versions/5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa
```

The response will be an empty 202, indicating the deletion request has been accepted. It might take a few minutes to be processed.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'version_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the version.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_download_file' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateDownloadFile',
    'class_basename' => 'ReplicateDownloadFile',
    'operation_id' => 'files.download',
    'method' => 'GET',
    'path' => '/files/{file_id}/download',
    'summary' => 'Download a file',
    'description' => 'Download a file by providing the file owner, access expiry, and a valid signature.

Example cURL request:

```console
curl -X GET "https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o/download?expiry=1708515345&owner=mattt&signature=zuoghqlrcnw8YHywkpaXQlHsVhWen%2FDZ4aal76dLiOo%3D"
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'file_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the file to download',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'owner',
        'in' => 'query',
        'required' => true,
        'description' => 'The username of the user or organization that uploaded the file',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'expiry',
        'in' => 'query',
        'required' => true,
        'description' => 'A Unix timestamp with expiration date of this download URL',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'signature',
        'in' => 'query',
        'required' => true,
        'description' => 'A base64-encoded HMAC-SHA256 checksum of the string \'{owner} {id} {expiry}\' generated with the Files API signing secret',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_account' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetAccount',
    'class_basename' => 'ReplicateGetAccount',
    'operation_id' => 'account.get',
    'method' => 'GET',
    'path' => '/account',
    'summary' => 'Get the authenticated account',
    'description' => 'Returns information about the user or organization associated with the provided API token.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/account
```

The response will be a JSON object describing the account:

```json
{
  "type": "organization",
  "username": "acme",
  "name": "Acme Corp, Inc.",
  "github_url": "https://github.com/acme",
}
```',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_get_collection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetCollection',
    'class_basename' => 'ReplicateGetCollection',
    'operation_id' => 'collections.get',
    'method' => 'GET',
    'path' => '/collections/{collection_slug}',
    'summary' => 'Get a collection of models',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/collections/super-resolution
```

The response will be a collection object with a nested list of the models in that collection:

```json
{
  "name": "Super resolution",
  "slug": "super-resolution",
  "description": "Upscaling models that create high-quality images from low-quality images.",
  "full_description": "## Overview\\n\\nThese models generate high-quality images from low-quality images. Many of these models are based on **advanced upscaling techniques**.\\n\\n### Key Features\\n\\n- Enhance image resolution\\n- Restore fine details\\n- Improve overall image quality",
  "models": [...]
}
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection_slug',
        'in' => 'path',
        'required' => true,
        'description' => 'The slug of the collection, like `super-resolution` or `image-restoration`. See [replicate.com/collections](https://replicate.com/collections).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_default_webhook_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetDefaultWebhookSecret',
    'class_basename' => 'ReplicateGetDefaultWebhookSecret',
    'operation_id' => 'webhooks.default.secret.get',
    'method' => 'GET',
    'path' => '/webhooks/default/secret',
    'summary' => 'Get the signing secret for the default webhook',
    'description' => 'Get the signing secret for the default webhook endpoint. This is used to verify that webhook requests are coming from Replicate.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/webhooks/default/secret
```

The response will be a JSON object with a `key` property:

```json
{
  "key": "..."
}
```',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_get_deployment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetDeployment',
    'class_basename' => 'ReplicateGetDeployment',
    'operation_id' => 'deployments.get',
    'method' => 'GET',
    'path' => '/deployments/{deployment_owner}/{deployment_name}',
    'summary' => 'Get a deployment',
    'description' => 'Get information about a deployment by name including the current release.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/deployments/replicate/my-app-image-generator
```

The response will be a JSON object describing the deployment:

```json
{
  "owner": "acme",
  "name": "my-app-image-generator",
  "current_release": {
    "number": 1,
    "model": "stability-ai/sdxl",
    "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
    "created_at": "2024-02-15T16:32:57.018467Z",
    "created_by": {
      "type": "organization",
      "username": "acme",
      "name": "Acme Corp, Inc.",
      "avatar_url": "https://cdn.replicate.com/avatars/acme.png",
      "github_url": "https://github.com/acme"
    },
    "configuration": {
      "hardware": "gpu-t4",
      "min_instances": 1,
      "max_instances": 5
    }
  }
}
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deployment_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the deployment.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployment_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the deployment.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_file' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetFile',
    'class_basename' => 'ReplicateGetFile',
    'operation_id' => 'files.get',
    'method' => 'GET',
    'path' => '/files/{file_id}',
    'summary' => 'Get a file',
    'description' => 'Get the details of a file.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Token $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'file_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the file to get',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_model' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetModel',
    'class_basename' => 'ReplicateGetModel',
    'operation_id' => 'models.get',
    'method' => 'GET',
    'path' => '/models/{model_owner}/{model_name}',
    'summary' => 'Get a model',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world
```

The response will be a model object in the following format:

```json
{
  "url": "https://replicate.com/replicate/hello-world",
  "owner": "replicate",
  "name": "hello-world",
  "description": "A tiny model that says hello",
  "visibility": "public",
  "github_url": "https://github.com/replicate/cog-examples",
  "paper_url": null,
  "license_url": null,
  "run_count": 5681081,
  "cover_image_url": "...",
  "default_example": {...},
  "latest_version": {...},
}
```

The model object includes the [input and output schema](https://replicate.com/docs/reference/openapi#model-schemas) for the latest version of the model.

Here\'s an example showing how to fetch the model with cURL and display its input schema with [jq](https://stedolan.github.io/jq/):

```console
curl -s \\
    -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
    https://api.replicate.com/v1/models/replicate/hello-world \\
    | jq ".latest_version.openapi_schema.components.schemas.Input"
```

This will return the following JSON object:

```json
{
  "type": "object",
  "title": "Input",
  "required": [
    "text"
  ],
  "properties": {
    "text": {
      "type": "string",
      "title": "Text",
      "x-order": 0,
      "description": "Text to prefix with \'hello \'"
    }
  }
}
```

The `cover_image_url` string is an HTTPS URL for an image file. This can be:

- An image uploaded by the model author.
- The output file of the example prediction, if the model author has not set a cover image.
- The input file of the example prediction, if the model author has not set a cover image and the example prediction has no output file.
- A generic fallback image.

The `default_example` object is a [prediction](#predictions.get) created with this model.

The `latest_version` object is the model\'s most recently pushed [version](#models.versions.get).',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_model_readme' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetModelReadme',
    'class_basename' => 'ReplicateGetModelReadme',
    'operation_id' => 'models.readme.get',
    'method' => 'GET',
    'path' => '/models/{model_owner}/{model_name}/readme',
    'summary' => 'Get a model\'s README',
    'description' => 'Get the README content for a model.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world/readme
```

The response will be the README content as plain text in Markdown format:

```
# Hello World Model

This is an example model that...
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_model_version' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetModelVersion',
    'class_basename' => 'ReplicateGetModelVersion',
    'operation_id' => 'models.versions.get',
    'method' => 'GET',
    'path' => '/models/{model_owner}/{model_name}/versions/{version_id}',
    'summary' => 'Get a model version',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world/versions/5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa
```

The response will be the version object:

```json
{
  "id": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa",
  "created_at": "2022-04-26T19:29:04.418669Z",
  "cog_version": "0.3.0",
  "openapi_schema": {...}
}
```

Every model describes its inputs and outputs with [OpenAPI Schema Objects](https://spec.openapis.org/oas/latest.html#schemaObject) in the `openapi_schema` property.

The `openapi_schema.components.schemas.Input` property for the [replicate/hello-world](https://replicate.com/replicate/hello-world) model looks like this:

```json
{
  "type": "object",
  "title": "Input",
  "required": [
    "text"
  ],
  "properties": {
    "text": {
      "x-order": 0,
      "type": "string",
      "title": "Text",
      "description": "Text to prefix with \'hello \'"
    }
  }
}
```

The `openapi_schema.components.schemas.Output` property for the [replicate/hello-world](https://replicate.com/replicate/hello-world) model looks like this:

```json
{
  "type": "string",
  "title": "Output"
}
```

For more details, see the docs on [Cog\'s supported input and output types](https://github.com/replicate/cog/blob/75b7802219e7cd4cee845e34c4c22139558615d4/docs/python.md#input-and-output-types)',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'version_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the version.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_prediction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetPrediction',
    'class_basename' => 'ReplicateGetPrediction',
    'operation_id' => 'predictions.get',
    'method' => 'GET',
    'path' => '/predictions/{prediction_id}',
    'summary' => 'Get a prediction',
    'description' => 'Get the current state of a prediction.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu
```

The response will be the prediction object:

```json
{
  "id": "gm3qorzdhgbfurvjtvhg6dckhu",
  "model": "replicate/hello-world",
  "version": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa",
  "input": {
    "text": "Alice"
  },
  "logs": "",
  "output": "hello Alice",
  "error": null,
  "status": "succeeded",
  "created_at": "2023-09-08T16:19:34.765994Z",
  "source": "api",
  "data_removed": false,
  "started_at": "2023-09-08T16:19:34.779176Z",
  "completed_at": "2023-09-08T16:19:34.791859Z",
  "metrics": {
    "predict_time": 0.012683
  },
  "urls": {
    "web": "https://replicate.com/p/gm3qorzdhgbfurvjtvhg6dckhu",
    "get": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu",
    "cancel": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu/cancel"
  }
}
```

`source` will indicate how the prediction was created. Possible values are `web` or `api`.

`status` will be one of:

- `starting`: the prediction is starting up. If this status lasts longer than a few seconds, then it\'s typically because a new worker is being started to run the prediction.
- `processing`: the `predict()` method of the model is currently running.
- `succeeded`: the prediction completed successfully.
- `failed`: the prediction encountered an error during processing.
- `canceled`: the prediction was canceled by its creator.

In the case of success, `output` will be an object containing the output of the model. Any files will be represented as HTTPS URLs. You\'ll need to pass the `Authorization` header to request them.

In the case of failure, `error` will contain the error encountered during the prediction.

Terminated predictions (with a status of `succeeded`, `failed`, or `canceled`) will include a `metrics` object with a `predict_time` property showing the amount of CPU or GPU time, in seconds, that the prediction used while running. It won\'t include time waiting for the prediction to start. The `metrics` object will also include a `total_time` property showing the total time, in seconds, that the prediction took to complete.

All input parameters, output values, and logs are automatically removed after an hour, by default, for predictions created through the API.

You must save a copy of any data or files in the output if you\'d like to continue using them. The `output` key will still be present, but it\'s value will be `null` after the output has been removed.

Output files are served by `replicate.delivery` and its subdomains. If you use an allow list of external domains for your assets, add `replicate.delivery` and `*.replicate.delivery` to it.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'prediction_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the prediction to get.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_get_training' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateGetTraining',
    'class_basename' => 'ReplicateGetTraining',
    'operation_id' => 'trainings.get',
    'method' => 'GET',
    'path' => '/trainings/{training_id}',
    'summary' => 'Get a training',
    'description' => 'Get the current state of a training.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga
```

The response will be the training object:

```json
{
  "completed_at": "2023-09-08T16:41:19.826523Z",
  "created_at": "2023-09-08T16:32:57.018467Z",
  "error": null,
  "id": "zz4ibbonubfz7carwiefibzgga",
  "input": {
    "input_images": "https://example.com/my-input-images.zip"
  },
  "logs": "...",
  "metrics": {
    "predict_time": 502.713876
  },
  "output": {
    "version": "...",
    "weights": "..."
  },
  "started_at": "2023-09-08T16:32:57.112647Z",
  "status": "succeeded",
  "urls": {
    "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga",
    "get": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga",
    "cancel": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga/cancel"
  },
  "model": "stability-ai/sdxl",
  "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
}
```

`status` will be one of:

- `starting`: the training is starting up. If this status lasts longer than a few seconds, then it\'s typically because a new worker is being started to run the training.
- `processing`: the `train()` method of the model is currently running.
- `succeeded`: the training completed successfully.
- `failed`: the training encountered an error during processing.
- `canceled`: the training was canceled by its creator.

In the case of success, `output` will be an object containing the output of the model. Any files will be represented as HTTPS URLs. You\'ll need to pass the `Authorization` header to request them.

In the case of failure, `error` will contain the error encountered during the training.

Terminated trainings (with a status of `succeeded`, `failed`, or `canceled`) will include a `metrics` object with a `predict_time` property showing the amount of CPU or GPU time, in seconds, that the training used while running. It won\'t include time waiting for the training to start. The `metrics` object will also include a `total_time` property showing the total time, in seconds, that the training took to complete.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'training_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the training to get.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_list_collections' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListCollections',
    'class_basename' => 'ReplicateListCollections',
    'operation_id' => 'collections.list',
    'method' => 'GET',
    'path' => '/collections',
    'summary' => 'List collections of models',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/collections
```

The response will be a paginated JSON list of collection objects:

```json
{
  "next": "null",
  "previous": null,
  "results": [
    {
      "name": "Super resolution",
      "slug": "super-resolution",
      "description": "Upscaling models that create high-quality images from low-quality images."
    }
  ]
}
```',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_list_deployments' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListDeployments',
    'class_basename' => 'ReplicateListDeployments',
    'operation_id' => 'deployments.list',
    'method' => 'GET',
    'path' => '/deployments',
    'summary' => 'List deployments',
    'description' => 'Get a list of deployments associated with the current account, including the latest release configuration for each deployment.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/deployments
```

The response will be a paginated JSON array of deployment objects, sorted with the most recent deployment first:

```json
{
  "next": "http://api.replicate.com/v1/deployments?cursor=cD0yMDIzLTA2LTA2KzIzJTNBNDAlM0EwOC45NjMwMDAlMkIwMCUzQTAw",
  "previous": null,
  "results": [
    {
      "owner": "replicate",
      "name": "my-app-image-generator",
      "current_release": {
        "number": 1,
        "model": "stability-ai/sdxl",
        "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
        "created_at": "2024-02-15T16:32:57.018467Z",
        "created_by": {
          "type": "organization",
          "username": "acme",
          "name": "Acme Corp, Inc.",
          "avatar_url": "https://cdn.replicate.com/avatars/acme.png",
          "github_url": "https://github.com/acme"
        },
        "configuration": {
          "hardware": "gpu-t4",
          "min_instances": 1,
          "max_instances": 5
        }
      }
    }
  ]
}
```',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_list_files' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListFiles',
    'class_basename' => 'ReplicateListFiles',
    'operation_id' => 'files.list',
    'method' => 'GET',
    'path' => '/files',
    'summary' => 'List files',
    'description' => 'Get a paginated list of all files created by the user or organization associated with the provided API token.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Token $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/files
```

The response will be a paginated JSON array of file objects, sorted with the most recent file first.',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_list_hardware' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListHardware',
    'class_basename' => 'ReplicateListHardware',
    'operation_id' => 'hardware.list',
    'method' => 'GET',
    'path' => '/hardware',
    'summary' => 'List available hardware for models',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/hardware
```

The response will be a JSON array of hardware objects:

```json
[
    {"name": "CPU", "sku": "cpu"},
    {"name": "Nvidia T4 GPU", "sku": "gpu-t4"},
    {"name": "Nvidia A40 GPU", "sku": "gpu-a40-small"},
    {"name": "Nvidia A40 (Large) GPU", "sku": "gpu-a40-large"},
]
```',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_list_model_examples' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListModelExamples',
    'class_basename' => 'ReplicateListModelExamples',
    'operation_id' => 'models.examples.list',
    'method' => 'GET',
    'path' => '/models/{model_owner}/{model_name}/examples',
    'summary' => 'List examples for a model',
    'description' => 'List [example predictions](https://replicate.com/docs/topics/models/publish-a-model#what-are-examples) made using the model.
These are predictions that were saved by the model author as illustrative examples of the model\'s capabilities.

If you want all the examples for a model, use this operation.

If you just want the model\'s default example, you can use the [`models.get`](#models.get) operation instead, which includes a `default_example` object.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world/examples
```

The response will be a pagination object containing a list of example predictions:

```json
{
  "next": "https://api.replicate.com/v1/models/replicate/hello-world/examples?cursor=...",
  "previous": "https://api.replicate.com/v1/models/replicate/hello-world/examples?cursor=...",
  "results": [...]
}
```

Each item in the `results` list is a [prediction object](#predictions.get).',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_list_model_versions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListModelVersions',
    'class_basename' => 'ReplicateListModelVersions',
    'operation_id' => 'models.versions.list',
    'method' => 'GET',
    'path' => '/models/{model_owner}/{model_name}/versions',
    'summary' => 'List model versions',
    'description' => 'Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models/replicate/hello-world/versions
```

The response will be a JSON array of model version objects, sorted with the most recent version first:

```json
{
  "next": null,
  "previous": null,
  "results": [
    {
      "id": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa",
      "created_at": "2022-04-26T19:29:04.418669Z",
      "cog_version": "0.3.0",
      "openapi_schema": {...}
    }
  ]
}
```',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_list_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListModels',
    'class_basename' => 'ReplicateListModels',
    'operation_id' => 'models.list',
    'method' => 'GET',
    'path' => '/models',
    'summary' => 'List public models',
    'description' => 'Get a paginated list of public models.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/models
```

The response will be a pagination object containing a list of model objects.

See the [`models.get`](#models.get) docs for more details about the model object.

## Sorting

You can sort the results using the `sort_by` and `sort_direction` query parameters.

For example, to get the most recently created models:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  "https://api.replicate.com/v1/models?sort_by=model_created_at&sort_direction=desc"
```

Available sorting options:
- `model_created_at`: Sort by when the model was first created
- `latest_version_created_at`: Sort by when the model\'s latest version was created (default)

Sort direction can be `asc` (ascending) or `desc` (descending, default).',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'description' => 'Field to sort models by. Defaults to `latest_version_created_at`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort direction. Defaults to `desc` (descending, newest first).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_list_predictions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListPredictions',
    'class_basename' => 'ReplicateListPredictions',
    'operation_id' => 'predictions.list',
    'method' => 'GET',
    'path' => '/predictions',
    'summary' => 'List predictions',
    'description' => 'Get a paginated list of all predictions created by the user or organization associated with the provided API token.

This will include predictions created from the API and the website. It will return 100 records per page.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/predictions
```

The response will be a paginated JSON array of prediction objects, sorted with the most recent prediction first:

```json
{
  "next": null,
  "previous": null,
  "results": [
    {
      "completed_at": "2023-09-08T16:19:34.791859Z",
      "created_at": "2023-09-08T16:19:34.907244Z",
      "data_removed": false,
      "error": null,
      "id": "gm3qorzdhgbfurvjtvhg6dckhu",
      "input": {
        "text": "Alice"
      },
      "metrics": {
        "predict_time": 0.012683
      },
      "output": "hello Alice",
      "started_at": "2023-09-08T16:19:34.779176Z",
      "source": "api",
      "status": "succeeded",
      "urls": {
        "web": "https://replicate.com/p/gm3qorzdhgbfurvjtvhg6dckhu",
        "get": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu",
        "cancel": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu/cancel"
      },
      "model": "replicate/hello-world",
      "version": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa",
    }
  ]
}
```

`id` will be the unique ID of the prediction.

`source` will indicate how the prediction was created. Possible values are `web` or `api`.

`status` will be the status of the prediction. Refer to [get a single prediction](#predictions.get) for possible values.

`urls` will be a convenience object that can be used to construct new API requests for the given prediction. If the requested model version supports streaming, this will have a `stream` entry with an HTTPS URL that you can use to construct an [`EventSource`](https://developer.mozilla.org/en-US/docs/Web/API/EventSource).

`model` will be the model identifier string in the format of `{model_owner}/{model_name}`.

`version` will be the unique ID of model version used to create the prediction.

`data_removed` will be `true` if the input and output data has been deleted.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'created_after',
        'in' => 'query',
        'required' => false,
        'description' => 'Include only predictions created at or after this date-time, in ISO 8601 format.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'created_before',
        'in' => 'query',
        'required' => false,
        'description' => 'Include only predictions created before this date-time, in ISO 8601 format.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'source',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter predictions by how they were created. Currently only `web` is supported.

If no value is set, the API returns predictions from both API and web sources.

When filtering by `source=web`, results are limited to predictions created in the last 14 days.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_list_trainings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateListTrainings',
    'class_basename' => 'ReplicateListTrainings',
    'operation_id' => 'trainings.list',
    'method' => 'GET',
    'path' => '/trainings',
    'summary' => 'List trainings',
    'description' => 'Get a paginated list of all trainings created by the user or organization associated with the provided API token.

This will include trainings created from the API and the website. It will return 100 records per page.

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  https://api.replicate.com/v1/trainings
```

The response will be a paginated JSON array of training objects, sorted with the most recent training first:

```json
{
  "next": null,
  "previous": null,
  "results": [
    {
      "completed_at": "2023-09-08T16:41:19.826523Z",
      "created_at": "2023-09-08T16:32:57.018467Z",
      "error": null,
      "id": "zz4ibbonubfz7carwiefibzgga",
      "input": {
        "input_images": "https://example.com/my-input-images.zip"
      },
      "metrics": {
        "predict_time": 502.713876
      },
      "output": {
        "version": "...",
        "weights": "..."
      },
      "started_at": "2023-09-08T16:32:57.112647Z",
      "source": "api",
      "status": "succeeded",
      "urls": {
        "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga",
        "get": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga",
        "cancel": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga/cancel"
      },
      "model": "stability-ai/sdxl",
      "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
    }
  ]
}
```

`id` will be the unique ID of the training.

`source` will indicate how the training was created. Possible values are `web` or `api`.

`status` will be the status of the training. Refer to [get a single training](#trainings.get) for possible values.

`urls` will be a convenience object that can be used to construct new API requests for the given training.

`version` will be the unique ID of model version used to create the training.',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'replicate_search' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateSearch',
    'class_basename' => 'ReplicateSearch',
    'operation_id' => 'search',
    'method' => 'GET',
    'path' => '/search',
    'summary' => 'Search models, collections, and docs (beta)',
    'description' => 'Search for public models, collections, and docs using a text query.

For models, the response includes all model data, plus a new `metadata` object with the following fields:

- `generated_description`: A longer and more detailed AI-generated description of the model
- `tags`: An array of tags for the model
- `score`: A score for the model\'s relevance to the search query

Example cURL request:

```console
curl -s \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  "https://api.replicate.com/v1/search?query=nano+banana"
```

Note: This search API is currently in beta and may change in future versions.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => true,
        'description' => 'The search query string',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of model results to return (1-50, defaults to 20)',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'replicate_search_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateSearchModels',
    'class_basename' => 'ReplicateSearchModels',
    'operation_id' => 'models.search',
    'method' => 'QUERY',
    'path' => '/models',
    'summary' => 'Search public models',
    'description' => 'Get a list of public models matching a search query.

Example cURL request:

```console
curl -s -X QUERY \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H "Content-Type: text/plain" \\
  -d "hello" \\
  https://api.replicate.com/v1/models
```

The response will be a paginated JSON object containing an array of model objects.

See the [`models.get`](#models.get) docs for more details about the model object.',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'text/plain',
      ),
      'description' => '',
    ),
  ),
  'replicate_update_deployment' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateUpdateDeployment',
    'class_basename' => 'ReplicateUpdateDeployment',
    'operation_id' => 'deployments.update',
    'method' => 'PATCH',
    'path' => '/deployments/{deployment_owner}/{deployment_name}',
    'summary' => 'Update a deployment',
    'description' => 'Update properties of an existing deployment, including hardware, min/max instances, and the deployment\'s underlying model [version](https://replicate.com/docs/how-does-replicate-work#versions).

Example cURL request:

```console
curl -s \\
  -X PATCH \\
  -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\
  -H "Content-Type: application/json" \\
  -d \'{"min_instances": 3, "max_instances": 10}\' \\
  https://api.replicate.com/v1/deployments/acme/my-app-image-generator
```

The response will be a JSON object describing the deployment:

```json
{
  "owner": "acme",
  "name": "my-app-image-generator",
  "current_release": {
    "number": 2,
    "model": "stability-ai/sdxl",
    "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf",
    "created_at": "2024-02-15T16:32:57.018467Z",
    "created_by": {
      "type": "organization",
      "username": "acme",
      "name": "Acme Corp, Inc.",
      "avatar_url": "https://cdn.replicate.com/avatars/acme.png",
      "github_url": "https://github.com/acme"
    },
    "configuration": {
      "hardware": "gpu-t4",
      "min_instances": 3,
      "max_instances": 10
    }
  }
}
```

Updating any deployment properties will increment the `number` field of the `current_release`.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deployment_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the deployment.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployment_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the deployment.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'replicate_update_model' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Replicate\\Tools\\ReplicateUpdateModel',
    'class_basename' => 'ReplicateUpdateModel',
    'operation_id' => 'models.update',
    'method' => 'PATCH',
    'path' => '/models/{model_owner}/{model_name}',
    'summary' => 'Update metadata for a model',
    'description' => 'Update select properties of an existing model.

You can update the following properties:

  - `description` - Model description
  - `readme` - Model README content
  - `github_url` - GitHub repository URL
  - `paper_url` - Research paper URL
  - `weights_url` - Model weights URL
  - `license_url` - License URL

Example cURL request:

```console
curl -X PATCH \\
  https://api.replicate.com/v1/models/your-username/your-model-name \\
  -H "Authorization: Token $REPLICATE_API_TOKEN" \\
  -H "Content-Type: application/json" \\
  -d \'{
    "description": "Detect hot dogs in images",
    "readme": "# Hot Dog Detector\\n\\n Ketchup, mustard, and onions...",
    "github_url": "https://github.com/alice/hot-dog-detector",
    "paper_url": "https://arxiv.org/abs/2504.17639",
    "weights_url": "https://huggingface.co/alice/hot-dog-detector",
    "license_url": "https://choosealicense.com/licenses/mit/"
  }\'
```

The response will be the updated model object with all of its properties.',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'model_owner',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the user or organization that owns the model.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'model_name',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the model.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
);
    }
}
