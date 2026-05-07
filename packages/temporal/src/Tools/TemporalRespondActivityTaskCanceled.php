<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Respond activity task canceled.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activity-resolve-as-canceled.
 */
class TemporalRespondActivityTaskCanceled extends AbstractTemporalTool
{
    protected const NAME = 'temporal_respond_activity_task_canceled';
    protected const DESCRIPTION = 'Respond activity task canceled

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activity-resolve-as-canceled

RespondActivityTaskFailed is called by workers when processing an activity task fails.

 For workflow activities, this results in a new `ACTIVITY_TASK_CANCELED` event being written to the workflow history
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
    protected const PATH = '/api/v1/namespaces/{namespace}/activity-resolve-as-canceled';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
