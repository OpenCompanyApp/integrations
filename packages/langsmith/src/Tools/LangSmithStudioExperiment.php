<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Studio Experiment.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/studio_experiment.
 */
class LangSmithStudioExperiment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_studio_experiment';
    protected const DESCRIPTION = 'Studio Experiment

Official endpoint: POST /api/v1/datasets/studio_experiment
Studio Experiment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/studio_experiment';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
