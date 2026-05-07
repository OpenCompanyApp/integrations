<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Signal with start workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflowId}/signal-with-start/{signalName}.
 */
class TemporalSignalWithStartWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_signal_with_start_workflow_execution_2';
    protected const DESCRIPTION = 'Signal with start workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflowId}/signal-with-start/{signalName}

SignalWithStartWorkflowExecution is used to ensure a signal is sent to a workflow, even if
 it isn\'t yet started.

 If the workflow is running, a `WORKFLOW_EXECUTION_SIGNALED` event is recorded in the history
 and a workflow task is generated.

 If the workflow is not running or not found, then the workflow is created with
 `WORKFLOW_EXECUTION_STARTED` and `WORKFLOW_EXECUTION_SIGNALED` events in its history, and a
 workflow task is generated.

 (-- api-linter: core::0136::prepositions=disabled
     aip.dev/not-precedent: "With" is used to indicate combined operation. --)';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'workflow_id' => array (
  'type' => 'string',
  'description' => 'workflowId parameter.',
  'required' => true,
),
  'signal_name' => array (
  'type' => 'string',
  'description' => 'The workflow author-defined name of the signal to send to the workflow',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{workflowId}/signal-with-start/{signalName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workflowId' => 'workflow_id',
  'signalName' => 'signal_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
