<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Respond activity task failed by id.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}/fail.
 */
class TemporalRespondActivityTaskFailedById extends AbstractTemporalTool
{
    protected const NAME = 'temporal_respond_activity_task_failed_by_id';
    protected const DESCRIPTION = 'Respond activity task failed by id

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}/fail

See `RecordActivityTaskFailed`. This version allows clients to record failures by
 namespace/workflow id/activity id instead of task token.

 (-- api-linter: core::0136::prepositions=disabled
     aip.dev/not-precedent: "By" is used to indicate request type. --)';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'Id of the activity to fail',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}/fail';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
