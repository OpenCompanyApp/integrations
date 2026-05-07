<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update existing experiment view override configuration.
 *
 * Maps to the official LangSmith endpoint PATCH /datasets/{dataset_id}/experiment-view-overrides/{id}.
 */
class LangSmithPatchDatasetsDatasetIdExperimentViewOverridesId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_datasets_dataset_id_experiment_view_overrides_id';
    protected const DESCRIPTION = 'Update existing experiment view override configuration

Official endpoint: PATCH /datasets/{dataset_id}/experiment-view-overrides/{id}
Updates an existing experiment view override configuration by completely replacing the column overrides for the specified dataset and override ID. This endpoint performs a complete replacement of the column overrides configuration. All existing column overrides will be replaced with the new configuration provided in the request body. To add or modify individual columns, include the complete desired configuration i...';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/datasets/{dataset_id}/experiment-view-overrides/{id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
  1 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
