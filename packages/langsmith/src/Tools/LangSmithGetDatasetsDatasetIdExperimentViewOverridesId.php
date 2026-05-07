<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get experiment view override configuration by specific ID.
 *
 * Maps to the official LangSmith endpoint GET /datasets/{dataset_id}/experiment-view-overrides/{id}.
 */
class LangSmithGetDatasetsDatasetIdExperimentViewOverridesId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_datasets_dataset_id_experiment_view_overrides_id';
    protected const DESCRIPTION = 'Get experiment view override configuration by specific ID

Official endpoint: GET /datasets/{dataset_id}/experiment-view-overrides/{id}
Retrieves a specific experiment view override configuration using both dataset ID and override ID. This endpoint provides more precise access to experiment view overrides when you have the specific override ID, useful for direct links or cached references. The response includes the same column override information as the dataset-level endpoint: - Column identifiers with validation prefixes - Color gradient setting...';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/datasets/{dataset_id}/experiment-view-overrides/{id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
  1 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
