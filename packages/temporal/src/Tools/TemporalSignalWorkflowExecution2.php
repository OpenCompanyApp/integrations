<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Signal workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/signal/{signalName}.
 */
class TemporalSignalWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_signal_workflow_execution_2';
    protected const DESCRIPTION = 'Signal workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/signal/{signalName}

SignalWorkflowExecution is used to send a signal to a running workflow execution.

 This results in a `WORKFLOW_EXECUTION_SIGNALED` event recorded in the history and a workflow
 task being created for the execution.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'workflow_execution_workflow_id' => array (
  'type' => 'string',
  'description' => 'workflow_execution.workflow_id parameter.',
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
    protected const PATH = '/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/signal/{signalName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workflow_execution.workflow_id' => 'workflow_execution_workflow_id',
  'signalName' => 'signal_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
