<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Stream Dataset Handler.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/playground_experiment/stream.
 */
class LangSmithStreamDatasetHandler extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_stream_dataset_handler';
    protected const DESCRIPTION = 'Stream Dataset Handler

Official endpoint: POST /api/v1/datasets/playground_experiment/stream
Stream Dataset Handler.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/playground_experiment/stream';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
