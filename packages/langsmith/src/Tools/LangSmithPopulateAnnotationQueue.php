<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Populate Annotation Queue.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues/populate.
 */
class LangSmithPopulateAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_populate_annotation_queue';
    protected const DESCRIPTION = 'Populate Annotation Queue

Official endpoint: POST /api/v1/annotation-queues/populate
Populate annotation queue with runs from an experiment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/annotation-queues/populate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
