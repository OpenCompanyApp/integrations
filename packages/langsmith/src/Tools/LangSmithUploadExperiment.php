<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upload Experiment.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/upload-experiment.
 */
class LangSmithUploadExperiment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_upload_experiment';
    protected const DESCRIPTION = 'Upload Experiment

Official endpoint: POST /api/v1/datasets/upload-experiment
Upload an experiment that has already been run.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/upload-experiment';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
