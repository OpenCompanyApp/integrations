<?php

namespace OpenCompany\Integrations\Replicate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Publishes Replicate HTTP API tools to host discovery surfaces.
 *
 * Tool metadata is generated from Replicate's official OpenAPI schema while
 * this provider handles credentials, multi-account resolution, and catalog UI.
 */
class ReplicateToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Compact tool definitions for static catalog extraction.
     *
     * @var array<string, array{0: string, 1: string, 2: string, 3: string, 4: string}>
     */
    private const TOOL_DEFINITIONS = [
        'replicate_cancel_prediction' => [
            'ReplicateCancelPrediction',
            'write',
            'Cancel a prediction',
            'Cancel a prediction that is currently running. Example cURL request that creates a prediction and then cancels it: ```console # First, create a prediction PREDICTION_ID=$(curl -s -X POST \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H "Content-Type: application/json" \\ -d \'{ "input": { "prompt": "a video that may take a while to generate" } }\' \\ https://api.replicate.com/v1/models/minimax/video-01/predictions | jq -r \'.id\') # Echo the prediction ID echo "Created prediction with ID: $PREDICTION_ID" # Cancel the prediction curl -s -X POST \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/predictions/$PREDICTION_ID/cancel ```',
            'ph:play',
        ],
        'replicate_cancel_training' => [
            'ReplicateCancelTraining',
            'write',
            'Cancel a training',
            'Cancel a training',
            'ph:graduation-cap',
        ],
        'replicate_create_deployment' => [
            'ReplicateCreateDeployment',
            'write',
            'Create a deployment',
            'Create a new deployment: Example cURL request: ```console curl -s \\ -X POST \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H "Content-Type: application/json" \\ -d \'{ "name": "my-app-image-generator", "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "hardware": "gpu-t4", "min_instances": 0, "max_instances": 3 }\' \\ https://api.replicate.com/v1/deployments ``` The response will be a JSON object describing the deployment: ```json { "owner": "acme", "name": "my-app-image-generator", "current_release": { "number": 1, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "created_at": "2024-02-15T16:32:57.018467Z", "created_by": { "type": "organization", "username": "acme", "name": "Acme Corp, Inc.", "avatar_url": "https://cdn.replicate.com/avatars/acme.png", "github_url": "https://github.com/acme" }, "configuration": { "hardware": "gpu-t4", "min_instances": 1, "max_instances": 5 } } } ```',
            'ph:rocket-launch',
        ],
        'replicate_create_deployment_prediction' => [
            'ReplicateCreateDeploymentPrediction',
            'write',
            'Create a prediction using a deployment',
            'Create a prediction for the deployment and inputs you provide. Example cURL request: ```console curl -s -X POST -H \'Prefer: wait\' \\ -d \'{"input": {"prompt": "A photo of a bear riding a bicycle over the moon"}}\' \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H \'Content-Type: application/json\' \\ https://api.replicate.com/v1/deployments/acme/my-app-image-generator/predictions ``` The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint. For a complete overview of the `deployments.predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
            'ph:play',
        ],
        'replicate_create_file' => [
            'ReplicateCreateFile',
            'write',
            'Create a file',
            'Create a file by uploading its content and optional metadata. Example cURL request: ```console curl -X POST https://api.replicate.com/v1/files \\ -H "Authorization: Token $REPLICATE_API_TOKEN" \\ -H \'Content-Type: multipart/form-data\' \\ -F \'content=@/path/to/archive.zip;type=application/zip;filename=example.zip\' \\ -F \'metadata={"customer_reference_id": 123};type=application/json\' ``` The request must include: - `content`: The file content (required) - `type`: The content / MIME type for the file (defaults to `application/octet-stream`) - `filename`: The filename (required, 255 bytes, valid UTF-8) - `metadata`: User-provided metadata associated with the file (defaults to `{}`, must be valid JSON)',
            'ph:file',
        ],
        'replicate_create_model' => [
            'ReplicateCreateModel',
            'write',
            'Create a model',
            'Create a model. Example cURL request: ```console curl -s -X POST \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H \'Content-Type: application/json\' \\ -d \'{"owner": "alice", "name": "hot-dog-detector", "description": "Detect hot dogs in images", "visibility": "public", "hardware": "cpu"}\' \\ https://api.replicate.com/v1/models ``` The response will be a model object in the following format: ```json { "url": "https://replicate.com/alice/hot-dog-detector", "owner": "alice", "name": "hot-dog-detector", "description": "Detect hot dogs in images", "visibility": "public", "github_url": null, "paper_url": null, "license_url": null, "run_count": 0, "cover_image_url": null, "default_example": null, "latest_version": null, } ``` Note that there is a limit of 1,000 models per account. For most purposes, we recommend using a single model and pushing new [versions](https://replicate.com/docs/how-does-replicate-work#versions) of the model as you make changes to it.',
            'ph:cube',
        ],
        'replicate_create_model_prediction' => [
            'ReplicateCreateModelPrediction',
            'write',
            'Create a prediction using an official model',
            'Create a prediction using an [official model](https://replicate.com/changelog/2025-01-29-official-models). If you\'re _not_ running an official model, use the [`predictions.create`](#predictions.create) operation instead. Example cURL request: ```console curl -s -X POST -H \'Prefer: wait\' \\ -d \'{"input": {"prompt": "Write a short poem about the weather."}}\' \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H \'Content-Type: application/json\' \\ https://api.replicate.com/v1/models/meta/meta-llama-3-70b-instruct/predictions ``` The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint. For a complete overview of the `deployments.predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
            'ph:play',
        ],
        'replicate_create_prediction' => [
            'ReplicateCreatePrediction',
            'write',
            'Create a prediction',
            'Create a prediction for the model version and inputs you provide. Example cURL request: ```console curl -s -X POST -H \'Prefer: wait\' \\ -d \'{"version": "replicate/hello-world:5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", "input": {"text": "Alice"}}\' \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H \'Content-Type: application/json\' \\ https://api.replicate.com/v1/predictions ``` The request will wait up to 60 seconds for the model to run. If this time is exceeded the prediction will be returned in a `"starting"` state and need to be retrieved using the `predictions.get` endpoint. For a complete overview of the `predictions.create` API check out our documentation on [creating a prediction](https://replicate.com/docs/topics/predictions/create-a-prediction) which covers a variety of use cases.',
            'ph:play',
        ],
        'replicate_create_training' => [
            'ReplicateCreateTraining',
            'write',
            'Create a training',
            'Start a new training of the model version you specify. Example request body: ```json { "destination": "{new_owner}/{new_name}", "input": { "train_data": "https://example.com/my-input-images.zip", }, "webhook": "https://example.com/my-webhook", } ``` Example cURL request: ```console curl -s -X POST \\ -d \'{"destination": "{new_owner}/{new_name}", "input": {"input_images": "https://example.com/my-input-images.zip"}}\' \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H \'Content-Type: application/json\' \\ https://api.replicate.com/v1/models/stability-ai/sdxl/versions/da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf/trainings ``` The response will be the training object: ```json { "id": "zz4ibbonubfz7carwiefibzgga", "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "input": { "input_images": "https://example.com/my-input-images.zip" }, "logs": "", "error": null, "status": "starting", "created_at": "2023-09-08T16:32:56.990893084Z", "urls": { "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga", "get": "https://api.replicate.com/v1/predictions/zz4ibbonubfz7carwiefibzgga", "cancel": "https://api.replicate.com/v1/predictions/zz4ibbonubfz7carwiefibzgga/cancel" } } ``` As models can take several minutes or more to train, the result will not be available immediately. To get the final result of the training you should either provide a `webhook` HTTPS URL for us to call when the results are ready, or poll the [get a training](#trainings.get) endpoint until it has finished. When a training completes, it creates a new [version](https://replicate.com/docs/how-does-replicate-work#terminology) of the model at the specified destination. To find some models to train on, check out the [trainable language models collection](https://replicate.com/collections/trainable-language-models).',
            'ph:graduation-cap',
        ],
        'replicate_delete_deployment' => [
            'ReplicateDeleteDeployment',
            'write',
            'Delete a deployment',
            'Delete a deployment Deployment deletion has some restrictions: - You can only delete deployments that have been offline and unused for at least 15 minutes. Example cURL request: ```command curl -s -X DELETE \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/deployments/acme/my-app-image-generator ``` The response will be an empty 204, indicating the deployment has been deleted.',
            'ph:rocket-launch',
        ],
        'replicate_delete_file' => [
            'ReplicateDeleteFile',
            'write',
            'Delete a file',
            'Delete a file. Once a file has been deleted, subsequent requests to the file resource return 404 Not found. Example cURL request: ```console curl -X DELETE \\ -H "Authorization: Token $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o ```',
            'ph:file',
        ],
        'replicate_delete_model' => [
            'ReplicateDeleteModel',
            'write',
            'Delete a model',
            'Delete a model Model deletion has some restrictions: - You can only delete models you own. - You can only delete private models. - You can only delete models that have no versions associated with them. Currently you\'ll need to [delete the model\'s versions](#models.versions.delete) before you can delete the model itself. Example cURL request: ```command curl -s -X DELETE \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world ``` The response will be an empty 204, indicating the model has been deleted.',
            'ph:cube',
        ],
        'replicate_delete_model_version' => [
            'ReplicateDeleteModelVersion',
            'write',
            'Delete a model version',
            'Delete a model version and all associated predictions, including all output files. Model version deletion has some restrictions: - You can only delete versions from models you own. - You can only delete versions from private models. - You cannot delete a version if someone other than you has run predictions with it. - You cannot delete a version if it is being used as the base model for a fine tune/training. - You cannot delete a version if it has an associated deployment. - You cannot delete a version if another model version is overridden to use it. Example cURL request: ```command curl -s -X DELETE \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world/versions/5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa ``` The response will be an empty 202, indicating the deletion request has been accepted. It might take a few minutes to be processed.',
            'ph:cube',
        ],
        'replicate_download_file' => [
            'ReplicateDownloadFile',
            'read',
            'Download a file',
            'Download a file by providing the file owner, access expiry, and a valid signature. Example cURL request: ```console curl -X GET "https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o/download?expiry=1708515345&owner=mattt&signature=zuoghqlrcnw8YHywkpaXQlHsVhWen%2FDZ4aal76dLiOo%3D" ```',
            'ph:file',
        ],
        'replicate_get_account' => [
            'ReplicateGetAccount',
            'read',
            'Get the authenticated account',
            'Returns information about the user or organization associated with the provided API token. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/account ``` The response will be a JSON object describing the account: ```json { "type": "organization", "username": "acme", "name": "Acme Corp, Inc.", "github_url": "https://github.com/acme", } ```',
            'ph:brain',
        ],
        'replicate_get_collection' => [
            'ReplicateGetCollection',
            'read',
            'Get a collection of models',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/collections/super-resolution ``` The response will be a collection object with a nested list of the models in that collection: ```json { "name": "Super resolution", "slug": "super-resolution", "description": "Upscaling models that create high-quality images from low-quality images.", "full_description": "## Overview\\n\\nThese models generate high-quality images from low-quality images. Many of these models are based on **advanced upscaling techniques**.\\n\\n### Key Features\\n\\n- Enhance image resolution\\n- Restore fine details\\n- Improve overall image quality", "models": [...] } ```',
            'ph:brain',
        ],
        'replicate_get_default_webhook_secret' => [
            'ReplicateGetDefaultWebhookSecret',
            'read',
            'Get the signing secret for the default webhook',
            'Get the signing secret for the default webhook endpoint. This is used to verify that webhook requests are coming from Replicate. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/webhooks/default/secret ``` The response will be a JSON object with a `key` property: ```json { "key": "..." } ```',
            'ph:webhooks-logo',
        ],
        'replicate_get_deployment' => [
            'ReplicateGetDeployment',
            'read',
            'Get a deployment',
            'Get information about a deployment by name including the current release. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/deployments/replicate/my-app-image-generator ``` The response will be a JSON object describing the deployment: ```json { "owner": "acme", "name": "my-app-image-generator", "current_release": { "number": 1, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "created_at": "2024-02-15T16:32:57.018467Z", "created_by": { "type": "organization", "username": "acme", "name": "Acme Corp, Inc.", "avatar_url": "https://cdn.replicate.com/avatars/acme.png", "github_url": "https://github.com/acme" }, "configuration": { "hardware": "gpu-t4", "min_instances": 1, "max_instances": 5 } } } ```',
            'ph:rocket-launch',
        ],
        'replicate_get_file' => [
            'ReplicateGetFile',
            'read',
            'Get a file',
            'Get the details of a file. Example cURL request: ```console curl -s \\ -H "Authorization: Token $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/files/cneqzikepnug6xezperrr4z55o ```',
            'ph:file',
        ],
        'replicate_get_model' => [
            'ReplicateGetModel',
            'read',
            'Get a model',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world ``` The response will be a model object in the following format: ```json { "url": "https://replicate.com/replicate/hello-world", "owner": "replicate", "name": "hello-world", "description": "A tiny model that says hello", "visibility": "public", "github_url": "https://github.com/replicate/cog-examples", "paper_url": null, "license_url": null, "run_count": 5681081, "cover_image_url": "...", "default_example": {...}, "latest_version": {...}, } ``` The model object includes the [input and output schema](https://replicate.com/docs/reference/openapi#model-schemas) for the latest version of the model. Here\'s an example showing how to fetch the model with cURL and display its input schema with [jq](https://stedolan.github.io/jq/): ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world \\ | jq ".latest_version.openapi_schema.components.schemas.Input" ``` This will return the following JSON object: ```json { "type": "object", "title": "Input", "required": [ "text" ], "properties": { "text": { "type": "string", "title": "Text", "x-order": 0, "description": "Text to prefix with \'hello \'" } } } ``` The `cover_image_url` string is an HTTPS URL for an image file. This can be: - An image uploaded by the model author. - The output file of the example prediction, if the model author has not set a cover image. - The input file of the example prediction, if the model author has not set a cover image and the example prediction has no output file. - A generic fallback image. The `default_example` object is a [prediction](#predictions.get) created with this model. The `latest_version` object is the model\'s most recently pushed [version](#models.versions.get).',
            'ph:cube',
        ],
        'replicate_get_model_readme' => [
            'ReplicateGetModelReadme',
            'read',
            'Get a model\'s README',
            'Get the README content for a model. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world/readme ``` The response will be the README content as plain text in Markdown format: ``` # Hello World Model This is an example model that... ```',
            'ph:cube',
        ],
        'replicate_get_model_version' => [
            'ReplicateGetModelVersion',
            'read',
            'Get a model version',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world/versions/5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa ``` The response will be the version object: ```json { "id": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", "created_at": "2022-04-26T19:29:04.418669Z", "cog_version": "0.3.0", "openapi_schema": {...} } ``` Every model describes its inputs and outputs with [OpenAPI Schema Objects](https://spec.openapis.org/oas/latest.html#schemaObject) in the `openapi_schema` property. The `openapi_schema.components.schemas.Input` property for the [replicate/hello-world](https://replicate.com/replicate/hello-world) model looks like this: ```json { "type": "object", "title": "Input", "required": [ "text" ], "properties": { "text": { "x-order": 0, "type": "string", "title": "Text", "description": "Text to prefix with \'hello \'" } } } ``` The `openapi_schema.components.schemas.Output` property for the [replicate/hello-world](https://replicate.com/replicate/hello-world) model looks like this: ```json { "type": "string", "title": "Output" } ``` For more details, see the docs on [Cog\'s supported input and output types](https://github.com/replicate/cog/blob/75b7802219e7cd4cee845e34c4c22139558615d4/docs/python.md#input-and-output-types)',
            'ph:cube',
        ],
        'replicate_get_prediction' => [
            'ReplicateGetPrediction',
            'read',
            'Get a prediction',
            'Get the current state of a prediction. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu ``` The response will be the prediction object: ```json { "id": "gm3qorzdhgbfurvjtvhg6dckhu", "model": "replicate/hello-world", "version": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", "input": { "text": "Alice" }, "logs": "", "output": "hello Alice", "error": null, "status": "succeeded", "created_at": "2023-09-08T16:19:34.765994Z", "source": "api", "data_removed": false, "started_at": "2023-09-08T16:19:34.779176Z", "completed_at": "2023-09-08T16:19:34.791859Z", "metrics": { "predict_time": 0.012683 }, "urls": { "web": "https://replicate.com/p/gm3qorzdhgbfurvjtvhg6dckhu", "get": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu", "cancel": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu/cancel" } } ``` `source` will indicate how the prediction was created. Possible values are `web` or `api`. `status` will be one of: - `starting`: the prediction is starting up. If this status lasts longer than a few seconds, then it\'s typically because a new worker is being started to run the prediction. - `processing`: the `predict()` method of the model is currently running. - `succeeded`: the prediction completed successfully. - `failed`: the prediction encountered an error during processing. - `canceled`: the prediction was canceled by its creator. In the case of success, `output` will be an object containing the output of the model. Any files will be represented as HTTPS URLs. You\'ll need to pass the `Authorization` header to request them. In the case of failure, `error` will contain the error encountered during the prediction. Terminated predictions (with a status of `succeeded`, `failed`, or `canceled`) will include a `metrics` object with a `predict_time` property showing the amount of CPU or GPU time, in seconds, that the prediction used while running. It won\'t include time waiting for the prediction to start. The `metrics` object will also include a `total_time` property showing the total time, in seconds, that the prediction took to complete. All input parameters, output values, and logs are automatically removed after an hour, by default, for predictions created through the API. You must save a copy of any data or files in the output if you\'d like to continue using them. The `output` key will still be present, but it\'s value will be `null` after the output has been removed. Output files are served by `replicate.delivery` and its subdomains. If you use an allow list of external domains for your assets, add `replicate.delivery` and `*.replicate.delivery` to it.',
            'ph:play',
        ],
        'replicate_get_training' => [
            'ReplicateGetTraining',
            'read',
            'Get a training',
            'Get the current state of a training. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga ``` The response will be the training object: ```json { "completed_at": "2023-09-08T16:41:19.826523Z", "created_at": "2023-09-08T16:32:57.018467Z", "error": null, "id": "zz4ibbonubfz7carwiefibzgga", "input": { "input_images": "https://example.com/my-input-images.zip" }, "logs": "...", "metrics": { "predict_time": 502.713876 }, "output": { "version": "...", "weights": "..." }, "started_at": "2023-09-08T16:32:57.112647Z", "status": "succeeded", "urls": { "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga", "get": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga", "cancel": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga/cancel" }, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", } ``` `status` will be one of: - `starting`: the training is starting up. If this status lasts longer than a few seconds, then it\'s typically because a new worker is being started to run the training. - `processing`: the `train()` method of the model is currently running. - `succeeded`: the training completed successfully. - `failed`: the training encountered an error during processing. - `canceled`: the training was canceled by its creator. In the case of success, `output` will be an object containing the output of the model. Any files will be represented as HTTPS URLs. You\'ll need to pass the `Authorization` header to request them. In the case of failure, `error` will contain the error encountered during the training. Terminated trainings (with a status of `succeeded`, `failed`, or `canceled`) will include a `metrics` object with a `predict_time` property showing the amount of CPU or GPU time, in seconds, that the training used while running. It won\'t include time waiting for the training to start. The `metrics` object will also include a `total_time` property showing the total time, in seconds, that the training took to complete.',
            'ph:graduation-cap',
        ],
        'replicate_list_collections' => [
            'ReplicateListCollections',
            'read',
            'List collections of models',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/collections ``` The response will be a paginated JSON list of collection objects: ```json { "next": "null", "previous": null, "results": [ { "name": "Super resolution", "slug": "super-resolution", "description": "Upscaling models that create high-quality images from low-quality images." } ] } ```',
            'ph:brain',
        ],
        'replicate_list_deployments' => [
            'ReplicateListDeployments',
            'read',
            'List deployments',
            'Get a list of deployments associated with the current account, including the latest release configuration for each deployment. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/deployments ``` The response will be a paginated JSON array of deployment objects, sorted with the most recent deployment first: ```json { "next": "http://api.replicate.com/v1/deployments?cursor=cD0yMDIzLTA2LTA2KzIzJTNBNDAlM0EwOC45NjMwMDAlMkIwMCUzQTAw", "previous": null, "results": [ { "owner": "replicate", "name": "my-app-image-generator", "current_release": { "number": 1, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "created_at": "2024-02-15T16:32:57.018467Z", "created_by": { "type": "organization", "username": "acme", "name": "Acme Corp, Inc.", "avatar_url": "https://cdn.replicate.com/avatars/acme.png", "github_url": "https://github.com/acme" }, "configuration": { "hardware": "gpu-t4", "min_instances": 1, "max_instances": 5 } } } ] } ```',
            'ph:rocket-launch',
        ],
        'replicate_list_files' => [
            'ReplicateListFiles',
            'read',
            'List files',
            'Get a paginated list of all files created by the user or organization associated with the provided API token. Example cURL request: ```console curl -s \\ -H "Authorization: Token $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/files ``` The response will be a paginated JSON array of file objects, sorted with the most recent file first.',
            'ph:file',
        ],
        'replicate_list_hardware' => [
            'ReplicateListHardware',
            'read',
            'List available hardware for models',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/hardware ``` The response will be a JSON array of hardware objects: ```json [ {"name": "CPU", "sku": "cpu"}, {"name": "Nvidia T4 GPU", "sku": "gpu-t4"}, {"name": "Nvidia A40 GPU", "sku": "gpu-a40-small"}, {"name": "Nvidia A40 (Large) GPU", "sku": "gpu-a40-large"}, ] ```',
            'ph:brain',
        ],
        'replicate_list_model_examples' => [
            'ReplicateListModelExamples',
            'read',
            'List examples for a model',
            'List [example predictions](https://replicate.com/docs/topics/models/publish-a-model#what-are-examples) made using the model. These are predictions that were saved by the model author as illustrative examples of the model\'s capabilities. If you want all the examples for a model, use this operation. If you just want the model\'s default example, you can use the [`models.get`](#models.get) operation instead, which includes a `default_example` object. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world/examples ``` The response will be a pagination object containing a list of example predictions: ```json { "next": "https://api.replicate.com/v1/models/replicate/hello-world/examples?cursor=...", "previous": "https://api.replicate.com/v1/models/replicate/hello-world/examples?cursor=...", "results": [...] } ``` Each item in the `results` list is a [prediction object](#predictions.get).',
            'ph:cube',
        ],
        'replicate_list_model_versions' => [
            'ReplicateListModelVersions',
            'read',
            'List model versions',
            'Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models/replicate/hello-world/versions ``` The response will be a JSON array of model version objects, sorted with the most recent version first: ```json { "next": null, "previous": null, "results": [ { "id": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", "created_at": "2022-04-26T19:29:04.418669Z", "cog_version": "0.3.0", "openapi_schema": {...} } ] } ```',
            'ph:cube',
        ],
        'replicate_list_models' => [
            'ReplicateListModels',
            'read',
            'List public models',
            'Get a paginated list of public models. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/models ``` The response will be a pagination object containing a list of model objects. See the [`models.get`](#models.get) docs for more details about the model object. ## Sorting You can sort the results using the `sort_by` and `sort_direction` query parameters. For example, to get the most recently created models: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ "https://api.replicate.com/v1/models?sort_by=model_created_at&sort_direction=desc" ``` Available sorting options: - `model_created_at`: Sort by when the model was first created - `latest_version_created_at`: Sort by when the model\'s latest version was created (default) Sort direction can be `asc` (ascending) or `desc` (descending, default).',
            'ph:cube',
        ],
        'replicate_list_predictions' => [
            'ReplicateListPredictions',
            'read',
            'List predictions',
            'Get a paginated list of all predictions created by the user or organization associated with the provided API token. This will include predictions created from the API and the website. It will return 100 records per page. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/predictions ``` The response will be a paginated JSON array of prediction objects, sorted with the most recent prediction first: ```json { "next": null, "previous": null, "results": [ { "completed_at": "2023-09-08T16:19:34.791859Z", "created_at": "2023-09-08T16:19:34.907244Z", "data_removed": false, "error": null, "id": "gm3qorzdhgbfurvjtvhg6dckhu", "input": { "text": "Alice" }, "metrics": { "predict_time": 0.012683 }, "output": "hello Alice", "started_at": "2023-09-08T16:19:34.779176Z", "source": "api", "status": "succeeded", "urls": { "web": "https://replicate.com/p/gm3qorzdhgbfurvjtvhg6dckhu", "get": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu", "cancel": "https://api.replicate.com/v1/predictions/gm3qorzdhgbfurvjtvhg6dckhu/cancel" }, "model": "replicate/hello-world", "version": "5c7d5dc6dd8bf75c1acaa8565735e7986bc5b66206b55cca93cb72c9bf15ccaa", } ] } ``` `id` will be the unique ID of the prediction. `source` will indicate how the prediction was created. Possible values are `web` or `api`. `status` will be the status of the prediction. Refer to [get a single prediction](#predictions.get) for possible values. `urls` will be a convenience object that can be used to construct new API requests for the given prediction. If the requested model version supports streaming, this will have a `stream` entry with an HTTPS URL that you can use to construct an [`EventSource`](https://developer.mozilla.org/en-US/docs/Web/API/EventSource). `model` will be the model identifier string in the format of `{model_owner}/{model_name}`. `version` will be the unique ID of model version used to create the prediction. `data_removed` will be `true` if the input and output data has been deleted.',
            'ph:play',
        ],
        'replicate_list_trainings' => [
            'ReplicateListTrainings',
            'read',
            'List trainings',
            'Get a paginated list of all trainings created by the user or organization associated with the provided API token. This will include trainings created from the API and the website. It will return 100 records per page. Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ https://api.replicate.com/v1/trainings ``` The response will be a paginated JSON array of training objects, sorted with the most recent training first: ```json { "next": null, "previous": null, "results": [ { "completed_at": "2023-09-08T16:41:19.826523Z", "created_at": "2023-09-08T16:32:57.018467Z", "error": null, "id": "zz4ibbonubfz7carwiefibzgga", "input": { "input_images": "https://example.com/my-input-images.zip" }, "metrics": { "predict_time": 502.713876 }, "output": { "version": "...", "weights": "..." }, "started_at": "2023-09-08T16:32:57.112647Z", "source": "api", "status": "succeeded", "urls": { "web": "https://replicate.com/p/zz4ibbonubfz7carwiefibzgga", "get": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga", "cancel": "https://api.replicate.com/v1/trainings/zz4ibbonubfz7carwiefibzgga/cancel" }, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", } ] } ``` `id` will be the unique ID of the training. `source` will indicate how the training was created. Possible values are `web` or `api`. `status` will be the status of the training. Refer to [get a single training](#trainings.get) for possible values. `urls` will be a convenience object that can be used to construct new API requests for the given training. `version` will be the unique ID of model version used to create the training.',
            'ph:graduation-cap',
        ],
        'replicate_search' => [
            'ReplicateSearch',
            'read',
            'Search models, collections, and docs (beta)',
            'Search for public models, collections, and docs using a text query. For models, the response includes all model data, plus a new `metadata` object with the following fields: - `generated_description`: A longer and more detailed AI-generated description of the model - `tags`: An array of tags for the model - `score`: A score for the model\'s relevance to the search query Example cURL request: ```console curl -s \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ "https://api.replicate.com/v1/search?query=nano+banana" ``` Note: This search API is currently in beta and may change in future versions.',
            'ph:brain',
        ],
        'replicate_search_models' => [
            'ReplicateSearchModels',
            'read',
            'Search public models',
            'Get a list of public models matching a search query. Example cURL request: ```console curl -s -X QUERY \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H "Content-Type: text/plain" \\ -d "hello" \\ https://api.replicate.com/v1/models ``` The response will be a paginated JSON object containing an array of model objects. See the [`models.get`](#models.get) docs for more details about the model object.',
            'ph:cube',
        ],
        'replicate_update_deployment' => [
            'ReplicateUpdateDeployment',
            'write',
            'Update a deployment',
            'Update properties of an existing deployment, including hardware, min/max instances, and the deployment\'s underlying model [version](https://replicate.com/docs/how-does-replicate-work#versions). Example cURL request: ```console curl -s \\ -X PATCH \\ -H "Authorization: Bearer $REPLICATE_API_TOKEN" \\ -H "Content-Type: application/json" \\ -d \'{"min_instances": 3, "max_instances": 10}\' \\ https://api.replicate.com/v1/deployments/acme/my-app-image-generator ``` The response will be a JSON object describing the deployment: ```json { "owner": "acme", "name": "my-app-image-generator", "current_release": { "number": 2, "model": "stability-ai/sdxl", "version": "da77bc59ee60423279fd632efb4795ab731d9e3ca9705ef3341091fb989b7eaf", "created_at": "2024-02-15T16:32:57.018467Z", "created_by": { "type": "organization", "username": "acme", "name": "Acme Corp, Inc.", "avatar_url": "https://cdn.replicate.com/avatars/acme.png", "github_url": "https://github.com/acme" }, "configuration": { "hardware": "gpu-t4", "min_instances": 3, "max_instances": 10 } } } ``` Updating any deployment properties will increment the `number` field of the `current_release`.',
            'ph:rocket-launch',
        ],
        'replicate_update_model' => [
            'ReplicateUpdateModel',
            'write',
            'Update metadata for a model',
            'Update select properties of an existing model. You can update the following properties: - `description` - Model description - `readme` - Model README content - `github_url` - GitHub repository URL - `paper_url` - Research paper URL - `weights_url` - Model weights URL - `license_url` - License URL Example cURL request: ```console curl -X PATCH \\ https://api.replicate.com/v1/models/your-username/your-model-name \\ -H "Authorization: Token $REPLICATE_API_TOKEN" \\ -H "Content-Type: application/json" \\ -d \'{ "description": "Detect hot dogs in images", "readme": "# Hot Dog Detector\\n\\n Ketchup, mustard, and onions...", "github_url": "https://github.com/alice/hot-dog-detector", "paper_url": "https://arxiv.org/abs/2504.17639", "weights_url": "https://huggingface.co/alice/hot-dog-detector", "license_url": "https://choosealicense.com/licenses/mit/" }\' ``` The response will be the updated model object with all of its properties.',
            'ph:cube',
        ],
    ];

    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Replicate HTTP API requests use Authorization: Bearer with a Replicate API token.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'replicate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Replicate',
            'description' => 'AI model hosting and predictions',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:replicate',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Replicate',
            'description' => 'Run and manage models, predictions, deployments, files, trainings, and webhooks through the Replicate HTTP API.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:replicate',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://replicate.com/docs/reference/http',
            'source_url' => 'https://api.replicate.com/openapi.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Replicate API token',
                'hint' => 'Find your API token at replicate.com/account/api-tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.replicate.com/v1',
                'hint' => 'Defaults to https://api.replicate.com/v1. Change only for compatible endpoints.',
                'default' => 'https://api.replicate.com/v1',
            ],
        ];
    }

    /**
     * Test the connection using the authenticated account endpoint.
     *
     * @param  array<string, mixed>  $config  Candidate credential values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.replicate.com/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders(['Accept' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Replicate API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['detail'] ?? $json['error'] ?? 'Unknown error';

                return ['success' => false, 'error' => "API error: {$error}"];
            }

            $name = $json['username'] ?? $json['email'] ?? 'Replicate';

            return [
                'success' => true,
                'message' => "Connected to Replicate as {$name}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (ReplicateOperations::all() as $toolName => $operation) {
            $tools[$toolName] = [
                'class' => $operation['class'],
                'type' => in_array($operation['method'], ['GET', 'QUERY'], true) ? 'read' : 'write',
                'name' => $operation['summary'],
                'description' => $operation['description'] ?: $operation['summary'],
                'icon' => $this->iconFor((string) $operation['operation_id']),
            ];
        }

        return $tools;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/replicate.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.replicate.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): ReplicateService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ReplicateService(
                apiKey: $creds->get('replicate', 'api_key', '', $account),
                baseUrl: $creds->get('replicate', 'url', 'https://api.replicate.com/v1', $account),
            );
        }

        return app(ReplicateService::class);
    }

    private function iconFor(string $operationId): string
    {
        return match (true) {
            str_contains($operationId, 'prediction') => 'ph:play',
            str_contains($operationId, 'deployment') => 'ph:rocket-launch',
            str_contains($operationId, 'model') => 'ph:cube',
            str_contains($operationId, 'file') => 'ph:file',
            str_contains($operationId, 'training') => 'ph:graduation-cap',
            str_contains($operationId, 'webhook') => 'ph:webhooks-logo',
            default => 'ph:brain',
        };
    }
}
