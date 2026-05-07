<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Remove a reviewer from an annotation queue.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/annotation-queues/{queue_id}/reviewers/{identity_id}.
 */
class LangSmithDeleteV1PlatformAnnotationQueuesQueueIdReviewersIdentityId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_annotation_queues_queue_id_reviewers_identity_id';
    protected const DESCRIPTION = 'Remove a reviewer from an annotation queue

Official endpoint: DELETE /v1/platform/annotation-queues/{queue_id}/reviewers/{identity_id}
Unassigns an identity as a reviewer for the queue. Idempotent.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/annotation-queues/{queue_id}/reviewers/{identity_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
  1 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
