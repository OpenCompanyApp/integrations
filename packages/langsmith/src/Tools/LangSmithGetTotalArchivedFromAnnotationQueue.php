<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Total Archived From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}/total_archived.
 */
class LangSmithGetTotalArchivedFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_total_archived_from_annotation_queue';
    protected const DESCRIPTION = 'Get Total Archived From Annotation Queue

Official endpoint: GET /api/v1/annotation-queues/{queue_id}/total_archived
Get Total Archived From Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: start_time, end_time.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `end_time`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/total_archived';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
  0 => 'start_time',
  1 => 'end_time',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
