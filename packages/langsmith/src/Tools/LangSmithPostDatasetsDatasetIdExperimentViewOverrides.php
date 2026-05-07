<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create new experiment view override configuration for a dataset.
 *
 * Maps to the official LangSmith endpoint POST /datasets/{dataset_id}/experiment-view-overrides.
 */
class LangSmithPostDatasetsDatasetIdExperimentViewOverrides extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_datasets_dataset_id_experiment_view_overrides';
    protected const DESCRIPTION = 'Create new experiment view override configuration for a dataset

Official endpoint: POST /datasets/{dataset_id}/experiment-view-overrides
Creates a new experiment view override configuration for a dataset with column display settings. This endpoint allows you to customize how experiment results are displayed by configuring column-specific overrides including colors, precision, and visibility. The request must include a \'column_overrides\' array with at least one override configuration. Each column override can specify: - column: Required field name (...';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/datasets/{dataset_id}/experiment-view-overrides';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
