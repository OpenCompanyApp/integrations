<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Comparative Experiment.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/datasets/comparative/{comparative_experiment_id}.
 */
class LangSmithDeleteComparativeExperiment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_comparative_experiment';
    protected const DESCRIPTION = 'Delete Comparative Experiment

Official endpoint: DELETE /api/v1/datasets/comparative/{comparative_experiment_id}
Delete a specific comparative experiment.';
    protected const PARAMETERS = array (
  'comparative_experiment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `comparative_experiment_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/datasets/comparative/{comparative_experiment_id}';
    protected const PATH_PARAMS = array (
  0 => 'comparative_experiment_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
