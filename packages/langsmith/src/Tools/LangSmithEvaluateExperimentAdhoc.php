<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Evaluate Experiment Adhoc.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/experiments/{experiment_id}/evaluate.
 */
class LangSmithEvaluateExperimentAdhoc extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_evaluate_experiment_adhoc';
    protected const DESCRIPTION = 'Evaluate Experiment Adhoc

Official endpoint: POST /api/v1/runs/experiments/{experiment_id}/evaluate
Evaluate an existing experiment with a specific evaluator. This triggers immediate evaluation using the run_over_dataset approach, processing runs in batches to handle large experiments efficiently.';
    protected const PARAMETERS = array (
  'experiment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `experiment_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/experiments/{experiment_id}/evaluate';
    protected const PATH_PARAMS = array (
  0 => 'experiment_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
