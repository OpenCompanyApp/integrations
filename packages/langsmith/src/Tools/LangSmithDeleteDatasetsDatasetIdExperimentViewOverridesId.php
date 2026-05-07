<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete experiment view override configuration.
 *
 * Maps to the official LangSmith endpoint DELETE /datasets/{dataset_id}/experiment-view-overrides/{id}.
 */
class LangSmithDeleteDatasetsDatasetIdExperimentViewOverridesId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_datasets_dataset_id_experiment_view_overrides_id';
    protected const DESCRIPTION = 'Delete experiment view override configuration

Official endpoint: DELETE /datasets/{dataset_id}/experiment-view-overrides/{id}
Permanently deletes an experiment view override configuration for a dataset. This operation removes all column override settings including color gradients, precision configurations, and visibility settings. After deletion, the experiment view will revert to default column display settings. This action cannot be undone - you will need to recreate the override configuration if you want to restore custom column setti...';
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
    protected const METHOD = 'DELETE';
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
