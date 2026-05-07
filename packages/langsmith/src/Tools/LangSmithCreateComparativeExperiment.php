<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Comparative Experiment.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/comparative.
 */
class LangSmithCreateComparativeExperiment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_comparative_experiment';
    protected const DESCRIPTION = 'Create Comparative Experiment

Official endpoint: POST /api/v1/datasets/comparative
Create a comparative experiment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/comparative';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
