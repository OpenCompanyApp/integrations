<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add a reviewer to an annotation queue.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/annotation-queues/{queue_id}/reviewers.
 */
class LangSmithPostV1PlatformAnnotationQueuesQueueIdReviewers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_annotation_queues_queue_id_reviewers';
    protected const DESCRIPTION = 'Add a reviewer to an annotation queue

Official endpoint: POST /v1/platform/annotation-queues/{queue_id}/reviewers
Assigns a single identity as a reviewer for the queue. Idempotent.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/annotation-queues/{queue_id}/reviewers';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
