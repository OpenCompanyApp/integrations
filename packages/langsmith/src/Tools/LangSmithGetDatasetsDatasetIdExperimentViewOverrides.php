<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get experiment view override configurations for a dataset.
 *
 * Maps to the official LangSmith endpoint GET /datasets/{dataset_id}/experiment-view-overrides.
 */
class LangSmithGetDatasetsDatasetIdExperimentViewOverrides extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_datasets_dataset_id_experiment_view_overrides';
    protected const DESCRIPTION = 'Get experiment view override configurations for a dataset

Official endpoint: GET /datasets/{dataset_id}/experiment-view-overrides
Retrieves all experiment view override configurations for a specific dataset. This endpoint returns column display overrides including color gradients, precision settings, and column visibility configurations that customize how experiment results are displayed in the UI. The response includes all column overrides with their display settings: - Column identifiers (must start with inputs, outputs, reference_outputs,...';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/datasets/{dataset_id}/experiment-view-overrides';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
