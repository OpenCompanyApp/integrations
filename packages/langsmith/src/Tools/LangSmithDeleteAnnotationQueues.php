<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Annotation Queues.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/annotation-queues.
 */
class LangSmithDeleteAnnotationQueues extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_annotation_queues';
    protected const DESCRIPTION = 'Delete Annotation Queues

Official endpoint: DELETE /api/v1/annotation-queues
Delete multiple annotation queues with partial success support. Returns: - 200: All queues deleted successfully - 207: Some queues deleted successfully, some failed';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: queue_ids.',
  ),
  'queue_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `queue_ids`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/annotation-queues';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'queue_ids',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
