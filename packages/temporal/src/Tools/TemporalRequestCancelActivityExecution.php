<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Request cancel activity execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}/cancel.
 */
class TemporalRequestCancelActivityExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_request_cancel_activity_execution';
    protected const DESCRIPTION = 'Request cancel activity execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}/cancel

RequestCancelActivityExecution requests cancellation of an activity execution.

 Cancellation is cooperative: this call records the request, but the activity must detect and
 acknowledge it for the activity to reach CANCELED status. The cancellation signal is
 delivered via `cancel_requested` in the heartbeat response; SDKs surface this via
 language-idiomatic mechanisms (context cancellation, exceptions, abort signals).';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'activityId parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}/cancel';
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
