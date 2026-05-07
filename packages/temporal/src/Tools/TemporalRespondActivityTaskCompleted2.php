<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Respond activity task completed.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activity-complete.
 */
class TemporalRespondActivityTaskCompleted2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_respond_activity_task_completed_2';
    protected const DESCRIPTION = 'Respond activity task completed

Official Temporal endpoint: POST /namespaces/{namespace}/activity-complete

RespondActivityTaskCompleted is called by workers when they successfully complete an activity
 task.

 For workflow activities, this results in a new `ACTIVITY_TASK_COMPLETED` event being written to the workflow history
 and a new workflow task created for the workflow. Fails with `NotFound` if the task token is
 no longer valid due to activity timeout, already being completed, or never having existed.';
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
    protected const PATH = '/namespaces/{namespace}/activity-complete';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
