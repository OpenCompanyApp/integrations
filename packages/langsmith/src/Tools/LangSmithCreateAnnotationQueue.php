<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Annotation Queue.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues.
 */
class LangSmithCreateAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_annotation_queue';
    protected const DESCRIPTION = 'Create Annotation Queue

Official endpoint: POST /api/v1/annotation-queues
Create Annotation Queue.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/annotation-queues';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
