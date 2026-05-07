<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Respond activity task failed.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activity-fail.
 */
class TemporalRespondActivityTaskFailed extends AbstractTemporalTool
{
    protected const NAME = 'temporal_respond_activity_task_failed';
    protected const DESCRIPTION = 'Respond activity task failed

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activity-fail

RespondActivityTaskFailed is called by workers when processing an activity task fails.

 This results in a new `ACTIVITY_TASK_FAILED` event being written to the workflow history and
 a new workflow task created for the workflow. Fails with `NotFound` if the task token is no
 longer valid due to activity timeout, already being completed, or never having existed.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activity-fail';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
