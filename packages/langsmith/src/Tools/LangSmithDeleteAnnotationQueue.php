<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Annotation Queue.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/annotation-queues/{queue_id}.
 */
class LangSmithDeleteAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_annotation_queue';
    protected const DESCRIPTION = 'Delete Annotation Queue

Official endpoint: DELETE /api/v1/annotation-queues/{queue_id}
Delete Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
