# Google Vertex AI - Lua API Reference

Google Vertex AI tools are exposed under `app.integrations.google_vertex_ai`. This package is generated from Google's official AI Platform v1 Discovery document and exposes 1003 REST methods.

Configure `access_token` with a Google OAuth token that has Vertex AI or cloud-platform scopes. The default base URL is `https://aiplatform.googleapis.com`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `projects/example/locations/us-central1/models/model-id`.

## Examples

```lua
local models = app.integrations.google_vertex_ai.google_vertex_ai_projects_locations_models_list({
  parent = "projects/example-project/locations/us-central1",
  pageSize = 20
})

local prediction = app.integrations.google_vertex_ai.google_vertex_ai_projects_locations_endpoints_predict({
  endpoint = "projects/example-project/locations/us-central1/endpoints/123",
  body = { instances = { { text = "hello" } } }
})

local generated = app.integrations.google_vertex_ai.google_vertex_ai_projects_locations_publishers_models_generate_content({
  model = "projects/example-project/locations/us-central1/publishers/google/models/gemini-1.5-pro",
  body = { contents = { { role = "user", parts = { { text = "hello" } } } } }
})
```

## Multi-Account Usage

```lua
app.integrations.google_vertex_ai.google_vertex_ai_projects_locations_models_list({ parent = "projects/example/locations/us-central1" })
app.integrations.google_vertex_ai.default.google_vertex_ai_projects_locations_models_list({ parent = "projects/example/locations/us-central1" })
app.integrations.google_vertex_ai.production.google_vertex_ai_projects_locations_models_list({ parent = "projects/example/locations/us-central1" })
```

## Annotations

- `google_vertex_ai_datasets_data_items_annotations_operations_get` - GET /v1/{+name} - Datasets Data Items Annotations Operations Get
- `google_vertex_ai_datasets_data_items_annotations_operations_delete` - DELETE /v1/{+name} - Datasets Data Items Annotations Operations Delete
- `google_vertex_ai_datasets_data_items_annotations_operations_list` - GET /v1/{+name}/operations - Datasets Data Items Annotations Operations List
- `google_vertex_ai_datasets_data_items_annotations_operations_cancel` - POST /v1/{+name}:cancel - Datasets Data Items Annotations Operations Cancel
- `google_vertex_ai_datasets_data_items_annotations_operations_wait` - POST /v1/{+name}:wait - Datasets Data Items Annotations Operations Wait

## Ask Contexts

- `google_vertex_ai_projects_locations_ask_contexts` - POST /v1/{+parent}:askContexts - Projects Locations Ask Contexts

## Async Query

- `google_vertex_ai_reasoning_engines_async_query` - POST /v1/{+name}:asyncQuery - Reasoning Engines Async Query

## Async Retrieve Contexts

- `google_vertex_ai_projects_locations_async_retrieve_contexts` - POST /v1/{+parent}:asyncRetrieveContexts - Projects Locations Async Retrieve Contexts

## Augment Prompt

- `google_vertex_ai_projects_locations_augment_prompt` - POST /v1/{+parent}:augmentPrompt - Projects Locations Augment Prompt

## Batch Prediction Jobs

- `google_vertex_ai_projects_locations_batch_prediction_jobs_delete` - DELETE /v1/{+name} - Projects Locations Batch Prediction Jobs Delete
- `google_vertex_ai_projects_locations_batch_prediction_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Batch Prediction Jobs Cancel
- `google_vertex_ai_projects_locations_batch_prediction_jobs_create` - POST /v1/{+parent}/batchPredictionJobs - Projects Locations Batch Prediction Jobs Create
- `google_vertex_ai_projects_locations_batch_prediction_jobs_list` - GET /v1/{+parent}/batchPredictionJobs - Projects Locations Batch Prediction Jobs List
- `google_vertex_ai_projects_locations_batch_prediction_jobs_get` - GET /v1/{+name} - Projects Locations Batch Prediction Jobs Get

## Cached Contents

- `google_vertex_ai_projects_locations_cached_contents_get` - GET /v1/{+name} - Projects Locations Cached Contents Get
- `google_vertex_ai_projects_locations_cached_contents_create` - POST /v1/{+parent}/cachedContents - Projects Locations Cached Contents Create
- `google_vertex_ai_projects_locations_cached_contents_patch` - PATCH /v1/{+name} - Projects Locations Cached Contents Patch
- `google_vertex_ai_projects_locations_cached_contents_list` - GET /v1/{+parent}/cachedContents - Projects Locations Cached Contents List
- `google_vertex_ai_projects_locations_cached_contents_delete` - DELETE /v1/{+name} - Projects Locations Cached Contents Delete

## Cancel

- `google_vertex_ai_reasoning_engines_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Operations Cancel
- `google_vertex_ai_schedules_operations_cancel` - POST /v1/{+name}:cancel - Schedules Operations Cancel
- `google_vertex_ai_custom_jobs_operations_cancel` - POST /v1/{+name}:cancel - Custom Jobs Operations Cancel
- `google_vertex_ai_studies_operations_cancel` - POST /v1/{+name}:cancel - Studies Operations Cancel
- `google_vertex_ai_data_labeling_jobs_operations_cancel` - POST /v1/{+name}:cancel - Data Labeling Jobs Operations Cancel
- `google_vertex_ai_tuning_jobs_operations_cancel` - POST /v1/{+name}:cancel - Tuning Jobs Operations Cancel
- `google_vertex_ai_migratable_resources_operations_cancel` - POST /v1/{+name}:cancel - Migratable Resources Operations Cancel
- `google_vertex_ai_notebook_runtimes_operations_cancel` - POST /v1/{+name}:cancel - Notebook Runtimes Operations Cancel
- `google_vertex_ai_model_deployment_monitoring_jobs_operations_cancel` - POST /v1/{+name}:cancel - Model Deployment Monitoring Jobs Operations Cancel
- `google_vertex_ai_operations_cancel` - POST /v1/{+name}:cancel - Operations Cancel
- `google_vertex_ai_models_operations_cancel` - POST /v1/{+name}:cancel - Models Operations Cancel
- `google_vertex_ai_notebook_runtime_templates_operations_cancel` - POST /v1/{+name}:cancel - Notebook Runtime Templates Operations Cancel
- `google_vertex_ai_deployment_resource_pools_operations_cancel` - POST /v1/{+name}:cancel - Deployment Resource Pools Operations Cancel
- `google_vertex_ai_specialist_pools_operations_cancel` - POST /v1/{+name}:cancel - Specialist Pools Operations Cancel
- `google_vertex_ai_persistent_resources_operations_cancel` - POST /v1/{+name}:cancel - Persistent Resources Operations Cancel
- `google_vertex_ai_index_endpoints_operations_cancel` - POST /v1/{+name}:cancel - Index Endpoints Operations Cancel
- `google_vertex_ai_hyperparameter_tuning_jobs_operations_cancel` - POST /v1/{+name}:cancel - Hyperparameter Tuning Jobs Operations Cancel
- `google_vertex_ai_indexes_operations_cancel` - POST /v1/{+name}:cancel - Indexes Operations Cancel
- `google_vertex_ai_training_pipelines_operations_cancel` - POST /v1/{+name}:cancel - Training Pipelines Operations Cancel
- `google_vertex_ai_skills_operations_cancel` - POST /v1/{+name}:cancel - Skills Operations Cancel
- `google_vertex_ai_endpoints_operations_cancel` - POST /v1/{+name}:cancel - Endpoints Operations Cancel
- `google_vertex_ai_pipeline_jobs_operations_cancel` - POST /v1/{+name}:cancel - Pipeline Jobs Operations Cancel
- `google_vertex_ai_rag_corpora_operations_cancel` - POST /v1/{+name}:cancel - Rag Corpora Operations Cancel
- `google_vertex_ai_tensorboards_operations_cancel` - POST /v1/{+name}:cancel - Tensorboards Operations Cancel
- `google_vertex_ai_notebook_execution_jobs_operations_cancel` - POST /v1/{+name}:cancel - Notebook Execution Jobs Operations Cancel
- `google_vertex_ai_rag_engine_config_operations_cancel` - POST /v1/{+name}:cancel - Rag Engine Config Operations Cancel
- `google_vertex_ai_datasets_operations_cancel` - POST /v1/{+name}:cancel - Datasets Operations Cancel
- `google_vertex_ai_featurestores_operations_cancel` - POST /v1/{+name}:cancel - Featurestores Operations Cancel
- `google_vertex_ai_metadata_stores_operations_cancel` - POST /v1/{+name}:cancel - Metadata Stores Operations Cancel

## Completions

- `google_vertex_ai_endpoints_chat_completions` - POST /v1/{+endpoint}/chat/completions - Endpoints Chat Completions

## Compute Tokens

- `google_vertex_ai_endpoints_compute_tokens` - POST /v1/{+endpoint}:computeTokens - Endpoints Compute Tokens
- `google_vertex_ai_publishers_models_compute_tokens` - POST /v1/{+endpoint}:computeTokens - Publishers Models Compute Tokens

## Corroborate Content

- `google_vertex_ai_projects_locations_corroborate_content` - POST /v1/{+parent}:corroborateContent - Projects Locations Corroborate Content

## Count Tokens

- `google_vertex_ai_endpoints_count_tokens` - POST /v1/{+endpoint}:countTokens - Endpoints Count Tokens
- `google_vertex_ai_publishers_models_count_tokens` - POST /v1/{+endpoint}:countTokens - Publishers Models Count Tokens

## Create

- `google_vertex_ai_reasoning_engines_create` - POST /v1/reasoningEngines - Reasoning Engines Create
- `google_vertex_ai_reasoning_engines_sandbox_environments_create` - POST /v1/{+parent}/sandboxEnvironments - Reasoning Engines Sandbox Environments Create
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_create` - POST /v1/{+parent}/sandboxEnvironmentTemplates - Reasoning Engines Sandbox Environment Templates Create
- `google_vertex_ai_datasets_create` - POST /v1/datasets - Datasets Create
- `google_vertex_ai_datasets_dataset_versions_create` - POST /v1/{+parent}/datasetVersions - Datasets Dataset Versions Create
- `google_vertex_ai_batch_prediction_jobs_create` - POST /v1/batchPredictionJobs - Batch Prediction Jobs Create

## Custom Jobs

- `google_vertex_ai_projects_locations_custom_jobs_get` - GET /v1/{+name} - Projects Locations Custom Jobs Get
- `google_vertex_ai_projects_locations_custom_jobs_create` - POST /v1/{+parent}/customJobs - Projects Locations Custom Jobs Create
- `google_vertex_ai_projects_locations_custom_jobs_list` - GET /v1/{+parent}/customJobs - Projects Locations Custom Jobs List
- `google_vertex_ai_projects_locations_custom_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Custom Jobs Cancel
- `google_vertex_ai_projects_locations_custom_jobs_delete` - DELETE /v1/{+name} - Projects Locations Custom Jobs Delete
- `google_vertex_ai_projects_locations_custom_jobs_operations_get` - GET /v1/{+name} - Projects Locations Custom Jobs Operations Get
- `google_vertex_ai_projects_locations_custom_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Custom Jobs Operations Cancel
- `google_vertex_ai_projects_locations_custom_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Custom Jobs Operations Wait
- `google_vertex_ai_projects_locations_custom_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Custom Jobs Operations List
- `google_vertex_ai_projects_locations_custom_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Custom Jobs Operations Delete

## Data Labeling Jobs

- `google_vertex_ai_projects_locations_data_labeling_jobs_delete` - DELETE /v1/{+name} - Projects Locations Data Labeling Jobs Delete
- `google_vertex_ai_projects_locations_data_labeling_jobs_create` - POST /v1/{+parent}/dataLabelingJobs - Projects Locations Data Labeling Jobs Create
- `google_vertex_ai_projects_locations_data_labeling_jobs_list` - GET /v1/{+parent}/dataLabelingJobs - Projects Locations Data Labeling Jobs List
- `google_vertex_ai_projects_locations_data_labeling_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Data Labeling Jobs Cancel
- `google_vertex_ai_projects_locations_data_labeling_jobs_get` - GET /v1/{+name} - Projects Locations Data Labeling Jobs Get
- `google_vertex_ai_projects_locations_data_labeling_jobs_operations_get` - GET /v1/{+name} - Projects Locations Data Labeling Jobs Operations Get
- `google_vertex_ai_projects_locations_data_labeling_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Data Labeling Jobs Operations Delete
- `google_vertex_ai_projects_locations_data_labeling_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Data Labeling Jobs Operations List
- `google_vertex_ai_projects_locations_data_labeling_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Data Labeling Jobs Operations Cancel
- `google_vertex_ai_projects_locations_data_labeling_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Data Labeling Jobs Operations Wait

## Datasets

- `google_vertex_ai_projects_locations_datasets_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Datasets Set Iam Policy
- `google_vertex_ai_projects_locations_datasets_create` - POST /v1/{+parent}/datasets - Projects Locations Datasets Create
- `google_vertex_ai_projects_locations_datasets_get` - GET /v1/{+name} - Projects Locations Datasets Get
- `google_vertex_ai_projects_locations_datasets_import` - POST /v1/{+name}:import - Projects Locations Datasets Import
- `google_vertex_ai_projects_locations_datasets_delete` - DELETE /v1/{+name} - Projects Locations Datasets Delete
- `google_vertex_ai_projects_locations_datasets_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Datasets Test Iam Permissions
- `google_vertex_ai_projects_locations_datasets_export` - POST /v1/{+name}:export - Projects Locations Datasets Export
- `google_vertex_ai_projects_locations_datasets_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Datasets Get Iam Policy
- `google_vertex_ai_projects_locations_datasets_patch` - PATCH /v1/{+name} - Projects Locations Datasets Patch
- `google_vertex_ai_projects_locations_datasets_list` - GET /v1/{+parent}/datasets - Projects Locations Datasets List
- `google_vertex_ai_projects_locations_datasets_search_data_items` - GET /v1/{+dataset}:searchDataItems - Projects Locations Datasets Search Data Items
- `google_vertex_ai_projects_locations_datasets_data_items_list` - GET /v1/{+parent}/dataItems - Projects Locations Datasets Data Items List
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_list` - GET /v1/{+parent}/annotations - Projects Locations Datasets Data Items Annotations List
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_operations_get` - GET /v1/{+name} - Projects Locations Datasets Data Items Annotations Operations Get
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_operations_list` - GET /v1/{+name}/operations - Projects Locations Datasets Data Items Annotations Operations List
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Datasets Data Items Annotations Operations Cancel
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_operations_wait` - POST /v1/{+name}:wait - Projects Locations Datasets Data Items Annotations Operations Wait
- `google_vertex_ai_projects_locations_datasets_data_items_annotations_operations_delete` - DELETE /v1/{+name} - Projects Locations Datasets Data Items Annotations Operations Delete
- `google_vertex_ai_projects_locations_datasets_data_items_operations_get` - GET /v1/{+name} - Projects Locations Datasets Data Items Operations Get
- `google_vertex_ai_projects_locations_datasets_data_items_operations_delete` - DELETE /v1/{+name} - Projects Locations Datasets Data Items Operations Delete
- `google_vertex_ai_projects_locations_datasets_data_items_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Datasets Data Items Operations Cancel
- `google_vertex_ai_projects_locations_datasets_data_items_operations_wait` - POST /v1/{+name}:wait - Projects Locations Datasets Data Items Operations Wait
- `google_vertex_ai_projects_locations_datasets_data_items_operations_list` - GET /v1/{+name}/operations - Projects Locations Datasets Data Items Operations List
- `google_vertex_ai_projects_locations_datasets_annotation_specs_get` - GET /v1/{+name} - Projects Locations Datasets Annotation Specs Get
- `google_vertex_ai_projects_locations_datasets_annotation_specs_operations_delete` - DELETE /v1/{+name} - Projects Locations Datasets Annotation Specs Operations Delete
- `google_vertex_ai_projects_locations_datasets_annotation_specs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Datasets Annotation Specs Operations Cancel
- `google_vertex_ai_projects_locations_datasets_annotation_specs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Datasets Annotation Specs Operations Wait
- `google_vertex_ai_projects_locations_datasets_annotation_specs_operations_list` - GET /v1/{+name}/operations - Projects Locations Datasets Annotation Specs Operations List
- `google_vertex_ai_projects_locations_datasets_annotation_specs_operations_get` - GET /v1/{+name} - Projects Locations Datasets Annotation Specs Operations Get
- `google_vertex_ai_projects_locations_datasets_dataset_versions_get` - GET /v1/{+name} - Projects Locations Datasets Dataset Versions Get
- `google_vertex_ai_projects_locations_datasets_dataset_versions_create` - POST /v1/{+parent}/datasetVersions - Projects Locations Datasets Dataset Versions Create
- `google_vertex_ai_projects_locations_datasets_dataset_versions_patch` - PATCH /v1/{+name} - Projects Locations Datasets Dataset Versions Patch
- `google_vertex_ai_projects_locations_datasets_dataset_versions_list` - GET /v1/{+parent}/datasetVersions - Projects Locations Datasets Dataset Versions List
- `google_vertex_ai_projects_locations_datasets_dataset_versions_delete` - DELETE /v1/{+name} - Projects Locations Datasets Dataset Versions Delete
- `google_vertex_ai_projects_locations_datasets_dataset_versions_restore` - GET /v1/{+name}:restore - Projects Locations Datasets Dataset Versions Restore
- `google_vertex_ai_projects_locations_datasets_operations_get` - GET /v1/{+name} - Projects Locations Datasets Operations Get
- `google_vertex_ai_projects_locations_datasets_operations_delete` - DELETE /v1/{+name} - Projects Locations Datasets Operations Delete
- `google_vertex_ai_projects_locations_datasets_operations_list` - GET /v1/{+name}/operations - Projects Locations Datasets Operations List
- `google_vertex_ai_projects_locations_datasets_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Datasets Operations Cancel
- `google_vertex_ai_projects_locations_datasets_operations_wait` - POST /v1/{+name}:wait - Projects Locations Datasets Operations Wait
- `google_vertex_ai_projects_locations_datasets_saved_queries_list` - GET /v1/{+parent}/savedQueries - Projects Locations Datasets Saved Queries List
- `google_vertex_ai_projects_locations_datasets_saved_queries_delete` - DELETE /v1/{+name} - Projects Locations Datasets Saved Queries Delete
- `google_vertex_ai_projects_locations_datasets_saved_queries_operations_delete` - DELETE /v1/{+name} - Projects Locations Datasets Saved Queries Operations Delete
- `google_vertex_ai_projects_locations_datasets_saved_queries_operations_list` - GET /v1/{+name}/operations - Projects Locations Datasets Saved Queries Operations List
- `google_vertex_ai_projects_locations_datasets_saved_queries_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Datasets Saved Queries Operations Cancel
- `google_vertex_ai_projects_locations_datasets_saved_queries_operations_wait` - POST /v1/{+name}:wait - Projects Locations Datasets Saved Queries Operations Wait
- `google_vertex_ai_projects_locations_datasets_saved_queries_operations_get` - GET /v1/{+name} - Projects Locations Datasets Saved Queries Operations Get

## Delete

- `google_vertex_ai_reasoning_engines_delete` - DELETE /v1/{+name} - Reasoning Engines Delete
- `google_vertex_ai_reasoning_engines_sandbox_environments_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environments Delete
- `google_vertex_ai_reasoning_engines_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Operations Delete
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environment Snapshots Delete
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environment Templates Delete
- `google_vertex_ai_schedules_operations_delete` - DELETE /v1/{+name} - Schedules Operations Delete
- `google_vertex_ai_custom_jobs_operations_delete` - DELETE /v1/{+name} - Custom Jobs Operations Delete
- `google_vertex_ai_studies_operations_delete` - DELETE /v1/{+name} - Studies Operations Delete
- `google_vertex_ai_data_labeling_jobs_operations_delete` - DELETE /v1/{+name} - Data Labeling Jobs Operations Delete
- `google_vertex_ai_tuning_jobs_operations_delete` - DELETE /v1/{+name} - Tuning Jobs Operations Delete
- `google_vertex_ai_migratable_resources_operations_delete` - DELETE /v1/{+name} - Migratable Resources Operations Delete
- `google_vertex_ai_notebook_runtimes_operations_delete` - DELETE /v1/{+name} - Notebook Runtimes Operations Delete
- `google_vertex_ai_model_deployment_monitoring_jobs_operations_delete` - DELETE /v1/{+name} - Model Deployment Monitoring Jobs Operations Delete
- `google_vertex_ai_operations_delete` - DELETE /v1/{+name} - Operations Delete
- `google_vertex_ai_models_operations_delete` - DELETE /v1/{+name} - Models Operations Delete
- `google_vertex_ai_notebook_runtime_templates_operations_delete` - DELETE /v1/{+name} - Notebook Runtime Templates Operations Delete
- `google_vertex_ai_feature_groups_operations_delete` - DELETE /v1/{+name} - Feature Groups Operations Delete
- `google_vertex_ai_deployment_resource_pools_operations_delete` - DELETE /v1/{+name} - Deployment Resource Pools Operations Delete
- `google_vertex_ai_specialist_pools_operations_delete` - DELETE /v1/{+name} - Specialist Pools Operations Delete
- `google_vertex_ai_persistent_resources_operations_delete` - DELETE /v1/{+name} - Persistent Resources Operations Delete
- `google_vertex_ai_index_endpoints_operations_delete` - DELETE /v1/{+name} - Index Endpoints Operations Delete
- `google_vertex_ai_hyperparameter_tuning_jobs_operations_delete` - DELETE /v1/{+name} - Hyperparameter Tuning Jobs Operations Delete
- `google_vertex_ai_indexes_operations_delete` - DELETE /v1/{+name} - Indexes Operations Delete
- `google_vertex_ai_training_pipelines_operations_delete` - DELETE /v1/{+name} - Training Pipelines Operations Delete
- `google_vertex_ai_skills_operations_delete` - DELETE /v1/{+name} - Skills Operations Delete
- `google_vertex_ai_endpoints_operations_delete` - DELETE /v1/{+name} - Endpoints Operations Delete
- `google_vertex_ai_pipeline_jobs_operations_delete` - DELETE /v1/{+name} - Pipeline Jobs Operations Delete
- `google_vertex_ai_rag_corpora_operations_delete` - DELETE /v1/{+name} - Rag Corpora Operations Delete
- `google_vertex_ai_tensorboards_operations_delete` - DELETE /v1/{+name} - Tensorboards Operations Delete
- `google_vertex_ai_notebook_execution_jobs_operations_delete` - DELETE /v1/{+name} - Notebook Execution Jobs Operations Delete
- `google_vertex_ai_rag_engine_config_operations_delete` - DELETE /v1/{+name} - Rag Engine Config Operations Delete
- `google_vertex_ai_feature_online_stores_operations_delete` - DELETE /v1/{+name} - Feature Online Stores Operations Delete
- `google_vertex_ai_datasets_delete` - DELETE /v1/{+name} - Datasets Delete
- `google_vertex_ai_datasets_operations_delete` - DELETE /v1/{+name} - Datasets Operations Delete
- `google_vertex_ai_datasets_dataset_versions_delete` - DELETE /v1/{+name} - Datasets Dataset Versions Delete
- `google_vertex_ai_featurestores_operations_delete` - DELETE /v1/{+name} - Featurestores Operations Delete
- `google_vertex_ai_metadata_stores_operations_delete` - DELETE /v1/{+name} - Metadata Stores Operations Delete

## Deploy

- `google_vertex_ai_projects_locations_deploy` - POST /v1/{+destination}:deploy - Projects Locations Deploy

## Deployment Resource Pools

- `google_vertex_ai_projects_locations_deployment_resource_pools_delete` - DELETE /v1/{+name} - Projects Locations Deployment Resource Pools Delete
- `google_vertex_ai_projects_locations_deployment_resource_pools_create` - POST /v1/{+parent}/deploymentResourcePools - Projects Locations Deployment Resource Pools Create
- `google_vertex_ai_projects_locations_deployment_resource_pools_list` - GET /v1/{+parent}/deploymentResourcePools - Projects Locations Deployment Resource Pools List
- `google_vertex_ai_projects_locations_deployment_resource_pools_patch` - PATCH /v1/{+name} - Projects Locations Deployment Resource Pools Patch
- `google_vertex_ai_projects_locations_deployment_resource_pools_get` - GET /v1/{+name} - Projects Locations Deployment Resource Pools Get
- `google_vertex_ai_projects_locations_deployment_resource_pools_query_deployed_models` - GET /v1/{+deploymentResourcePool}:queryDeployedModels - Projects Locations Deployment Resource Pools Query Deployed Models
- `google_vertex_ai_projects_locations_deployment_resource_pools_operations_delete` - DELETE /v1/{+name} - Projects Locations Deployment Resource Pools Operations Delete
- `google_vertex_ai_projects_locations_deployment_resource_pools_operations_list` - GET /v1/{+name}/operations - Projects Locations Deployment Resource Pools Operations List
- `google_vertex_ai_projects_locations_deployment_resource_pools_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Deployment Resource Pools Operations Cancel
- `google_vertex_ai_projects_locations_deployment_resource_pools_operations_wait` - POST /v1/{+name}:wait - Projects Locations Deployment Resource Pools Operations Wait
- `google_vertex_ai_projects_locations_deployment_resource_pools_operations_get` - GET /v1/{+name} - Projects Locations Deployment Resource Pools Operations Get

## Endpoints

- `google_vertex_ai_projects_locations_endpoints_direct_raw_predict` - POST /v1/{+endpoint}:directRawPredict - Projects Locations Endpoints Direct Raw Predict
- `google_vertex_ai_projects_locations_endpoints_stream_generate_content` - POST /v1/{+model}:streamGenerateContent - Projects Locations Endpoints Stream Generate Content
- `google_vertex_ai_projects_locations_endpoints_raw_predict` - POST /v1/{+endpoint}:rawPredict - Projects Locations Endpoints Raw Predict
- `google_vertex_ai_projects_locations_endpoints_generate_content` - POST /v1/{+model}:generateContent - Projects Locations Endpoints Generate Content
- `google_vertex_ai_projects_locations_endpoints_deploy_model` - POST /v1/{+endpoint}:deployModel - Projects Locations Endpoints Deploy Model
- `google_vertex_ai_projects_locations_endpoints_list` - GET /v1/{+parent}/endpoints - Projects Locations Endpoints List
- `google_vertex_ai_projects_locations_endpoints_compute_tokens` - POST /v1/{+endpoint}:computeTokens - Projects Locations Endpoints Compute Tokens
- `google_vertex_ai_projects_locations_endpoints_server_streaming_predict` - POST /v1/{+endpoint}:serverStreamingPredict - Projects Locations Endpoints Server Streaming Predict
- `google_vertex_ai_projects_locations_endpoints_undeploy_model` - POST /v1/{+endpoint}:undeployModel - Projects Locations Endpoints Undeploy Model
- `google_vertex_ai_projects_locations_endpoints_predict` - POST /v1/{+endpoint}:predict - Projects Locations Endpoints Predict
- `google_vertex_ai_projects_locations_endpoints_direct_predict` - POST /v1/{+endpoint}:directPredict - Projects Locations Endpoints Direct Predict
- `google_vertex_ai_projects_locations_endpoints_create` - POST /v1/{+parent}/endpoints - Projects Locations Endpoints Create
- `google_vertex_ai_projects_locations_endpoints_update` - POST /v1/{+name}:update - Projects Locations Endpoints Update
- `google_vertex_ai_projects_locations_endpoints_mutate_deployed_model` - POST /v1/{+endpoint}:mutateDeployedModel - Projects Locations Endpoints Mutate Deployed Model
- `google_vertex_ai_projects_locations_endpoints_delete` - DELETE /v1/{+name} - Projects Locations Endpoints Delete
- `google_vertex_ai_projects_locations_endpoints_count_tokens` - POST /v1/{+endpoint}:countTokens - Projects Locations Endpoints Count Tokens
- `google_vertex_ai_projects_locations_endpoints_patch` - PATCH /v1/{+name} - Projects Locations Endpoints Patch
- `google_vertex_ai_projects_locations_endpoints_fetch_predict_operation` - POST /v1/{+endpoint}:fetchPredictOperation - Projects Locations Endpoints Fetch Predict Operation
- `google_vertex_ai_projects_locations_endpoints_get` - GET /v1/{+name} - Projects Locations Endpoints Get
- `google_vertex_ai_projects_locations_endpoints_predict_long_running` - POST /v1/{+endpoint}:predictLongRunning - Projects Locations Endpoints Predict Long Running
- `google_vertex_ai_projects_locations_endpoints_stream_raw_predict` - POST /v1/{+endpoint}:streamRawPredict - Projects Locations Endpoints Stream Raw Predict
- `google_vertex_ai_projects_locations_endpoints_explain` - POST /v1/{+endpoint}:explain - Projects Locations Endpoints Explain
- `google_vertex_ai_projects_locations_endpoints_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Endpoints Operations Cancel
- `google_vertex_ai_projects_locations_endpoints_operations_wait` - POST /v1/{+name}:wait - Projects Locations Endpoints Operations Wait
- `google_vertex_ai_projects_locations_endpoints_operations_list` - GET /v1/{+name}/operations - Projects Locations Endpoints Operations List
- `google_vertex_ai_projects_locations_endpoints_operations_delete` - DELETE /v1/{+name} - Projects Locations Endpoints Operations Delete
- `google_vertex_ai_projects_locations_endpoints_operations_get` - GET /v1/{+name} - Projects Locations Endpoints Operations Get
- `google_vertex_ai_projects_locations_endpoints_invoke_invoke` - POST /v1/{+endpoint}/invoke/{+invokeId} - Projects Locations Endpoints Invoke Invoke
- `google_vertex_ai_projects_locations_endpoints_openapi_responses` - POST /v1/{+endpoint}/responses - Projects Locations Endpoints Openapi Responses
- `google_vertex_ai_projects_locations_endpoints_openapi_completions` - POST /v1/{+endpoint}/completions - Projects Locations Endpoints Openapi Completions
- `google_vertex_ai_projects_locations_endpoints_openapi_embeddings` - POST /v1/{+endpoint}/embeddings - Projects Locations Endpoints Openapi Embeddings
- `google_vertex_ai_projects_locations_endpoints_chat_completions` - POST /v1/{+endpoint}/chat/completions - Projects Locations Endpoints Chat Completions
- `google_vertex_ai_projects_locations_endpoints_deployed_models_invoke_invoke` - POST /v1/{+endpoint}/deployedModels/{deployedModelId}/invoke/{+invokeId} - Projects Locations Endpoints Deployed Models Invoke Invoke
- `google_vertex_ai_projects_locations_endpoints_google_science_inference` - POST /v1/{+endpoint}/science/inference - Projects Locations Endpoints Google Science Inference

## Evaluate Dataset

- `google_vertex_ai_v1_evaluate_dataset` - POST /v1:evaluateDataset - V1 Evaluate Dataset
- `google_vertex_ai_projects_locations_evaluate_dataset` - POST /v1/{+location}:evaluateDataset - Projects Locations Evaluate Dataset

## Evaluate Instances

- `google_vertex_ai_v1_evaluate_instances` - POST /v1:evaluateInstances - V1 Evaluate Instances
- `google_vertex_ai_projects_locations_evaluate_instances` - POST /v1/{+location}:evaluateInstances - Projects Locations Evaluate Instances

## Evaluation Items

- `google_vertex_ai_projects_locations_evaluation_items_create` - POST /v1/{+parent}/evaluationItems - Projects Locations Evaluation Items Create
- `google_vertex_ai_projects_locations_evaluation_items_list` - GET /v1/{+parent}/evaluationItems - Projects Locations Evaluation Items List
- `google_vertex_ai_projects_locations_evaluation_items_delete` - DELETE /v1/{+name} - Projects Locations Evaluation Items Delete
- `google_vertex_ai_projects_locations_evaluation_items_get` - GET /v1/{+name} - Projects Locations Evaluation Items Get

## Evaluation Runs

- `google_vertex_ai_projects_locations_evaluation_runs_create` - POST /v1/{+parent}/evaluationRuns - Projects Locations Evaluation Runs Create
- `google_vertex_ai_projects_locations_evaluation_runs_list` - GET /v1/{+parent}/evaluationRuns - Projects Locations Evaluation Runs List
- `google_vertex_ai_projects_locations_evaluation_runs_cancel` - POST /v1/{+name}:cancel - Projects Locations Evaluation Runs Cancel
- `google_vertex_ai_projects_locations_evaluation_runs_delete` - DELETE /v1/{+name} - Projects Locations Evaluation Runs Delete
- `google_vertex_ai_projects_locations_evaluation_runs_get` - GET /v1/{+name} - Projects Locations Evaluation Runs Get

## Evaluation Sets

- `google_vertex_ai_projects_locations_evaluation_sets_delete` - DELETE /v1/{+name} - Projects Locations Evaluation Sets Delete
- `google_vertex_ai_projects_locations_evaluation_sets_create` - POST /v1/{+parent}/evaluationSets - Projects Locations Evaluation Sets Create
- `google_vertex_ai_projects_locations_evaluation_sets_list` - GET /v1/{+parent}/evaluationSets - Projects Locations Evaluation Sets List
- `google_vertex_ai_projects_locations_evaluation_sets_patch` - PATCH /v1/{+name} - Projects Locations Evaluation Sets Patch
- `google_vertex_ai_projects_locations_evaluation_sets_get` - GET /v1/{+name} - Projects Locations Evaluation Sets Get

## Execute

- `google_vertex_ai_reasoning_engines_sandbox_environments_execute` - POST /v1/{+name}:execute - Reasoning Engines Sandbox Environments Execute

## Execute Code

- `google_vertex_ai_reasoning_engines_execute_code` - POST /v1/{+name}:executeCode - Reasoning Engines Execute Code

## Feature Groups

- `google_vertex_ai_projects_locations_feature_groups_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Feature Groups Test Iam Permissions
- `google_vertex_ai_projects_locations_feature_groups_delete` - DELETE /v1/{+name} - Projects Locations Feature Groups Delete
- `google_vertex_ai_projects_locations_feature_groups_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Feature Groups Get Iam Policy
- `google_vertex_ai_projects_locations_feature_groups_create` - POST /v1/{+parent}/featureGroups - Projects Locations Feature Groups Create
- `google_vertex_ai_projects_locations_feature_groups_list` - GET /v1/{+parent}/featureGroups - Projects Locations Feature Groups List
- `google_vertex_ai_projects_locations_feature_groups_patch` - PATCH /v1/{+name} - Projects Locations Feature Groups Patch
- `google_vertex_ai_projects_locations_feature_groups_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Feature Groups Set Iam Policy
- `google_vertex_ai_projects_locations_feature_groups_get` - GET /v1/{+name} - Projects Locations Feature Groups Get
- `google_vertex_ai_projects_locations_feature_groups_operations_wait` - POST /v1/{+name}:wait - Projects Locations Feature Groups Operations Wait
- `google_vertex_ai_projects_locations_feature_groups_operations_list_wait` - GET /v1/{+name}:wait - Projects Locations Feature Groups Operations List Wait
- `google_vertex_ai_projects_locations_feature_groups_operations_delete` - DELETE /v1/{+name} - Projects Locations Feature Groups Operations Delete
- `google_vertex_ai_projects_locations_feature_groups_operations_get` - GET /v1/{+name} - Projects Locations Feature Groups Operations Get
- `google_vertex_ai_projects_locations_feature_groups_features_delete` - DELETE /v1/{+name} - Projects Locations Feature Groups Features Delete
- `google_vertex_ai_projects_locations_feature_groups_features_create` - POST /v1/{+parent}/features - Projects Locations Feature Groups Features Create
- `google_vertex_ai_projects_locations_feature_groups_features_list` - GET /v1/{+parent}/features - Projects Locations Feature Groups Features List
- `google_vertex_ai_projects_locations_feature_groups_features_patch` - PATCH /v1/{+name} - Projects Locations Feature Groups Features Patch
- `google_vertex_ai_projects_locations_feature_groups_features_batch_create` - POST /v1/{+parent}/features:batchCreate - Projects Locations Feature Groups Features Batch Create
- `google_vertex_ai_projects_locations_feature_groups_features_get` - GET /v1/{+name} - Projects Locations Feature Groups Features Get
- `google_vertex_ai_projects_locations_feature_groups_features_operations_get` - GET /v1/{+name} - Projects Locations Feature Groups Features Operations Get
- `google_vertex_ai_projects_locations_feature_groups_features_operations_delete` - DELETE /v1/{+name} - Projects Locations Feature Groups Features Operations Delete
- `google_vertex_ai_projects_locations_feature_groups_features_operations_list_wait` - GET /v1/{+name}:wait - Projects Locations Feature Groups Features Operations List Wait
- `google_vertex_ai_projects_locations_feature_groups_features_operations_wait` - POST /v1/{+name}:wait - Projects Locations Feature Groups Features Operations Wait

## Feature Online Stores

- `google_vertex_ai_projects_locations_feature_online_stores_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Feature Online Stores Set Iam Policy
- `google_vertex_ai_projects_locations_feature_online_stores_get` - GET /v1/{+name} - Projects Locations Feature Online Stores Get
- `google_vertex_ai_projects_locations_feature_online_stores_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Feature Online Stores Get Iam Policy
- `google_vertex_ai_projects_locations_feature_online_stores_create` - POST /v1/{+parent}/featureOnlineStores - Projects Locations Feature Online Stores Create
- `google_vertex_ai_projects_locations_feature_online_stores_list` - GET /v1/{+parent}/featureOnlineStores - Projects Locations Feature Online Stores List
- `google_vertex_ai_projects_locations_feature_online_stores_patch` - PATCH /v1/{+name} - Projects Locations Feature Online Stores Patch
- `google_vertex_ai_projects_locations_feature_online_stores_delete` - DELETE /v1/{+name} - Projects Locations Feature Online Stores Delete
- `google_vertex_ai_projects_locations_feature_online_stores_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Feature Online Stores Test Iam Permissions
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Feature Online Stores Feature Views Set Iam Policy
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Feature Online Stores Feature Views Get Iam Policy
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_list` - GET /v1/{+parent}/featureViews - Projects Locations Feature Online Stores Feature Views List
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Feature Online Stores Feature Views Test Iam Permissions
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_search_nearest_entities` - POST /v1/{+featureView}:searchNearestEntities - Projects Locations Feature Online Stores Feature Views Search Nearest Entities
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_generate_fetch_access_token` - POST /v1/{+featureView}:generateFetchAccessToken - Projects Locations Feature Online Stores Feature Views Generate Fetch Access Token
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_sync` - POST /v1/{+featureView}:sync - Projects Locations Feature Online Stores Feature Views Sync
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_create` - POST /v1/{+parent}/featureViews - Projects Locations Feature Online Stores Feature Views Create
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_patch` - PATCH /v1/{+name} - Projects Locations Feature Online Stores Feature Views Patch
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_delete` - DELETE /v1/{+name} - Projects Locations Feature Online Stores Feature Views Delete
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_get` - GET /v1/{+name} - Projects Locations Feature Online Stores Feature Views Get
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_fetch_feature_values` - POST /v1/{+featureView}:fetchFeatureValues - Projects Locations Feature Online Stores Feature Views Fetch Feature Values
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_direct_write` - POST /v1/{+featureView}:directWrite - Projects Locations Feature Online Stores Feature Views Direct Write
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_feature_view_syncs_get` - GET /v1/{+name} - Projects Locations Feature Online Stores Feature Views Feature View Syncs Get
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_feature_view_syncs_list` - GET /v1/{+parent}/featureViewSyncs - Projects Locations Feature Online Stores Feature Views Feature View Syncs List
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_operations_wait` - POST /v1/{+name}:wait - Projects Locations Feature Online Stores Feature Views Operations Wait
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_operations_list_wait` - GET /v1/{+name}:wait - Projects Locations Feature Online Stores Feature Views Operations List Wait
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_operations_delete` - DELETE /v1/{+name} - Projects Locations Feature Online Stores Feature Views Operations Delete
- `google_vertex_ai_projects_locations_feature_online_stores_feature_views_operations_get` - GET /v1/{+name} - Projects Locations Feature Online Stores Feature Views Operations Get
- `google_vertex_ai_projects_locations_feature_online_stores_operations_get` - GET /v1/{+name} - Projects Locations Feature Online Stores Operations Get
- `google_vertex_ai_projects_locations_feature_online_stores_operations_delete` - DELETE /v1/{+name} - Projects Locations Feature Online Stores Operations Delete
- `google_vertex_ai_projects_locations_feature_online_stores_operations_list_wait` - GET /v1/{+name}:wait - Projects Locations Feature Online Stores Operations List Wait
- `google_vertex_ai_projects_locations_feature_online_stores_operations_wait` - POST /v1/{+name}:wait - Projects Locations Feature Online Stores Operations Wait

## Features

- `google_vertex_ai_featurestores_entity_types_features_operations_delete` - DELETE /v1/{+name} - Featurestores Entity Types Features Operations Delete
- `google_vertex_ai_featurestores_entity_types_features_operations_list` - GET /v1/{+name}/operations - Featurestores Entity Types Features Operations List
- `google_vertex_ai_featurestores_entity_types_features_operations_cancel` - POST /v1/{+name}:cancel - Featurestores Entity Types Features Operations Cancel
- `google_vertex_ai_featurestores_entity_types_features_operations_wait` - POST /v1/{+name}:wait - Featurestores Entity Types Features Operations Wait
- `google_vertex_ai_featurestores_entity_types_features_operations_get` - GET /v1/{+name} - Featurestores Entity Types Features Operations Get

## Featurestores

- `google_vertex_ai_projects_locations_featurestores_get` - GET /v1/{+name} - Projects Locations Featurestores Get
- `google_vertex_ai_projects_locations_featurestores_search_features` - GET /v1/{+location}/featurestores:searchFeatures - Projects Locations Featurestores Search Features
- `google_vertex_ai_projects_locations_featurestores_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Featurestores Get Iam Policy
- `google_vertex_ai_projects_locations_featurestores_list` - GET /v1/{+parent}/featurestores - Projects Locations Featurestores List
- `google_vertex_ai_projects_locations_featurestores_patch` - PATCH /v1/{+name} - Projects Locations Featurestores Patch
- `google_vertex_ai_projects_locations_featurestores_batch_read_feature_values` - POST /v1/{+featurestore}:batchReadFeatureValues - Projects Locations Featurestores Batch Read Feature Values
- `google_vertex_ai_projects_locations_featurestores_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Featurestores Test Iam Permissions
- `google_vertex_ai_projects_locations_featurestores_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Delete
- `google_vertex_ai_projects_locations_featurestores_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Featurestores Set Iam Policy
- `google_vertex_ai_projects_locations_featurestores_create` - POST /v1/{+parent}/featurestores - Projects Locations Featurestores Create
- `google_vertex_ai_projects_locations_featurestores_entity_types_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Featurestores Entity Types Get Iam Policy
- `google_vertex_ai_projects_locations_featurestores_entity_types_list` - GET /v1/{+parent}/entityTypes - Projects Locations Featurestores Entity Types List
- `google_vertex_ai_projects_locations_featurestores_entity_types_import_feature_values` - POST /v1/{+entityType}:importFeatureValues - Projects Locations Featurestores Entity Types Import Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Featurestores Entity Types Test Iam Permissions
- `google_vertex_ai_projects_locations_featurestores_entity_types_read_feature_values` - POST /v1/{+entityType}:readFeatureValues - Projects Locations Featurestores Entity Types Read Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Featurestores Entity Types Set Iam Policy
- `google_vertex_ai_projects_locations_featurestores_entity_types_streaming_read_feature_values` - POST /v1/{+entityType}:streamingReadFeatureValues - Projects Locations Featurestores Entity Types Streaming Read Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_get` - GET /v1/{+name} - Projects Locations Featurestores Entity Types Get
- `google_vertex_ai_projects_locations_featurestores_entity_types_export_feature_values` - POST /v1/{+entityType}:exportFeatureValues - Projects Locations Featurestores Entity Types Export Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_patch` - PATCH /v1/{+name} - Projects Locations Featurestores Entity Types Patch
- `google_vertex_ai_projects_locations_featurestores_entity_types_write_feature_values` - POST /v1/{+entityType}:writeFeatureValues - Projects Locations Featurestores Entity Types Write Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Entity Types Delete
- `google_vertex_ai_projects_locations_featurestores_entity_types_delete_feature_values` - POST /v1/{+entityType}:deleteFeatureValues - Projects Locations Featurestores Entity Types Delete Feature Values
- `google_vertex_ai_projects_locations_featurestores_entity_types_create` - POST /v1/{+parent}/entityTypes - Projects Locations Featurestores Entity Types Create
- `google_vertex_ai_projects_locations_featurestores_entity_types_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Featurestores Entity Types Operations Cancel
- `google_vertex_ai_projects_locations_featurestores_entity_types_operations_wait` - POST /v1/{+name}:wait - Projects Locations Featurestores Entity Types Operations Wait
- `google_vertex_ai_projects_locations_featurestores_entity_types_operations_list` - GET /v1/{+name}/operations - Projects Locations Featurestores Entity Types Operations List
- `google_vertex_ai_projects_locations_featurestores_entity_types_operations_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Entity Types Operations Delete
- `google_vertex_ai_projects_locations_featurestores_entity_types_operations_get` - GET /v1/{+name} - Projects Locations Featurestores Entity Types Operations Get
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_get` - GET /v1/{+name} - Projects Locations Featurestores Entity Types Features Get
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Entity Types Features Delete
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_create` - POST /v1/{+parent}/features - Projects Locations Featurestores Entity Types Features Create
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_list` - GET /v1/{+parent}/features - Projects Locations Featurestores Entity Types Features List
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_patch` - PATCH /v1/{+name} - Projects Locations Featurestores Entity Types Features Patch
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_batch_create` - POST /v1/{+parent}/features:batchCreate - Projects Locations Featurestores Entity Types Features Batch Create
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Featurestores Entity Types Features Operations Cancel
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_operations_wait` - POST /v1/{+name}:wait - Projects Locations Featurestores Entity Types Features Operations Wait
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_operations_list` - GET /v1/{+name}/operations - Projects Locations Featurestores Entity Types Features Operations List
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_operations_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Entity Types Features Operations Delete
- `google_vertex_ai_projects_locations_featurestores_entity_types_features_operations_get` - GET /v1/{+name} - Projects Locations Featurestores Entity Types Features Operations Get
- `google_vertex_ai_projects_locations_featurestores_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Featurestores Operations Cancel
- `google_vertex_ai_projects_locations_featurestores_operations_wait` - POST /v1/{+name}:wait - Projects Locations Featurestores Operations Wait
- `google_vertex_ai_projects_locations_featurestores_operations_list` - GET /v1/{+name}/operations - Projects Locations Featurestores Operations List
- `google_vertex_ai_projects_locations_featurestores_operations_delete` - DELETE /v1/{+name} - Projects Locations Featurestores Operations Delete
- `google_vertex_ai_projects_locations_featurestores_operations_get` - GET /v1/{+name} - Projects Locations Featurestores Operations Get

## Fetch Predict Operation

- `google_vertex_ai_endpoints_fetch_predict_operation` - POST /v1/{+endpoint}:fetchPredictOperation - Endpoints Fetch Predict Operation
- `google_vertex_ai_publishers_models_fetch_predict_operation` - POST /v1/{+endpoint}:fetchPredictOperation - Publishers Models Fetch Predict Operation

## Generate Content

- `google_vertex_ai_endpoints_generate_content` - POST /v1/{+model}:generateContent - Endpoints Generate Content
- `google_vertex_ai_publishers_models_generate_content` - POST /v1/{+model}:generateContent - Publishers Models Generate Content

## Generate Instance Rubrics

- `google_vertex_ai_v1_generate_instance_rubrics` - POST /v1:generateInstanceRubrics - V1 Generate Instance Rubrics
- `google_vertex_ai_projects_locations_generate_instance_rubrics` - POST /v1/{+location}:generateInstanceRubrics - Projects Locations Generate Instance Rubrics

## Generate Synthetic Data

- `google_vertex_ai_projects_locations_generate_synthetic_data` - POST /v1/{+location}:generateSyntheticData - Projects Locations Generate Synthetic Data

## Get

- `google_vertex_ai_reasoning_engines_get` - GET /v1/{+name} - Reasoning Engines Get
- `google_vertex_ai_reasoning_engines_sandbox_environments_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environments Get
- `google_vertex_ai_reasoning_engines_operations_get` - GET /v1/{+name} - Reasoning Engines Operations Get
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environment Snapshots Get
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environment Templates Get
- `google_vertex_ai_schedules_operations_get` - GET /v1/{+name} - Schedules Operations Get
- `google_vertex_ai_custom_jobs_operations_get` - GET /v1/{+name} - Custom Jobs Operations Get
- `google_vertex_ai_studies_operations_get` - GET /v1/{+name} - Studies Operations Get
- `google_vertex_ai_data_labeling_jobs_operations_get` - GET /v1/{+name} - Data Labeling Jobs Operations Get
- `google_vertex_ai_tuning_jobs_operations_get` - GET /v1/{+name} - Tuning Jobs Operations Get
- `google_vertex_ai_migratable_resources_operations_get` - GET /v1/{+name} - Migratable Resources Operations Get
- `google_vertex_ai_notebook_runtimes_operations_get` - GET /v1/{+name} - Notebook Runtimes Operations Get
- `google_vertex_ai_model_deployment_monitoring_jobs_operations_get` - GET /v1/{+name} - Model Deployment Monitoring Jobs Operations Get
- `google_vertex_ai_operations_get` - GET /v1/{+name} - Operations Get
- `google_vertex_ai_models_operations_get` - GET /v1/{+name} - Models Operations Get
- `google_vertex_ai_notebook_runtime_templates_operations_get` - GET /v1/{+name} - Notebook Runtime Templates Operations Get
- `google_vertex_ai_feature_groups_operations_get` - GET /v1/{+name} - Feature Groups Operations Get
- `google_vertex_ai_projects_locations_get` - GET /v1/{+name} - Projects Locations Get
- `google_vertex_ai_deployment_resource_pools_operations_get` - GET /v1/{+name} - Deployment Resource Pools Operations Get
- `google_vertex_ai_specialist_pools_operations_get` - GET /v1/{+name} - Specialist Pools Operations Get
- `google_vertex_ai_persistent_resources_operations_get` - GET /v1/{+name} - Persistent Resources Operations Get
- `google_vertex_ai_index_endpoints_operations_get` - GET /v1/{+name} - Index Endpoints Operations Get
- `google_vertex_ai_hyperparameter_tuning_jobs_operations_get` - GET /v1/{+name} - Hyperparameter Tuning Jobs Operations Get
- `google_vertex_ai_indexes_operations_get` - GET /v1/{+name} - Indexes Operations Get
- `google_vertex_ai_training_pipelines_operations_get` - GET /v1/{+name} - Training Pipelines Operations Get
- `google_vertex_ai_skills_operations_get` - GET /v1/{+name} - Skills Operations Get
- `google_vertex_ai_endpoints_operations_get` - GET /v1/{+name} - Endpoints Operations Get
- `google_vertex_ai_pipeline_jobs_operations_get` - GET /v1/{+name} - Pipeline Jobs Operations Get
- `google_vertex_ai_rag_corpora_operations_get` - GET /v1/{+name} - Rag Corpora Operations Get
- `google_vertex_ai_tensorboards_operations_get` - GET /v1/{+name} - Tensorboards Operations Get
- `google_vertex_ai_notebook_execution_jobs_operations_get` - GET /v1/{+name} - Notebook Execution Jobs Operations Get
- `google_vertex_ai_rag_engine_config_operations_get` - GET /v1/{+name} - Rag Engine Config Operations Get
- `google_vertex_ai_feature_online_stores_operations_get` - GET /v1/{+name} - Feature Online Stores Operations Get
- `google_vertex_ai_datasets_get` - GET /v1/{+name} - Datasets Get
- `google_vertex_ai_datasets_operations_get` - GET /v1/{+name} - Datasets Operations Get
- `google_vertex_ai_datasets_dataset_versions_get` - GET /v1/{+name} - Datasets Dataset Versions Get
- `google_vertex_ai_publishers_models_get` - GET /v1/{+name} - Publishers Models Get
- `google_vertex_ai_featurestores_operations_get` - GET /v1/{+name} - Featurestores Operations Get
- `google_vertex_ai_metadata_stores_operations_get` - GET /v1/{+name} - Metadata Stores Operations Get
- `google_vertex_ai_batch_prediction_jobs_get` - GET /v1/{+name} - Batch Prediction Jobs Get

## Get Cache Config

- `google_vertex_ai_projects_get_cache_config` - GET /v1/{+name} - Projects Get Cache Config

## Get Rag Engine Config

- `google_vertex_ai_projects_locations_get_rag_engine_config` - GET /v1/{+name} - Projects Locations Get Rag Engine Config

## Hyperparameter Tuning Jobs

- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_get` - GET /v1/{+name} - Projects Locations Hyperparameter Tuning Jobs Get
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Hyperparameter Tuning Jobs Cancel
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_create` - POST /v1/{+parent}/hyperparameterTuningJobs - Projects Locations Hyperparameter Tuning Jobs Create
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_list` - GET /v1/{+parent}/hyperparameterTuningJobs - Projects Locations Hyperparameter Tuning Jobs List
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_delete` - DELETE /v1/{+name} - Projects Locations Hyperparameter Tuning Jobs Delete
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_operations_get` - GET /v1/{+name} - Projects Locations Hyperparameter Tuning Jobs Operations Get
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Hyperparameter Tuning Jobs Operations Delete
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Hyperparameter Tuning Jobs Operations List
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Hyperparameter Tuning Jobs Operations Cancel
- `google_vertex_ai_projects_locations_hyperparameter_tuning_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Hyperparameter Tuning Jobs Operations Wait

## Index Endpoints

- `google_vertex_ai_projects_locations_index_endpoints_create` - POST /v1/{+parent}/indexEndpoints - Projects Locations Index Endpoints Create
- `google_vertex_ai_projects_locations_index_endpoints_deploy_index` - POST /v1/{+indexEndpoint}:deployIndex - Projects Locations Index Endpoints Deploy Index
- `google_vertex_ai_projects_locations_index_endpoints_find_neighbors` - POST /v1/{+indexEndpoint}:findNeighbors - Projects Locations Index Endpoints Find Neighbors
- `google_vertex_ai_projects_locations_index_endpoints_undeploy_index` - POST /v1/{+indexEndpoint}:undeployIndex - Projects Locations Index Endpoints Undeploy Index
- `google_vertex_ai_projects_locations_index_endpoints_read_index_datapoints` - POST /v1/{+indexEndpoint}:readIndexDatapoints - Projects Locations Index Endpoints Read Index Datapoints
- `google_vertex_ai_projects_locations_index_endpoints_list` - GET /v1/{+parent}/indexEndpoints - Projects Locations Index Endpoints List
- `google_vertex_ai_projects_locations_index_endpoints_patch` - PATCH /v1/{+name} - Projects Locations Index Endpoints Patch
- `google_vertex_ai_projects_locations_index_endpoints_delete` - DELETE /v1/{+name} - Projects Locations Index Endpoints Delete
- `google_vertex_ai_projects_locations_index_endpoints_mutate_deployed_index` - POST /v1/{+indexEndpoint}:mutateDeployedIndex - Projects Locations Index Endpoints Mutate Deployed Index
- `google_vertex_ai_projects_locations_index_endpoints_get` - GET /v1/{+name} - Projects Locations Index Endpoints Get
- `google_vertex_ai_projects_locations_index_endpoints_operations_get` - GET /v1/{+name} - Projects Locations Index Endpoints Operations Get
- `google_vertex_ai_projects_locations_index_endpoints_operations_delete` - DELETE /v1/{+name} - Projects Locations Index Endpoints Operations Delete
- `google_vertex_ai_projects_locations_index_endpoints_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Index Endpoints Operations Cancel
- `google_vertex_ai_projects_locations_index_endpoints_operations_wait` - POST /v1/{+name}:wait - Projects Locations Index Endpoints Operations Wait
- `google_vertex_ai_projects_locations_index_endpoints_operations_list` - GET /v1/{+name}/operations - Projects Locations Index Endpoints Operations List

## Indexes

- `google_vertex_ai_projects_locations_indexes_upsert_datapoints` - POST /v1/{+index}:upsertDatapoints - Projects Locations Indexes Upsert Datapoints
- `google_vertex_ai_projects_locations_indexes_create` - POST /v1/{+parent}/indexes - Projects Locations Indexes Create
- `google_vertex_ai_projects_locations_indexes_list` - GET /v1/{+parent}/indexes - Projects Locations Indexes List
- `google_vertex_ai_projects_locations_indexes_patch` - PATCH /v1/{+name} - Projects Locations Indexes Patch
- `google_vertex_ai_projects_locations_indexes_delete` - DELETE /v1/{+name} - Projects Locations Indexes Delete
- `google_vertex_ai_projects_locations_indexes_remove_datapoints` - POST /v1/{+index}:removeDatapoints - Projects Locations Indexes Remove Datapoints
- `google_vertex_ai_projects_locations_indexes_get` - GET /v1/{+name} - Projects Locations Indexes Get
- `google_vertex_ai_projects_locations_indexes_operations_list` - GET /v1/{+name}/operations - Projects Locations Indexes Operations List
- `google_vertex_ai_projects_locations_indexes_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Indexes Operations Cancel
- `google_vertex_ai_projects_locations_indexes_operations_wait` - POST /v1/{+name}:wait - Projects Locations Indexes Operations Wait
- `google_vertex_ai_projects_locations_indexes_operations_delete` - DELETE /v1/{+name} - Projects Locations Indexes Operations Delete
- `google_vertex_ai_projects_locations_indexes_operations_get` - GET /v1/{+name} - Projects Locations Indexes Operations Get

## List

- `google_vertex_ai_reasoning_engines_list` - GET /v1/reasoningEngines - Reasoning Engines List
- `google_vertex_ai_reasoning_engines_sandbox_environments_list` - GET /v1/{+parent}/sandboxEnvironments - Reasoning Engines Sandbox Environments List
- `google_vertex_ai_reasoning_engines_operations_list` - GET /v1/{+name}/operations - Reasoning Engines Operations List
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_list` - GET /v1/{+parent}/sandboxEnvironmentSnapshots - Reasoning Engines Sandbox Environment Snapshots List
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_list` - GET /v1/{+parent}/sandboxEnvironmentTemplates - Reasoning Engines Sandbox Environment Templates List
- `google_vertex_ai_schedules_operations_list` - GET /v1/{+name}/operations - Schedules Operations List
- `google_vertex_ai_custom_jobs_operations_list` - GET /v1/{+name}/operations - Custom Jobs Operations List
- `google_vertex_ai_studies_operations_list` - GET /v1/{+name}/operations - Studies Operations List
- `google_vertex_ai_data_labeling_jobs_operations_list` - GET /v1/{+name}/operations - Data Labeling Jobs Operations List
- `google_vertex_ai_tuning_jobs_operations_list` - GET /v1/{+name}/operations - Tuning Jobs Operations List
- `google_vertex_ai_migratable_resources_operations_list` - GET /v1/{+name}/operations - Migratable Resources Operations List
- `google_vertex_ai_notebook_runtimes_operations_list` - GET /v1/{+name}/operations - Notebook Runtimes Operations List
- `google_vertex_ai_model_deployment_monitoring_jobs_operations_list` - GET /v1/{+name}/operations - Model Deployment Monitoring Jobs Operations List
- `google_vertex_ai_operations_list` - GET /v1/operations - Operations List
- `google_vertex_ai_models_operations_list` - GET /v1/{+name}/operations - Models Operations List
- `google_vertex_ai_notebook_runtime_templates_operations_list` - GET /v1/{+name}/operations - Notebook Runtime Templates Operations List
- `google_vertex_ai_projects_locations_list` - GET /v1/{+name}/locations - Projects Locations List
- `google_vertex_ai_deployment_resource_pools_operations_list` - GET /v1/{+name}/operations - Deployment Resource Pools Operations List
- `google_vertex_ai_specialist_pools_operations_list` - GET /v1/{+name}/operations - Specialist Pools Operations List
- `google_vertex_ai_persistent_resources_operations_list` - GET /v1/{+name}/operations - Persistent Resources Operations List
- `google_vertex_ai_index_endpoints_operations_list` - GET /v1/{+name}/operations - Index Endpoints Operations List
- `google_vertex_ai_hyperparameter_tuning_jobs_operations_list` - GET /v1/{+name}/operations - Hyperparameter Tuning Jobs Operations List
- `google_vertex_ai_indexes_operations_list` - GET /v1/{+name}/operations - Indexes Operations List
- `google_vertex_ai_training_pipelines_operations_list` - GET /v1/{+name}/operations - Training Pipelines Operations List
- `google_vertex_ai_skills_operations_list` - GET /v1/{+name}/operations - Skills Operations List
- `google_vertex_ai_endpoints_operations_list` - GET /v1/{+name}/operations - Endpoints Operations List
- `google_vertex_ai_pipeline_jobs_operations_list` - GET /v1/{+name}/operations - Pipeline Jobs Operations List
- `google_vertex_ai_rag_corpora_operations_list` - GET /v1/{+name}/operations - Rag Corpora Operations List
- `google_vertex_ai_tensorboards_operations_list` - GET /v1/{+name}/operations - Tensorboards Operations List
- `google_vertex_ai_notebook_execution_jobs_operations_list` - GET /v1/{+name}/operations - Notebook Execution Jobs Operations List
- `google_vertex_ai_rag_engine_config_operations_list` - GET /v1/{+name}/operations - Rag Engine Config Operations List
- `google_vertex_ai_datasets_list` - GET /v1/datasets - Datasets List
- `google_vertex_ai_datasets_operations_list` - GET /v1/{+name}/operations - Datasets Operations List
- `google_vertex_ai_datasets_dataset_versions_list` - GET /v1/{+parent}/datasetVersions - Datasets Dataset Versions List
- `google_vertex_ai_featurestores_operations_list` - GET /v1/{+name}/operations - Featurestores Operations List
- `google_vertex_ai_metadata_stores_operations_list` - GET /v1/{+name}/operations - Metadata Stores Operations List
- `google_vertex_ai_batch_prediction_jobs_list` - GET /v1/batchPredictionJobs - Batch Prediction Jobs List

## List Wait

- `google_vertex_ai_feature_groups_operations_list_wait` - GET /v1/{+name}:wait - Feature Groups Operations List Wait
- `google_vertex_ai_feature_online_stores_operations_list_wait` - GET /v1/{+name}:wait - Feature Online Stores Operations List Wait

## Metadata Stores

- `google_vertex_ai_projects_locations_metadata_stores_get` - GET /v1/{+name} - Projects Locations Metadata Stores Get
- `google_vertex_ai_projects_locations_metadata_stores_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Delete
- `google_vertex_ai_projects_locations_metadata_stores_create` - POST /v1/{+parent}/metadataStores - Projects Locations Metadata Stores Create
- `google_vertex_ai_projects_locations_metadata_stores_list` - GET /v1/{+parent}/metadataStores - Projects Locations Metadata Stores List
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Artifacts Delete
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_create` - POST /v1/{+parent}/artifacts - Projects Locations Metadata Stores Artifacts Create
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_list` - GET /v1/{+parent}/artifacts - Projects Locations Metadata Stores Artifacts List
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_patch` - PATCH /v1/{+name} - Projects Locations Metadata Stores Artifacts Patch
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_get` - GET /v1/{+name} - Projects Locations Metadata Stores Artifacts Get
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_query_artifact_lineage_subgraph` - GET /v1/{+artifact}:queryArtifactLineageSubgraph - Projects Locations Metadata Stores Artifacts Query Artifact Lineage Subgraph
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_purge` - POST /v1/{+parent}/artifacts:purge - Projects Locations Metadata Stores Artifacts Purge
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_operations_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Artifacts Operations Delete
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_operations_list` - GET /v1/{+name}/operations - Projects Locations Metadata Stores Artifacts Operations List
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Metadata Stores Artifacts Operations Cancel
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_operations_wait` - POST /v1/{+name}:wait - Projects Locations Metadata Stores Artifacts Operations Wait
- `google_vertex_ai_projects_locations_metadata_stores_artifacts_operations_get` - GET /v1/{+name} - Projects Locations Metadata Stores Artifacts Operations Get
- `google_vertex_ai_projects_locations_metadata_stores_contexts_purge` - POST /v1/{+parent}/contexts:purge - Projects Locations Metadata Stores Contexts Purge
- `google_vertex_ai_projects_locations_metadata_stores_contexts_query_context_lineage_subgraph` - GET /v1/{+context}:queryContextLineageSubgraph - Projects Locations Metadata Stores Contexts Query Context Lineage Subgraph
- `google_vertex_ai_projects_locations_metadata_stores_contexts_add_context_children` - POST /v1/{+context}:addContextChildren - Projects Locations Metadata Stores Contexts Add Context Children
- `google_vertex_ai_projects_locations_metadata_stores_contexts_create` - POST /v1/{+parent}/contexts - Projects Locations Metadata Stores Contexts Create
- `google_vertex_ai_projects_locations_metadata_stores_contexts_remove_context_children` - POST /v1/{+context}:removeContextChildren - Projects Locations Metadata Stores Contexts Remove Context Children
- `google_vertex_ai_projects_locations_metadata_stores_contexts_get` - GET /v1/{+name} - Projects Locations Metadata Stores Contexts Get
- `google_vertex_ai_projects_locations_metadata_stores_contexts_list` - GET /v1/{+parent}/contexts - Projects Locations Metadata Stores Contexts List
- `google_vertex_ai_projects_locations_metadata_stores_contexts_patch` - PATCH /v1/{+name} - Projects Locations Metadata Stores Contexts Patch
- `google_vertex_ai_projects_locations_metadata_stores_contexts_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Contexts Delete
- `google_vertex_ai_projects_locations_metadata_stores_contexts_add_context_artifacts_and_executions` - POST /v1/{+context}:addContextArtifactsAndExecutions - Projects Locations Metadata Stores Contexts Add Context Artifacts And Executions
- `google_vertex_ai_projects_locations_metadata_stores_contexts_operations_get` - GET /v1/{+name} - Projects Locations Metadata Stores Contexts Operations Get
- `google_vertex_ai_projects_locations_metadata_stores_contexts_operations_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Contexts Operations Delete
- `google_vertex_ai_projects_locations_metadata_stores_contexts_operations_list` - GET /v1/{+name}/operations - Projects Locations Metadata Stores Contexts Operations List
- `google_vertex_ai_projects_locations_metadata_stores_contexts_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Metadata Stores Contexts Operations Cancel
- `google_vertex_ai_projects_locations_metadata_stores_contexts_operations_wait` - POST /v1/{+name}:wait - Projects Locations Metadata Stores Contexts Operations Wait
- `google_vertex_ai_projects_locations_metadata_stores_executions_purge` - POST /v1/{+parent}/executions:purge - Projects Locations Metadata Stores Executions Purge
- `google_vertex_ai_projects_locations_metadata_stores_executions_get` - GET /v1/{+name} - Projects Locations Metadata Stores Executions Get
- `google_vertex_ai_projects_locations_metadata_stores_executions_add_execution_events` - POST /v1/{+execution}:addExecutionEvents - Projects Locations Metadata Stores Executions Add Execution Events
- `google_vertex_ai_projects_locations_metadata_stores_executions_create` - POST /v1/{+parent}/executions - Projects Locations Metadata Stores Executions Create
- `google_vertex_ai_projects_locations_metadata_stores_executions_list` - GET /v1/{+parent}/executions - Projects Locations Metadata Stores Executions List
- `google_vertex_ai_projects_locations_metadata_stores_executions_patch` - PATCH /v1/{+name} - Projects Locations Metadata Stores Executions Patch
- `google_vertex_ai_projects_locations_metadata_stores_executions_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Executions Delete
- `google_vertex_ai_projects_locations_metadata_stores_executions_query_execution_inputs_and_outputs` - GET /v1/{+execution}:queryExecutionInputsAndOutputs - Projects Locations Metadata Stores Executions Query Execution Inputs And Outputs
- `google_vertex_ai_projects_locations_metadata_stores_executions_operations_get` - GET /v1/{+name} - Projects Locations Metadata Stores Executions Operations Get
- `google_vertex_ai_projects_locations_metadata_stores_executions_operations_list` - GET /v1/{+name}/operations - Projects Locations Metadata Stores Executions Operations List
- `google_vertex_ai_projects_locations_metadata_stores_executions_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Metadata Stores Executions Operations Cancel
- `google_vertex_ai_projects_locations_metadata_stores_executions_operations_wait` - POST /v1/{+name}:wait - Projects Locations Metadata Stores Executions Operations Wait
- `google_vertex_ai_projects_locations_metadata_stores_executions_operations_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Executions Operations Delete
- `google_vertex_ai_projects_locations_metadata_stores_metadata_schemas_get` - GET /v1/{+name} - Projects Locations Metadata Stores Metadata Schemas Get
- `google_vertex_ai_projects_locations_metadata_stores_metadata_schemas_create` - POST /v1/{+parent}/metadataSchemas - Projects Locations Metadata Stores Metadata Schemas Create
- `google_vertex_ai_projects_locations_metadata_stores_metadata_schemas_list` - GET /v1/{+parent}/metadataSchemas - Projects Locations Metadata Stores Metadata Schemas List
- `google_vertex_ai_projects_locations_metadata_stores_operations_get` - GET /v1/{+name} - Projects Locations Metadata Stores Operations Get
- `google_vertex_ai_projects_locations_metadata_stores_operations_delete` - DELETE /v1/{+name} - Projects Locations Metadata Stores Operations Delete
- `google_vertex_ai_projects_locations_metadata_stores_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Metadata Stores Operations Cancel
- `google_vertex_ai_projects_locations_metadata_stores_operations_wait` - POST /v1/{+name}:wait - Projects Locations Metadata Stores Operations Wait
- `google_vertex_ai_projects_locations_metadata_stores_operations_list` - GET /v1/{+name}/operations - Projects Locations Metadata Stores Operations List

## Migratable Resources

- `google_vertex_ai_projects_locations_migratable_resources_batch_migrate` - POST /v1/{+parent}/migratableResources:batchMigrate - Projects Locations Migratable Resources Batch Migrate
- `google_vertex_ai_projects_locations_migratable_resources_search` - POST /v1/{+parent}/migratableResources:search - Projects Locations Migratable Resources Search
- `google_vertex_ai_projects_locations_migratable_resources_operations_get` - GET /v1/{+name} - Projects Locations Migratable Resources Operations Get
- `google_vertex_ai_projects_locations_migratable_resources_operations_list` - GET /v1/{+name}/operations - Projects Locations Migratable Resources Operations List
- `google_vertex_ai_projects_locations_migratable_resources_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Migratable Resources Operations Cancel
- `google_vertex_ai_projects_locations_migratable_resources_operations_wait` - POST /v1/{+name}:wait - Projects Locations Migratable Resources Operations Wait
- `google_vertex_ai_projects_locations_migratable_resources_operations_delete` - DELETE /v1/{+name} - Projects Locations Migratable Resources Operations Delete

## Model Deployment Monitoring Jobs

- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_delete` - DELETE /v1/{+name} - Projects Locations Model Deployment Monitoring Jobs Delete
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_create` - POST /v1/{+parent}/modelDeploymentMonitoringJobs - Projects Locations Model Deployment Monitoring Jobs Create
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_list` - GET /v1/{+parent}/modelDeploymentMonitoringJobs - Projects Locations Model Deployment Monitoring Jobs List
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_patch` - PATCH /v1/{+name} - Projects Locations Model Deployment Monitoring Jobs Patch
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_get` - GET /v1/{+name} - Projects Locations Model Deployment Monitoring Jobs Get
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_pause` - POST /v1/{+name}:pause - Projects Locations Model Deployment Monitoring Jobs Pause
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_search_model_deployment_monitoring_stats_anomalies` - POST /v1/{+modelDeploymentMonitoringJob}:searchModelDeploymentMonitoringStatsAnomalies - Projects Locations Model Deployment Monitoring Jobs Search Model Deployment Monitoring Stats Anomalies
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_resume` - POST /v1/{+name}:resume - Projects Locations Model Deployment Monitoring Jobs Resume
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_operations_get` - GET /v1/{+name} - Projects Locations Model Deployment Monitoring Jobs Operations Get
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Model Deployment Monitoring Jobs Operations Delete
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Model Deployment Monitoring Jobs Operations List
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Model Deployment Monitoring Jobs Operations Cancel
- `google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Model Deployment Monitoring Jobs Operations Wait

## Models

- `google_vertex_ai_projects_locations_models_patch` - PATCH /v1/{+name} - Projects Locations Models Patch
- `google_vertex_ai_projects_locations_models_copy` - POST /v1/{+parent}/models:copy - Projects Locations Models Copy
- `google_vertex_ai_projects_locations_models_delete` - DELETE /v1/{+name} - Projects Locations Models Delete
- `google_vertex_ai_projects_locations_models_get` - GET /v1/{+name} - Projects Locations Models Get
- `google_vertex_ai_projects_locations_models_upload` - POST /v1/{+parent}/models:upload - Projects Locations Models Upload
- `google_vertex_ai_projects_locations_models_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Models Get Iam Policy
- `google_vertex_ai_projects_locations_models_list` - GET /v1/{+parent}/models - Projects Locations Models List
- `google_vertex_ai_projects_locations_models_export` - POST /v1/{+name}:export - Projects Locations Models Export
- `google_vertex_ai_projects_locations_models_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Models Test Iam Permissions
- `google_vertex_ai_projects_locations_models_delete_version` - DELETE /v1/{+name}:deleteVersion - Projects Locations Models Delete Version
- `google_vertex_ai_projects_locations_models_merge_version_aliases` - POST /v1/{+name}:mergeVersionAliases - Projects Locations Models Merge Version Aliases
- `google_vertex_ai_projects_locations_models_list_checkpoints` - GET /v1/{+name}:listCheckpoints - Projects Locations Models List Checkpoints
- `google_vertex_ai_projects_locations_models_list_versions` - GET /v1/{+name}:listVersions - Projects Locations Models List Versions
- `google_vertex_ai_projects_locations_models_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Models Set Iam Policy
- `google_vertex_ai_projects_locations_models_update_explanation_dataset` - POST /v1/{+model}:updateExplanationDataset - Projects Locations Models Update Explanation Dataset
- `google_vertex_ai_projects_locations_models_operations_delete` - DELETE /v1/{+name} - Projects Locations Models Operations Delete
- `google_vertex_ai_projects_locations_models_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Models Operations Cancel
- `google_vertex_ai_projects_locations_models_operations_wait` - POST /v1/{+name}:wait - Projects Locations Models Operations Wait
- `google_vertex_ai_projects_locations_models_operations_list` - GET /v1/{+name}/operations - Projects Locations Models Operations List
- `google_vertex_ai_projects_locations_models_operations_get` - GET /v1/{+name} - Projects Locations Models Operations Get
- `google_vertex_ai_projects_locations_models_evaluations_import` - POST /v1/{+parent}/evaluations:import - Projects Locations Models Evaluations Import
- `google_vertex_ai_projects_locations_models_evaluations_list` - GET /v1/{+parent}/evaluations - Projects Locations Models Evaluations List
- `google_vertex_ai_projects_locations_models_evaluations_get` - GET /v1/{+name} - Projects Locations Models Evaluations Get
- `google_vertex_ai_projects_locations_models_evaluations_operations_get` - GET /v1/{+name} - Projects Locations Models Evaluations Operations Get
- `google_vertex_ai_projects_locations_models_evaluations_operations_delete` - DELETE /v1/{+name} - Projects Locations Models Evaluations Operations Delete
- `google_vertex_ai_projects_locations_models_evaluations_operations_list` - GET /v1/{+name}/operations - Projects Locations Models Evaluations Operations List
- `google_vertex_ai_projects_locations_models_evaluations_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Models Evaluations Operations Cancel
- `google_vertex_ai_projects_locations_models_evaluations_operations_wait` - POST /v1/{+name}:wait - Projects Locations Models Evaluations Operations Wait
- `google_vertex_ai_projects_locations_models_evaluations_slices_list` - GET /v1/{+parent}/slices - Projects Locations Models Evaluations Slices List
- `google_vertex_ai_projects_locations_models_evaluations_slices_batch_import` - POST /v1/{+parent}:batchImport - Projects Locations Models Evaluations Slices Batch Import
- `google_vertex_ai_projects_locations_models_evaluations_slices_get` - GET /v1/{+name} - Projects Locations Models Evaluations Slices Get

## Nas Jobs

- `google_vertex_ai_projects_locations_nas_jobs_delete` - DELETE /v1/{+name} - Projects Locations Nas Jobs Delete
- `google_vertex_ai_projects_locations_nas_jobs_create` - POST /v1/{+parent}/nasJobs - Projects Locations Nas Jobs Create
- `google_vertex_ai_projects_locations_nas_jobs_list` - GET /v1/{+parent}/nasJobs - Projects Locations Nas Jobs List
- `google_vertex_ai_projects_locations_nas_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Nas Jobs Cancel
- `google_vertex_ai_projects_locations_nas_jobs_get` - GET /v1/{+name} - Projects Locations Nas Jobs Get
- `google_vertex_ai_projects_locations_nas_jobs_nas_trial_details_get` - GET /v1/{+name} - Projects Locations Nas Jobs Nas Trial Details Get
- `google_vertex_ai_projects_locations_nas_jobs_nas_trial_details_list` - GET /v1/{+parent}/nasTrialDetails - Projects Locations Nas Jobs Nas Trial Details List

## Notebook Execution Jobs

- `google_vertex_ai_projects_locations_notebook_execution_jobs_create` - POST /v1/{+parent}/notebookExecutionJobs - Projects Locations Notebook Execution Jobs Create
- `google_vertex_ai_projects_locations_notebook_execution_jobs_list` - GET /v1/{+parent}/notebookExecutionJobs - Projects Locations Notebook Execution Jobs List
- `google_vertex_ai_projects_locations_notebook_execution_jobs_get` - GET /v1/{+name} - Projects Locations Notebook Execution Jobs Get
- `google_vertex_ai_projects_locations_notebook_execution_jobs_delete` - DELETE /v1/{+name} - Projects Locations Notebook Execution Jobs Delete
- `google_vertex_ai_projects_locations_notebook_execution_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Notebook Execution Jobs Operations Delete
- `google_vertex_ai_projects_locations_notebook_execution_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Notebook Execution Jobs Operations List
- `google_vertex_ai_projects_locations_notebook_execution_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Notebook Execution Jobs Operations Cancel
- `google_vertex_ai_projects_locations_notebook_execution_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Notebook Execution Jobs Operations Wait
- `google_vertex_ai_projects_locations_notebook_execution_jobs_operations_get` - GET /v1/{+name} - Projects Locations Notebook Execution Jobs Operations Get

## Notebook Runtime Templates

- `google_vertex_ai_projects_locations_notebook_runtime_templates_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Notebook Runtime Templates Set Iam Policy
- `google_vertex_ai_projects_locations_notebook_runtime_templates_get` - GET /v1/{+name} - Projects Locations Notebook Runtime Templates Get
- `google_vertex_ai_projects_locations_notebook_runtime_templates_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Notebook Runtime Templates Get Iam Policy
- `google_vertex_ai_projects_locations_notebook_runtime_templates_create` - POST /v1/{+parent}/notebookRuntimeTemplates - Projects Locations Notebook Runtime Templates Create
- `google_vertex_ai_projects_locations_notebook_runtime_templates_list` - GET /v1/{+parent}/notebookRuntimeTemplates - Projects Locations Notebook Runtime Templates List
- `google_vertex_ai_projects_locations_notebook_runtime_templates_patch` - PATCH /v1/{+name} - Projects Locations Notebook Runtime Templates Patch
- `google_vertex_ai_projects_locations_notebook_runtime_templates_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Notebook Runtime Templates Test Iam Permissions
- `google_vertex_ai_projects_locations_notebook_runtime_templates_delete` - DELETE /v1/{+name} - Projects Locations Notebook Runtime Templates Delete
- `google_vertex_ai_projects_locations_notebook_runtime_templates_operations_list` - GET /v1/{+name}/operations - Projects Locations Notebook Runtime Templates Operations List
- `google_vertex_ai_projects_locations_notebook_runtime_templates_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Notebook Runtime Templates Operations Cancel
- `google_vertex_ai_projects_locations_notebook_runtime_templates_operations_wait` - POST /v1/{+name}:wait - Projects Locations Notebook Runtime Templates Operations Wait
- `google_vertex_ai_projects_locations_notebook_runtime_templates_operations_delete` - DELETE /v1/{+name} - Projects Locations Notebook Runtime Templates Operations Delete
- `google_vertex_ai_projects_locations_notebook_runtime_templates_operations_get` - GET /v1/{+name} - Projects Locations Notebook Runtime Templates Operations Get

## Notebook Runtimes

- `google_vertex_ai_projects_locations_notebook_runtimes_delete` - DELETE /v1/{+name} - Projects Locations Notebook Runtimes Delete
- `google_vertex_ai_projects_locations_notebook_runtimes_upgrade` - POST /v1/{+name}:upgrade - Projects Locations Notebook Runtimes Upgrade
- `google_vertex_ai_projects_locations_notebook_runtimes_start` - POST /v1/{+name}:start - Projects Locations Notebook Runtimes Start
- `google_vertex_ai_projects_locations_notebook_runtimes_list` - GET /v1/{+parent}/notebookRuntimes - Projects Locations Notebook Runtimes List
- `google_vertex_ai_projects_locations_notebook_runtimes_assign` - POST /v1/{+parent}/notebookRuntimes:assign - Projects Locations Notebook Runtimes Assign
- `google_vertex_ai_projects_locations_notebook_runtimes_get` - GET /v1/{+name} - Projects Locations Notebook Runtimes Get
- `google_vertex_ai_projects_locations_notebook_runtimes_stop` - POST /v1/{+name}:stop - Projects Locations Notebook Runtimes Stop
- `google_vertex_ai_projects_locations_notebook_runtimes_operations_get` - GET /v1/{+name} - Projects Locations Notebook Runtimes Operations Get
- `google_vertex_ai_projects_locations_notebook_runtimes_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Notebook Runtimes Operations Cancel
- `google_vertex_ai_projects_locations_notebook_runtimes_operations_wait` - POST /v1/{+name}:wait - Projects Locations Notebook Runtimes Operations Wait
- `google_vertex_ai_projects_locations_notebook_runtimes_operations_list` - GET /v1/{+name}/operations - Projects Locations Notebook Runtimes Operations List
- `google_vertex_ai_projects_locations_notebook_runtimes_operations_delete` - DELETE /v1/{+name} - Projects Locations Notebook Runtimes Operations Delete

## Operations

- `google_vertex_ai_reasoning_engines_sandbox_environments_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Sandbox Environments Operations Cancel
- `google_vertex_ai_reasoning_engines_sandbox_environments_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Sandbox Environments Operations Wait
- `google_vertex_ai_reasoning_engines_sandbox_environments_operations_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environments Operations Get
- `google_vertex_ai_reasoning_engines_sandbox_environments_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environments Operations Delete
- `google_vertex_ai_reasoning_engines_sessions_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Sessions Operations Delete
- `google_vertex_ai_reasoning_engines_sessions_operations_list` - GET /v1/{+name}/operations - Reasoning Engines Sessions Operations List
- `google_vertex_ai_reasoning_engines_sessions_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Sessions Operations Cancel
- `google_vertex_ai_reasoning_engines_sessions_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Sessions Operations Wait
- `google_vertex_ai_reasoning_engines_sessions_operations_get` - GET /v1/{+name} - Reasoning Engines Sessions Operations Get
- `google_vertex_ai_reasoning_engines_memories_operations_get` - GET /v1/{+name} - Reasoning Engines Memories Operations Get
- `google_vertex_ai_reasoning_engines_memories_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Memories Operations Cancel
- `google_vertex_ai_reasoning_engines_memories_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Memories Operations Wait
- `google_vertex_ai_reasoning_engines_memories_operations_list` - GET /v1/{+name}/operations - Reasoning Engines Memories Operations List
- `google_vertex_ai_reasoning_engines_memories_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Memories Operations Delete
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Sandbox Environment Snapshots Operations Cancel
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Sandbox Environment Snapshots Operations Wait
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environment Snapshots Operations Delete
- `google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_operations_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environment Snapshots Operations Get
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_operations_delete` - DELETE /v1/{+name} - Reasoning Engines Sandbox Environment Templates Operations Delete
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_operations_get` - GET /v1/{+name} - Reasoning Engines Sandbox Environment Templates Operations Get
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_operations_cancel` - POST /v1/{+name}:cancel - Reasoning Engines Sandbox Environment Templates Operations Cancel
- `google_vertex_ai_reasoning_engines_sandbox_environment_templates_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Sandbox Environment Templates Operations Wait
- `google_vertex_ai_studies_trials_operations_list` - GET /v1/{+name}/operations - Studies Trials Operations List
- `google_vertex_ai_studies_trials_operations_cancel` - POST /v1/{+name}:cancel - Studies Trials Operations Cancel
- `google_vertex_ai_studies_trials_operations_wait` - POST /v1/{+name}:wait - Studies Trials Operations Wait
- `google_vertex_ai_studies_trials_operations_delete` - DELETE /v1/{+name} - Studies Trials Operations Delete
- `google_vertex_ai_studies_trials_operations_get` - GET /v1/{+name} - Studies Trials Operations Get
- `google_vertex_ai_models_evaluations_operations_cancel` - POST /v1/{+name}:cancel - Models Evaluations Operations Cancel
- `google_vertex_ai_models_evaluations_operations_wait` - POST /v1/{+name}:wait - Models Evaluations Operations Wait
- `google_vertex_ai_models_evaluations_operations_list` - GET /v1/{+name}/operations - Models Evaluations Operations List
- `google_vertex_ai_models_evaluations_operations_delete` - DELETE /v1/{+name} - Models Evaluations Operations Delete
- `google_vertex_ai_models_evaluations_operations_get` - GET /v1/{+name} - Models Evaluations Operations Get
- `google_vertex_ai_feature_groups_features_operations_list_wait` - GET /v1/{+name}:wait - Feature Groups Features Operations List Wait
- `google_vertex_ai_feature_groups_features_operations_wait` - POST /v1/{+name}:wait - Feature Groups Features Operations Wait
- `google_vertex_ai_feature_groups_features_operations_get` - GET /v1/{+name} - Feature Groups Features Operations Get
- `google_vertex_ai_feature_groups_features_operations_delete` - DELETE /v1/{+name} - Feature Groups Features Operations Delete
- `google_vertex_ai_projects_locations_operations_delete` - DELETE /v1/{+name} - Projects Locations Operations Delete
- `google_vertex_ai_projects_locations_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Operations Cancel
- `google_vertex_ai_projects_locations_operations_wait` - POST /v1/{+name}:wait - Projects Locations Operations Wait
- `google_vertex_ai_projects_locations_operations_list` - GET /v1/{+name}/operations - Projects Locations Operations List
- `google_vertex_ai_projects_locations_operations_get` - GET /v1/{+name} - Projects Locations Operations Get
- `google_vertex_ai_rag_corpora_rag_files_operations_get` - GET /v1/{+name} - Rag Corpora Rag Files Operations Get
- `google_vertex_ai_rag_corpora_rag_files_operations_list` - GET /v1/{+name}/operations - Rag Corpora Rag Files Operations List
- `google_vertex_ai_rag_corpora_rag_files_operations_cancel` - POST /v1/{+name}:cancel - Rag Corpora Rag Files Operations Cancel
- `google_vertex_ai_rag_corpora_rag_files_operations_wait` - POST /v1/{+name}:wait - Rag Corpora Rag Files Operations Wait
- `google_vertex_ai_rag_corpora_rag_files_operations_delete` - DELETE /v1/{+name} - Rag Corpora Rag Files Operations Delete
- `google_vertex_ai_tensorboards_experiments_operations_cancel` - POST /v1/{+name}:cancel - Tensorboards Experiments Operations Cancel
- `google_vertex_ai_tensorboards_experiments_operations_wait` - POST /v1/{+name}:wait - Tensorboards Experiments Operations Wait
- `google_vertex_ai_tensorboards_experiments_operations_list` - GET /v1/{+name}/operations - Tensorboards Experiments Operations List
- `google_vertex_ai_tensorboards_experiments_operations_delete` - DELETE /v1/{+name} - Tensorboards Experiments Operations Delete
- `google_vertex_ai_tensorboards_experiments_operations_get` - GET /v1/{+name} - Tensorboards Experiments Operations Get
- `google_vertex_ai_feature_online_stores_feature_views_operations_wait` - POST /v1/{+name}:wait - Feature Online Stores Feature Views Operations Wait
- `google_vertex_ai_feature_online_stores_feature_views_operations_list_wait` - GET /v1/{+name}:wait - Feature Online Stores Feature Views Operations List Wait
- `google_vertex_ai_feature_online_stores_feature_views_operations_delete` - DELETE /v1/{+name} - Feature Online Stores Feature Views Operations Delete
- `google_vertex_ai_feature_online_stores_feature_views_operations_get` - GET /v1/{+name} - Feature Online Stores Feature Views Operations Get
- `google_vertex_ai_datasets_saved_queries_operations_delete` - DELETE /v1/{+name} - Datasets Saved Queries Operations Delete
- `google_vertex_ai_datasets_saved_queries_operations_list` - GET /v1/{+name}/operations - Datasets Saved Queries Operations List
- `google_vertex_ai_datasets_saved_queries_operations_cancel` - POST /v1/{+name}:cancel - Datasets Saved Queries Operations Cancel
- `google_vertex_ai_datasets_saved_queries_operations_wait` - POST /v1/{+name}:wait - Datasets Saved Queries Operations Wait
- `google_vertex_ai_datasets_saved_queries_operations_get` - GET /v1/{+name} - Datasets Saved Queries Operations Get
- `google_vertex_ai_datasets_annotation_specs_operations_delete` - DELETE /v1/{+name} - Datasets Annotation Specs Operations Delete
- `google_vertex_ai_datasets_annotation_specs_operations_cancel` - POST /v1/{+name}:cancel - Datasets Annotation Specs Operations Cancel
- `google_vertex_ai_datasets_annotation_specs_operations_wait` - POST /v1/{+name}:wait - Datasets Annotation Specs Operations Wait
- `google_vertex_ai_datasets_annotation_specs_operations_list` - GET /v1/{+name}/operations - Datasets Annotation Specs Operations List
- `google_vertex_ai_datasets_annotation_specs_operations_get` - GET /v1/{+name} - Datasets Annotation Specs Operations Get
- `google_vertex_ai_datasets_data_items_operations_cancel` - POST /v1/{+name}:cancel - Datasets Data Items Operations Cancel
- `google_vertex_ai_datasets_data_items_operations_wait` - POST /v1/{+name}:wait - Datasets Data Items Operations Wait
- `google_vertex_ai_datasets_data_items_operations_list` - GET /v1/{+name}/operations - Datasets Data Items Operations List
- `google_vertex_ai_datasets_data_items_operations_delete` - DELETE /v1/{+name} - Datasets Data Items Operations Delete
- `google_vertex_ai_datasets_data_items_operations_get` - GET /v1/{+name} - Datasets Data Items Operations Get
- `google_vertex_ai_featurestores_entity_types_operations_delete` - DELETE /v1/{+name} - Featurestores Entity Types Operations Delete
- `google_vertex_ai_featurestores_entity_types_operations_cancel` - POST /v1/{+name}:cancel - Featurestores Entity Types Operations Cancel
- `google_vertex_ai_featurestores_entity_types_operations_wait` - POST /v1/{+name}:wait - Featurestores Entity Types Operations Wait
- `google_vertex_ai_featurestores_entity_types_operations_list` - GET /v1/{+name}/operations - Featurestores Entity Types Operations List
- `google_vertex_ai_featurestores_entity_types_operations_get` - GET /v1/{+name} - Featurestores Entity Types Operations Get
- `google_vertex_ai_metadata_stores_artifacts_operations_delete` - DELETE /v1/{+name} - Metadata Stores Artifacts Operations Delete
- `google_vertex_ai_metadata_stores_artifacts_operations_cancel` - POST /v1/{+name}:cancel - Metadata Stores Artifacts Operations Cancel
- `google_vertex_ai_metadata_stores_artifacts_operations_wait` - POST /v1/{+name}:wait - Metadata Stores Artifacts Operations Wait
- `google_vertex_ai_metadata_stores_artifacts_operations_list` - GET /v1/{+name}/operations - Metadata Stores Artifacts Operations List
- `google_vertex_ai_metadata_stores_artifacts_operations_get` - GET /v1/{+name} - Metadata Stores Artifacts Operations Get
- `google_vertex_ai_metadata_stores_contexts_operations_get` - GET /v1/{+name} - Metadata Stores Contexts Operations Get
- `google_vertex_ai_metadata_stores_contexts_operations_delete` - DELETE /v1/{+name} - Metadata Stores Contexts Operations Delete
- `google_vertex_ai_metadata_stores_contexts_operations_cancel` - POST /v1/{+name}:cancel - Metadata Stores Contexts Operations Cancel
- `google_vertex_ai_metadata_stores_contexts_operations_wait` - POST /v1/{+name}:wait - Metadata Stores Contexts Operations Wait
- `google_vertex_ai_metadata_stores_contexts_operations_list` - GET /v1/{+name}/operations - Metadata Stores Contexts Operations List
- `google_vertex_ai_metadata_stores_executions_operations_get` - GET /v1/{+name} - Metadata Stores Executions Operations Get
- `google_vertex_ai_metadata_stores_executions_operations_delete` - DELETE /v1/{+name} - Metadata Stores Executions Operations Delete
- `google_vertex_ai_metadata_stores_executions_operations_list` - GET /v1/{+name}/operations - Metadata Stores Executions Operations List
- `google_vertex_ai_metadata_stores_executions_operations_cancel` - POST /v1/{+name}:cancel - Metadata Stores Executions Operations Cancel
- `google_vertex_ai_metadata_stores_executions_operations_wait` - POST /v1/{+name}:wait - Metadata Stores Executions Operations Wait

## Patch

- `google_vertex_ai_reasoning_engines_patch` - PATCH /v1/{+name} - Reasoning Engines Patch
- `google_vertex_ai_datasets_patch` - PATCH /v1/{+name} - Datasets Patch
- `google_vertex_ai_datasets_dataset_versions_patch` - PATCH /v1/{+name} - Datasets Dataset Versions Patch

## Persistent Resources

- `google_vertex_ai_projects_locations_persistent_resources_delete` - DELETE /v1/{+name} - Projects Locations Persistent Resources Delete
- `google_vertex_ai_projects_locations_persistent_resources_create` - POST /v1/{+parent}/persistentResources - Projects Locations Persistent Resources Create
- `google_vertex_ai_projects_locations_persistent_resources_list` - GET /v1/{+parent}/persistentResources - Projects Locations Persistent Resources List
- `google_vertex_ai_projects_locations_persistent_resources_patch` - PATCH /v1/{+name} - Projects Locations Persistent Resources Patch
- `google_vertex_ai_projects_locations_persistent_resources_get` - GET /v1/{+name} - Projects Locations Persistent Resources Get
- `google_vertex_ai_projects_locations_persistent_resources_reboot` - POST /v1/{+name}:reboot - Projects Locations Persistent Resources Reboot
- `google_vertex_ai_projects_locations_persistent_resources_operations_delete` - DELETE /v1/{+name} - Projects Locations Persistent Resources Operations Delete
- `google_vertex_ai_projects_locations_persistent_resources_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Persistent Resources Operations Cancel
- `google_vertex_ai_projects_locations_persistent_resources_operations_wait` - POST /v1/{+name}:wait - Projects Locations Persistent Resources Operations Wait
- `google_vertex_ai_projects_locations_persistent_resources_operations_list` - GET /v1/{+name}/operations - Projects Locations Persistent Resources Operations List
- `google_vertex_ai_projects_locations_persistent_resources_operations_get` - GET /v1/{+name} - Projects Locations Persistent Resources Operations Get

## Pipeline Jobs

- `google_vertex_ai_projects_locations_pipeline_jobs_delete` - DELETE /v1/{+name} - Projects Locations Pipeline Jobs Delete
- `google_vertex_ai_projects_locations_pipeline_jobs_batch_delete` - POST /v1/{+parent}/pipelineJobs:batchDelete - Projects Locations Pipeline Jobs Batch Delete
- `google_vertex_ai_projects_locations_pipeline_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Pipeline Jobs Cancel
- `google_vertex_ai_projects_locations_pipeline_jobs_create` - POST /v1/{+parent}/pipelineJobs - Projects Locations Pipeline Jobs Create
- `google_vertex_ai_projects_locations_pipeline_jobs_list` - GET /v1/{+parent}/pipelineJobs - Projects Locations Pipeline Jobs List
- `google_vertex_ai_projects_locations_pipeline_jobs_batch_cancel` - POST /v1/{+parent}/pipelineJobs:batchCancel - Projects Locations Pipeline Jobs Batch Cancel
- `google_vertex_ai_projects_locations_pipeline_jobs_get` - GET /v1/{+name} - Projects Locations Pipeline Jobs Get
- `google_vertex_ai_projects_locations_pipeline_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Pipeline Jobs Operations Cancel
- `google_vertex_ai_projects_locations_pipeline_jobs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Pipeline Jobs Operations Wait
- `google_vertex_ai_projects_locations_pipeline_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Pipeline Jobs Operations List
- `google_vertex_ai_projects_locations_pipeline_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Pipeline Jobs Operations Delete
- `google_vertex_ai_projects_locations_pipeline_jobs_operations_get` - GET /v1/{+name} - Projects Locations Pipeline Jobs Operations Get

## Predict

- `google_vertex_ai_endpoints_predict` - POST /v1/{+endpoint}:predict - Endpoints Predict
- `google_vertex_ai_publishers_models_predict` - POST /v1/{+endpoint}:predict - Publishers Models Predict

## Predict Long Running

- `google_vertex_ai_endpoints_predict_long_running` - POST /v1/{+endpoint}:predictLongRunning - Endpoints Predict Long Running
- `google_vertex_ai_publishers_models_predict_long_running` - POST /v1/{+endpoint}:predictLongRunning - Publishers Models Predict Long Running

## Publishers

- `google_vertex_ai_projects_locations_publishers_models_stream_generate_content` - POST /v1/{+model}:streamGenerateContent - Projects Locations Publishers Models Stream Generate Content
- `google_vertex_ai_projects_locations_publishers_models_predict` - POST /v1/{+endpoint}:predict - Projects Locations Publishers Models Predict
- `google_vertex_ai_projects_locations_publishers_models_embed_content` - POST /v1/{+model}:embedContent - Projects Locations Publishers Models Embed Content
- `google_vertex_ai_projects_locations_publishers_models_stream_raw_predict` - POST /v1/{+endpoint}:streamRawPredict - Projects Locations Publishers Models Stream Raw Predict
- `google_vertex_ai_projects_locations_publishers_models_server_streaming_predict` - POST /v1/{+endpoint}:serverStreamingPredict - Projects Locations Publishers Models Server Streaming Predict
- `google_vertex_ai_projects_locations_publishers_models_predict_long_running` - POST /v1/{+endpoint}:predictLongRunning - Projects Locations Publishers Models Predict Long Running
- `google_vertex_ai_projects_locations_publishers_models_fetch_predict_operation` - POST /v1/{+endpoint}:fetchPredictOperation - Projects Locations Publishers Models Fetch Predict Operation
- `google_vertex_ai_projects_locations_publishers_models_compute_tokens` - POST /v1/{+endpoint}:computeTokens - Projects Locations Publishers Models Compute Tokens
- `google_vertex_ai_projects_locations_publishers_models_count_tokens` - POST /v1/{+endpoint}:countTokens - Projects Locations Publishers Models Count Tokens
- `google_vertex_ai_projects_locations_publishers_models_generate_content` - POST /v1/{+model}:generateContent - Projects Locations Publishers Models Generate Content
- `google_vertex_ai_projects_locations_publishers_models_raw_predict` - POST /v1/{+endpoint}:rawPredict - Projects Locations Publishers Models Raw Predict
- `google_vertex_ai_projects_locations_publishers_models_invoke_invoke` - POST /v1/{+endpoint}/invoke/{+invokeId} - Projects Locations Publishers Models Invoke Invoke

## Query

- `google_vertex_ai_reasoning_engines_query` - POST /v1/{+name}:query - Reasoning Engines Query
- `google_vertex_ai_reasoning_engines_runtime_revisions_query` - POST /v1/{+name}:query - Reasoning Engines Runtime Revisions Query

## Rag Corpora

- `google_vertex_ai_projects_locations_rag_corpora_create` - POST /v1/{+parent}/ragCorpora - Projects Locations Rag Corpora Create
- `google_vertex_ai_projects_locations_rag_corpora_patch` - PATCH /v1/{+name} - Projects Locations Rag Corpora Patch
- `google_vertex_ai_projects_locations_rag_corpora_list` - GET /v1/{+parent}/ragCorpora - Projects Locations Rag Corpora List
- `google_vertex_ai_projects_locations_rag_corpora_delete` - DELETE /v1/{+name} - Projects Locations Rag Corpora Delete
- `google_vertex_ai_projects_locations_rag_corpora_get` - GET /v1/{+name} - Projects Locations Rag Corpora Get
- `google_vertex_ai_projects_locations_rag_corpora_operations_get` - GET /v1/{+name} - Projects Locations Rag Corpora Operations Get
- `google_vertex_ai_projects_locations_rag_corpora_operations_list` - GET /v1/{+name}/operations - Projects Locations Rag Corpora Operations List
- `google_vertex_ai_projects_locations_rag_corpora_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Rag Corpora Operations Cancel
- `google_vertex_ai_projects_locations_rag_corpora_operations_wait` - POST /v1/{+name}:wait - Projects Locations Rag Corpora Operations Wait
- `google_vertex_ai_projects_locations_rag_corpora_operations_delete` - DELETE /v1/{+name} - Projects Locations Rag Corpora Operations Delete
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_get` - GET /v1/{+name} - Projects Locations Rag Corpora Rag Files Get
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_delete` - DELETE /v1/{+name} - Projects Locations Rag Corpora Rag Files Delete
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_import` - POST /v1/{+parent}/ragFiles:import - Projects Locations Rag Corpora Rag Files Import
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_list` - GET /v1/{+parent}/ragFiles - Projects Locations Rag Corpora Rag Files List
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_operations_list` - GET /v1/{+name}/operations - Projects Locations Rag Corpora Rag Files Operations List
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Rag Corpora Rag Files Operations Cancel
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_operations_wait` - POST /v1/{+name}:wait - Projects Locations Rag Corpora Rag Files Operations Wait
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_operations_delete` - DELETE /v1/{+name} - Projects Locations Rag Corpora Rag Files Operations Delete
- `google_vertex_ai_projects_locations_rag_corpora_rag_files_operations_get` - GET /v1/{+name} - Projects Locations Rag Corpora Rag Files Operations Get

## Rag Engine Config

- `google_vertex_ai_projects_locations_rag_engine_config_operations_list` - GET /v1/{+name}/operations - Projects Locations Rag Engine Config Operations List
- `google_vertex_ai_projects_locations_rag_engine_config_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Rag Engine Config Operations Cancel
- `google_vertex_ai_projects_locations_rag_engine_config_operations_wait` - POST /v1/{+name}:wait - Projects Locations Rag Engine Config Operations Wait
- `google_vertex_ai_projects_locations_rag_engine_config_operations_delete` - DELETE /v1/{+name} - Projects Locations Rag Engine Config Operations Delete
- `google_vertex_ai_projects_locations_rag_engine_config_operations_get` - GET /v1/{+name} - Projects Locations Rag Engine Config Operations Get

## Reasoning Engines

- `google_vertex_ai_projects_locations_reasoning_engines_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Locations Reasoning Engines Set Iam Policy
- `google_vertex_ai_projects_locations_reasoning_engines_execute_code` - POST /v1/{+name}:executeCode - Projects Locations Reasoning Engines Execute Code
- `google_vertex_ai_projects_locations_reasoning_engines_create` - POST /v1/{+parent}/reasoningEngines - Projects Locations Reasoning Engines Create
- `google_vertex_ai_projects_locations_reasoning_engines_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Get
- `google_vertex_ai_projects_locations_reasoning_engines_query` - POST /v1/{+name}:query - Projects Locations Reasoning Engines Query
- `google_vertex_ai_projects_locations_reasoning_engines_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Locations Reasoning Engines Test Iam Permissions
- `google_vertex_ai_projects_locations_reasoning_engines_stream_query` - POST /v1/{+name}:streamQuery - Projects Locations Reasoning Engines Stream Query
- `google_vertex_ai_projects_locations_reasoning_engines_async_query` - POST /v1/{+name}:asyncQuery - Projects Locations Reasoning Engines Async Query
- `google_vertex_ai_projects_locations_reasoning_engines_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Delete
- `google_vertex_ai_projects_locations_reasoning_engines_get_iam_policy` - POST /v1/{+resource}:getIamPolicy - Projects Locations Reasoning Engines Get Iam Policy
- `google_vertex_ai_projects_locations_reasoning_engines_list` - GET /v1/{+parent}/reasoningEngines - Projects Locations Reasoning Engines List
- `google_vertex_ai_projects_locations_reasoning_engines_patch` - PATCH /v1/{+name} - Projects Locations Reasoning Engines Patch
- `google_vertex_ai_projects_locations_reasoning_engines_memories_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Memories Delete
- `google_vertex_ai_projects_locations_reasoning_engines_memories_patch` - PATCH /v1/{+name} - Projects Locations Reasoning Engines Memories Patch
- `google_vertex_ai_projects_locations_reasoning_engines_memories_list` - GET /v1/{+parent}/memories - Projects Locations Reasoning Engines Memories List
- `google_vertex_ai_projects_locations_reasoning_engines_memories_generate` - POST /v1/{+parent}/memories:generate - Projects Locations Reasoning Engines Memories Generate
- `google_vertex_ai_projects_locations_reasoning_engines_memories_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Memories Get
- `google_vertex_ai_projects_locations_reasoning_engines_memories_create` - POST /v1/{+parent}/memories - Projects Locations Reasoning Engines Memories Create
- `google_vertex_ai_projects_locations_reasoning_engines_memories_retrieve` - POST /v1/{+parent}/memories:retrieve - Projects Locations Reasoning Engines Memories Retrieve
- `google_vertex_ai_projects_locations_reasoning_engines_memories_purge` - POST /v1/{+parent}/memories:purge - Projects Locations Reasoning Engines Memories Purge
- `google_vertex_ai_projects_locations_reasoning_engines_memories_rollback` - POST /v1/{+name}:rollback - Projects Locations Reasoning Engines Memories Rollback
- `google_vertex_ai_projects_locations_reasoning_engines_memories_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Memories Operations Get
- `google_vertex_ai_projects_locations_reasoning_engines_memories_operations_list` - GET /v1/{+name}/operations - Projects Locations Reasoning Engines Memories Operations List
- `google_vertex_ai_projects_locations_reasoning_engines_memories_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Memories Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_memories_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Memories Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_memories_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Memories Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_memories_revisions_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Memories Revisions Get
- `google_vertex_ai_projects_locations_reasoning_engines_memories_revisions_list` - GET /v1/{+parent}/revisions - Projects Locations Reasoning Engines Memories Revisions List
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_list` - GET /v1/{+parent}/sandboxEnvironmentSnapshots - Projects Locations Reasoning Engines Sandbox Environment Snapshots List
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Snapshots Get
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Snapshots Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Sandbox Environment Snapshots Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Sandbox Environment Snapshots Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Snapshots Operations Get
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_snapshots_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Snapshots Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_create` - POST /v1/{+parent}/sandboxEnvironmentTemplates - Projects Locations Reasoning Engines Sandbox Environment Templates Create
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_list` - GET /v1/{+parent}/sandboxEnvironmentTemplates - Projects Locations Reasoning Engines Sandbox Environment Templates List
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Templates Get
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Templates Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Templates Operations Get
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environment Templates Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Sandbox Environment Templates Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environment_templates_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Sandbox Environment Templates Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sessions Get
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sessions Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_append_event` - POST /v1/{+name}:appendEvent - Projects Locations Reasoning Engines Sessions Append Event
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_create` - POST /v1/{+parent}/sessions - Projects Locations Reasoning Engines Sessions Create
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_list` - GET /v1/{+parent}/sessions - Projects Locations Reasoning Engines Sessions List
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_patch` - PATCH /v1/{+name} - Projects Locations Reasoning Engines Sessions Patch
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sessions Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_operations_list` - GET /v1/{+name}/operations - Projects Locations Reasoning Engines Sessions Operations List
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Sessions Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Sessions Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sessions Operations Get
- `google_vertex_ai_projects_locations_reasoning_engines_sessions_events_list` - GET /v1/{+parent}/events - Projects Locations Reasoning Engines Sessions Events List
- `google_vertex_ai_projects_locations_reasoning_engines_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_operations_list` - GET /v1/{+name}/operations - Projects Locations Reasoning Engines Operations List
- `google_vertex_ai_projects_locations_reasoning_engines_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Operations Get
- `google_vertex_ai_projects_locations_reasoning_engines_runtime_revisions_stream_query` - POST /v1/{+name}:streamQuery - Projects Locations Reasoning Engines Runtime Revisions Stream Query
- `google_vertex_ai_projects_locations_reasoning_engines_runtime_revisions_query` - POST /v1/{+name}:query - Projects Locations Reasoning Engines Runtime Revisions Query
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_snapshot` - POST /v1/{+name}:snapshot - Projects Locations Reasoning Engines Sandbox Environments Snapshot
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environments Get
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_create` - POST /v1/{+parent}/sandboxEnvironments - Projects Locations Reasoning Engines Sandbox Environments Create
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_list` - GET /v1/{+parent}/sandboxEnvironments - Projects Locations Reasoning Engines Sandbox Environments List
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_execute` - POST /v1/{+name}:execute - Projects Locations Reasoning Engines Sandbox Environments Execute
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environments Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Reasoning Engines Sandbox Environments Operations Cancel
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_operations_wait` - POST /v1/{+name}:wait - Projects Locations Reasoning Engines Sandbox Environments Operations Wait
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_operations_delete` - DELETE /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environments Operations Delete
- `google_vertex_ai_projects_locations_reasoning_engines_sandbox_environments_operations_get` - GET /v1/{+name} - Projects Locations Reasoning Engines Sandbox Environments Operations Get

## Restore

- `google_vertex_ai_datasets_dataset_versions_restore` - GET /v1/{+name}:restore - Datasets Dataset Versions Restore

## Retrieve Contexts

- `google_vertex_ai_projects_locations_retrieve_contexts` - POST /v1/{+parent}:retrieveContexts - Projects Locations Retrieve Contexts

## Runs

- `google_vertex_ai_tensorboards_experiments_runs_operations_delete` - DELETE /v1/{+name} - Tensorboards Experiments Runs Operations Delete
- `google_vertex_ai_tensorboards_experiments_runs_operations_cancel` - POST /v1/{+name}:cancel - Tensorboards Experiments Runs Operations Cancel
- `google_vertex_ai_tensorboards_experiments_runs_operations_wait` - POST /v1/{+name}:wait - Tensorboards Experiments Runs Operations Wait
- `google_vertex_ai_tensorboards_experiments_runs_operations_list` - GET /v1/{+name}/operations - Tensorboards Experiments Runs Operations List
- `google_vertex_ai_tensorboards_experiments_runs_operations_get` - GET /v1/{+name} - Tensorboards Experiments Runs Operations Get
- `google_vertex_ai_tensorboards_experiments_runs_time_series_operations_delete` - DELETE /v1/{+name} - Tensorboards Experiments Runs Time Series Operations Delete
- `google_vertex_ai_tensorboards_experiments_runs_time_series_operations_cancel` - POST /v1/{+name}:cancel - Tensorboards Experiments Runs Time Series Operations Cancel
- `google_vertex_ai_tensorboards_experiments_runs_time_series_operations_wait` - POST /v1/{+name}:wait - Tensorboards Experiments Runs Time Series Operations Wait
- `google_vertex_ai_tensorboards_experiments_runs_time_series_operations_list` - GET /v1/{+name}/operations - Tensorboards Experiments Runs Time Series Operations List
- `google_vertex_ai_tensorboards_experiments_runs_time_series_operations_get` - GET /v1/{+name} - Tensorboards Experiments Runs Time Series Operations Get

## Schedules

- `google_vertex_ai_projects_locations_schedules_create` - POST /v1/{+parent}/schedules - Projects Locations Schedules Create
- `google_vertex_ai_projects_locations_schedules_list` - GET /v1/{+parent}/schedules - Projects Locations Schedules List
- `google_vertex_ai_projects_locations_schedules_patch` - PATCH /v1/{+name} - Projects Locations Schedules Patch
- `google_vertex_ai_projects_locations_schedules_delete` - DELETE /v1/{+name} - Projects Locations Schedules Delete
- `google_vertex_ai_projects_locations_schedules_resume` - POST /v1/{+name}:resume - Projects Locations Schedules Resume
- `google_vertex_ai_projects_locations_schedules_pause` - POST /v1/{+name}:pause - Projects Locations Schedules Pause
- `google_vertex_ai_projects_locations_schedules_get` - GET /v1/{+name} - Projects Locations Schedules Get
- `google_vertex_ai_projects_locations_schedules_operations_delete` - DELETE /v1/{+name} - Projects Locations Schedules Operations Delete
- `google_vertex_ai_projects_locations_schedules_operations_list` - GET /v1/{+name}/operations - Projects Locations Schedules Operations List
- `google_vertex_ai_projects_locations_schedules_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Schedules Operations Cancel
- `google_vertex_ai_projects_locations_schedules_operations_wait` - POST /v1/{+name}:wait - Projects Locations Schedules Operations Wait
- `google_vertex_ai_projects_locations_schedules_operations_get` - GET /v1/{+name} - Projects Locations Schedules Operations Get

## Skills

- `google_vertex_ai_projects_locations_skills_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Skills Operations Cancel
- `google_vertex_ai_projects_locations_skills_operations_wait` - POST /v1/{+name}:wait - Projects Locations Skills Operations Wait
- `google_vertex_ai_projects_locations_skills_operations_list` - GET /v1/{+name}/operations - Projects Locations Skills Operations List
- `google_vertex_ai_projects_locations_skills_operations_delete` - DELETE /v1/{+name} - Projects Locations Skills Operations Delete
- `google_vertex_ai_projects_locations_skills_operations_get` - GET /v1/{+name} - Projects Locations Skills Operations Get

## Snapshot

- `google_vertex_ai_reasoning_engines_sandbox_environments_snapshot` - POST /v1/{+name}:snapshot - Reasoning Engines Sandbox Environments Snapshot

## Specialist Pools

- `google_vertex_ai_projects_locations_specialist_pools_get` - GET /v1/{+name} - Projects Locations Specialist Pools Get
- `google_vertex_ai_projects_locations_specialist_pools_delete` - DELETE /v1/{+name} - Projects Locations Specialist Pools Delete
- `google_vertex_ai_projects_locations_specialist_pools_create` - POST /v1/{+parent}/specialistPools - Projects Locations Specialist Pools Create
- `google_vertex_ai_projects_locations_specialist_pools_list` - GET /v1/{+parent}/specialistPools - Projects Locations Specialist Pools List
- `google_vertex_ai_projects_locations_specialist_pools_patch` - PATCH /v1/{+name} - Projects Locations Specialist Pools Patch
- `google_vertex_ai_projects_locations_specialist_pools_operations_delete` - DELETE /v1/{+name} - Projects Locations Specialist Pools Operations Delete
- `google_vertex_ai_projects_locations_specialist_pools_operations_list` - GET /v1/{+name}/operations - Projects Locations Specialist Pools Operations List
- `google_vertex_ai_projects_locations_specialist_pools_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Specialist Pools Operations Cancel
- `google_vertex_ai_projects_locations_specialist_pools_operations_wait` - POST /v1/{+name}:wait - Projects Locations Specialist Pools Operations Wait
- `google_vertex_ai_projects_locations_specialist_pools_operations_get` - GET /v1/{+name} - Projects Locations Specialist Pools Operations Get

## Stream Generate Content

- `google_vertex_ai_endpoints_stream_generate_content` - POST /v1/{+model}:streamGenerateContent - Endpoints Stream Generate Content
- `google_vertex_ai_publishers_models_stream_generate_content` - POST /v1/{+model}:streamGenerateContent - Publishers Models Stream Generate Content

## Stream Query

- `google_vertex_ai_reasoning_engines_stream_query` - POST /v1/{+name}:streamQuery - Reasoning Engines Stream Query
- `google_vertex_ai_reasoning_engines_runtime_revisions_stream_query` - POST /v1/{+name}:streamQuery - Reasoning Engines Runtime Revisions Stream Query

## Studies

- `google_vertex_ai_projects_locations_studies_delete` - DELETE /v1/{+name} - Projects Locations Studies Delete
- `google_vertex_ai_projects_locations_studies_create` - POST /v1/{+parent}/studies - Projects Locations Studies Create
- `google_vertex_ai_projects_locations_studies_list` - GET /v1/{+parent}/studies - Projects Locations Studies List
- `google_vertex_ai_projects_locations_studies_lookup` - POST /v1/{+parent}/studies:lookup - Projects Locations Studies Lookup
- `google_vertex_ai_projects_locations_studies_get` - GET /v1/{+name} - Projects Locations Studies Get
- `google_vertex_ai_projects_locations_studies_operations_get` - GET /v1/{+name} - Projects Locations Studies Operations Get
- `google_vertex_ai_projects_locations_studies_operations_delete` - DELETE /v1/{+name} - Projects Locations Studies Operations Delete
- `google_vertex_ai_projects_locations_studies_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Studies Operations Cancel
- `google_vertex_ai_projects_locations_studies_operations_wait` - POST /v1/{+name}:wait - Projects Locations Studies Operations Wait
- `google_vertex_ai_projects_locations_studies_operations_list` - GET /v1/{+name}/operations - Projects Locations Studies Operations List
- `google_vertex_ai_projects_locations_studies_trials_suggest` - POST /v1/{+parent}/trials:suggest - Projects Locations Studies Trials Suggest
- `google_vertex_ai_projects_locations_studies_trials_get` - GET /v1/{+name} - Projects Locations Studies Trials Get
- `google_vertex_ai_projects_locations_studies_trials_stop` - POST /v1/{+name}:stop - Projects Locations Studies Trials Stop
- `google_vertex_ai_projects_locations_studies_trials_add_trial_measurement` - POST /v1/{+trialName}:addTrialMeasurement - Projects Locations Studies Trials Add Trial Measurement
- `google_vertex_ai_projects_locations_studies_trials_delete` - DELETE /v1/{+name} - Projects Locations Studies Trials Delete
- `google_vertex_ai_projects_locations_studies_trials_list` - GET /v1/{+parent}/trials - Projects Locations Studies Trials List
- `google_vertex_ai_projects_locations_studies_trials_list_optimal_trials` - POST /v1/{+parent}/trials:listOptimalTrials - Projects Locations Studies Trials List Optimal Trials
- `google_vertex_ai_projects_locations_studies_trials_check_trial_early_stopping_state` - POST /v1/{+trialName}:checkTrialEarlyStoppingState - Projects Locations Studies Trials Check Trial Early Stopping State
- `google_vertex_ai_projects_locations_studies_trials_create` - POST /v1/{+parent}/trials - Projects Locations Studies Trials Create
- `google_vertex_ai_projects_locations_studies_trials_complete` - POST /v1/{+name}:complete - Projects Locations Studies Trials Complete
- `google_vertex_ai_projects_locations_studies_trials_operations_get` - GET /v1/{+name} - Projects Locations Studies Trials Operations Get
- `google_vertex_ai_projects_locations_studies_trials_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Studies Trials Operations Cancel
- `google_vertex_ai_projects_locations_studies_trials_operations_wait` - POST /v1/{+name}:wait - Projects Locations Studies Trials Operations Wait
- `google_vertex_ai_projects_locations_studies_trials_operations_list` - GET /v1/{+name}/operations - Projects Locations Studies Trials Operations List
- `google_vertex_ai_projects_locations_studies_trials_operations_delete` - DELETE /v1/{+name} - Projects Locations Studies Trials Operations Delete

## Tensorboards

- `google_vertex_ai_projects_locations_tensorboards_get` - GET /v1/{+name} - Projects Locations Tensorboards Get
- `google_vertex_ai_projects_locations_tensorboards_read_size` - GET /v1/{+tensorboard}:readSize - Projects Locations Tensorboards Read Size
- `google_vertex_ai_projects_locations_tensorboards_batch_read` - GET /v1/{+tensorboard}:batchRead - Projects Locations Tensorboards Batch Read
- `google_vertex_ai_projects_locations_tensorboards_create` - POST /v1/{+parent}/tensorboards - Projects Locations Tensorboards Create
- `google_vertex_ai_projects_locations_tensorboards_patch` - PATCH /v1/{+name} - Projects Locations Tensorboards Patch
- `google_vertex_ai_projects_locations_tensorboards_list` - GET /v1/{+parent}/tensorboards - Projects Locations Tensorboards List
- `google_vertex_ai_projects_locations_tensorboards_read_usage` - GET /v1/{+tensorboard}:readUsage - Projects Locations Tensorboards Read Usage
- `google_vertex_ai_projects_locations_tensorboards_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_create` - POST /v1/{+parent}/experiments - Projects Locations Tensorboards Experiments Create
- `google_vertex_ai_projects_locations_tensorboards_experiments_patch` - PATCH /v1/{+name} - Projects Locations Tensorboards Experiments Patch
- `google_vertex_ai_projects_locations_tensorboards_experiments_list` - GET /v1/{+parent}/experiments - Projects Locations Tensorboards Experiments List
- `google_vertex_ai_projects_locations_tensorboards_experiments_batch_create` - POST /v1/{+parent}:batchCreate - Projects Locations Tensorboards Experiments Batch Create
- `google_vertex_ai_projects_locations_tensorboards_experiments_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_write` - POST /v1/{+tensorboardExperiment}:write - Projects Locations Tensorboards Experiments Write
- `google_vertex_ai_projects_locations_tensorboards_experiments_operations_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Operations Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Tensorboards Experiments Operations Cancel
- `google_vertex_ai_projects_locations_tensorboards_experiments_operations_wait` - POST /v1/{+name}:wait - Projects Locations Tensorboards Experiments Operations Wait
- `google_vertex_ai_projects_locations_tensorboards_experiments_operations_list` - GET /v1/{+name}/operations - Projects Locations Tensorboards Experiments Operations List
- `google_vertex_ai_projects_locations_tensorboards_experiments_operations_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Operations Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_batch_create` - POST /v1/{+parent}/runs:batchCreate - Projects Locations Tensorboards Experiments Runs Batch Create
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_create` - POST /v1/{+parent}/runs - Projects Locations Tensorboards Experiments Runs Create
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_patch` - PATCH /v1/{+name} - Projects Locations Tensorboards Experiments Runs Patch
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_list` - GET /v1/{+parent}/runs - Projects Locations Tensorboards Experiments Runs List
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Runs Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Runs Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_write` - POST /v1/{+tensorboardRun}:write - Projects Locations Tensorboards Experiments Runs Write
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_operations_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Runs Operations Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Tensorboards Experiments Runs Operations Cancel
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_operations_wait` - POST /v1/{+name}:wait - Projects Locations Tensorboards Experiments Runs Operations Wait
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_operations_list` - GET /v1/{+name}/operations - Projects Locations Tensorboards Experiments Runs Operations List
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_operations_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Runs Operations Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_export_tensorboard_time_series` - POST /v1/{+tensorboardTimeSeries}:exportTensorboardTimeSeries - Projects Locations Tensorboards Experiments Runs Time Series Export Tensorboard Time Series
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Runs Time Series Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_read` - GET /v1/{+tensorboardTimeSeries}:read - Projects Locations Tensorboards Experiments Runs Time Series Read
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_create` - POST /v1/{+parent}/timeSeries - Projects Locations Tensorboards Experiments Runs Time Series Create
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_patch` - PATCH /v1/{+name} - Projects Locations Tensorboards Experiments Runs Time Series Patch
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_list` - GET /v1/{+parent}/timeSeries - Projects Locations Tensorboards Experiments Runs Time Series List
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Runs Time Series Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_read_blob_data` - GET /v1/{+timeSeries}:readBlobData - Projects Locations Tensorboards Experiments Runs Time Series Read Blob Data
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_get` - GET /v1/{+name} - Projects Locations Tensorboards Experiments Runs Time Series Operations Get
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Experiments Runs Time Series Operations Delete
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_list` - GET /v1/{+name}/operations - Projects Locations Tensorboards Experiments Runs Time Series Operations List
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Tensorboards Experiments Runs Time Series Operations Cancel
- `google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_wait` - POST /v1/{+name}:wait - Projects Locations Tensorboards Experiments Runs Time Series Operations Wait
- `google_vertex_ai_projects_locations_tensorboards_operations_delete` - DELETE /v1/{+name} - Projects Locations Tensorboards Operations Delete
- `google_vertex_ai_projects_locations_tensorboards_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Tensorboards Operations Cancel
- `google_vertex_ai_projects_locations_tensorboards_operations_wait` - POST /v1/{+name}:wait - Projects Locations Tensorboards Operations Wait
- `google_vertex_ai_projects_locations_tensorboards_operations_list` - GET /v1/{+name}/operations - Projects Locations Tensorboards Operations List
- `google_vertex_ai_projects_locations_tensorboards_operations_get` - GET /v1/{+name} - Projects Locations Tensorboards Operations Get

## Training Pipelines

- `google_vertex_ai_projects_locations_training_pipelines_cancel` - POST /v1/{+name}:cancel - Projects Locations Training Pipelines Cancel
- `google_vertex_ai_projects_locations_training_pipelines_create` - POST /v1/{+parent}/trainingPipelines - Projects Locations Training Pipelines Create
- `google_vertex_ai_projects_locations_training_pipelines_list` - GET /v1/{+parent}/trainingPipelines - Projects Locations Training Pipelines List
- `google_vertex_ai_projects_locations_training_pipelines_delete` - DELETE /v1/{+name} - Projects Locations Training Pipelines Delete
- `google_vertex_ai_projects_locations_training_pipelines_get` - GET /v1/{+name} - Projects Locations Training Pipelines Get
- `google_vertex_ai_projects_locations_training_pipelines_operations_get` - GET /v1/{+name} - Projects Locations Training Pipelines Operations Get
- `google_vertex_ai_projects_locations_training_pipelines_operations_list` - GET /v1/{+name}/operations - Projects Locations Training Pipelines Operations List
- `google_vertex_ai_projects_locations_training_pipelines_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Training Pipelines Operations Cancel
- `google_vertex_ai_projects_locations_training_pipelines_operations_wait` - POST /v1/{+name}:wait - Projects Locations Training Pipelines Operations Wait
- `google_vertex_ai_projects_locations_training_pipelines_operations_delete` - DELETE /v1/{+name} - Projects Locations Training Pipelines Operations Delete

## Tuning Jobs

- `google_vertex_ai_projects_locations_tuning_jobs_create` - POST /v1/{+parent}/tuningJobs - Projects Locations Tuning Jobs Create
- `google_vertex_ai_projects_locations_tuning_jobs_list` - GET /v1/{+parent}/tuningJobs - Projects Locations Tuning Jobs List
- `google_vertex_ai_projects_locations_tuning_jobs_rebase_tuned_model` - POST /v1/{+parent}/tuningJobs:rebaseTunedModel - Projects Locations Tuning Jobs Rebase Tuned Model
- `google_vertex_ai_projects_locations_tuning_jobs_cancel` - POST /v1/{+name}:cancel - Projects Locations Tuning Jobs Cancel
- `google_vertex_ai_projects_locations_tuning_jobs_get` - GET /v1/{+name} - Projects Locations Tuning Jobs Get
- `google_vertex_ai_projects_locations_tuning_jobs_operations_cancel` - POST /v1/{+name}:cancel - Projects Locations Tuning Jobs Operations Cancel
- `google_vertex_ai_projects_locations_tuning_jobs_operations_list` - GET /v1/{+name}/operations - Projects Locations Tuning Jobs Operations List
- `google_vertex_ai_projects_locations_tuning_jobs_operations_delete` - DELETE /v1/{+name} - Projects Locations Tuning Jobs Operations Delete
- `google_vertex_ai_projects_locations_tuning_jobs_operations_get` - GET /v1/{+name} - Projects Locations Tuning Jobs Operations Get

## Update Cache Config

- `google_vertex_ai_projects_update_cache_config` - PATCH /v1/{+name} - Projects Update Cache Config

## Update Rag Engine Config

- `google_vertex_ai_projects_locations_update_rag_engine_config` - PATCH /v1/{+name} - Projects Locations Update Rag Engine Config

## Upload

- `google_vertex_ai_media_upload` - POST /v1/{+parent}/ragFiles:upload - Media Upload

## Wait

- `google_vertex_ai_reasoning_engines_operations_wait` - POST /v1/{+name}:wait - Reasoning Engines Operations Wait
- `google_vertex_ai_schedules_operations_wait` - POST /v1/{+name}:wait - Schedules Operations Wait
- `google_vertex_ai_custom_jobs_operations_wait` - POST /v1/{+name}:wait - Custom Jobs Operations Wait
- `google_vertex_ai_studies_operations_wait` - POST /v1/{+name}:wait - Studies Operations Wait
- `google_vertex_ai_data_labeling_jobs_operations_wait` - POST /v1/{+name}:wait - Data Labeling Jobs Operations Wait
- `google_vertex_ai_migratable_resources_operations_wait` - POST /v1/{+name}:wait - Migratable Resources Operations Wait
- `google_vertex_ai_notebook_runtimes_operations_wait` - POST /v1/{+name}:wait - Notebook Runtimes Operations Wait
- `google_vertex_ai_model_deployment_monitoring_jobs_operations_wait` - POST /v1/{+name}:wait - Model Deployment Monitoring Jobs Operations Wait
- `google_vertex_ai_operations_wait` - POST /v1/{+name}:wait - Operations Wait
- `google_vertex_ai_models_operations_wait` - POST /v1/{+name}:wait - Models Operations Wait
- `google_vertex_ai_notebook_runtime_templates_operations_wait` - POST /v1/{+name}:wait - Notebook Runtime Templates Operations Wait
- `google_vertex_ai_feature_groups_operations_wait` - POST /v1/{+name}:wait - Feature Groups Operations Wait
- `google_vertex_ai_deployment_resource_pools_operations_wait` - POST /v1/{+name}:wait - Deployment Resource Pools Operations Wait
- `google_vertex_ai_specialist_pools_operations_wait` - POST /v1/{+name}:wait - Specialist Pools Operations Wait
- `google_vertex_ai_persistent_resources_operations_wait` - POST /v1/{+name}:wait - Persistent Resources Operations Wait
- `google_vertex_ai_index_endpoints_operations_wait` - POST /v1/{+name}:wait - Index Endpoints Operations Wait
- `google_vertex_ai_hyperparameter_tuning_jobs_operations_wait` - POST /v1/{+name}:wait - Hyperparameter Tuning Jobs Operations Wait
- `google_vertex_ai_indexes_operations_wait` - POST /v1/{+name}:wait - Indexes Operations Wait
- `google_vertex_ai_training_pipelines_operations_wait` - POST /v1/{+name}:wait - Training Pipelines Operations Wait
- `google_vertex_ai_skills_operations_wait` - POST /v1/{+name}:wait - Skills Operations Wait
- `google_vertex_ai_endpoints_operations_wait` - POST /v1/{+name}:wait - Endpoints Operations Wait
- `google_vertex_ai_pipeline_jobs_operations_wait` - POST /v1/{+name}:wait - Pipeline Jobs Operations Wait
- `google_vertex_ai_rag_corpora_operations_wait` - POST /v1/{+name}:wait - Rag Corpora Operations Wait
- `google_vertex_ai_tensorboards_operations_wait` - POST /v1/{+name}:wait - Tensorboards Operations Wait
- `google_vertex_ai_notebook_execution_jobs_operations_wait` - POST /v1/{+name}:wait - Notebook Execution Jobs Operations Wait
- `google_vertex_ai_rag_engine_config_operations_wait` - POST /v1/{+name}:wait - Rag Engine Config Operations Wait
- `google_vertex_ai_feature_online_stores_operations_wait` - POST /v1/{+name}:wait - Feature Online Stores Operations Wait
- `google_vertex_ai_datasets_operations_wait` - POST /v1/{+name}:wait - Datasets Operations Wait
- `google_vertex_ai_featurestores_operations_wait` - POST /v1/{+name}:wait - Featurestores Operations Wait
- `google_vertex_ai_metadata_stores_operations_wait` - POST /v1/{+name}:wait - Metadata Stores Operations Wait
