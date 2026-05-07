<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Trigger workflow rule.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{execution.workflow_id}/trigger-rule.
 */
class TemporalTriggerWorkflowRule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_trigger_workflow_rule_2';
    protected const DESCRIPTION = 'Trigger workflow rule

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{execution.workflow_id}/trigger-rule

TriggerWorkflowRule allows to:
  * trigger existing rule for a specific workflow execution;
  * trigger rule for a specific workflow execution without creating a rule;
 This is useful for one-off operations.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'execution_workflow_id' => array (
  'type' => 'string',
  'description' => 'execution.workflow_id parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{execution.workflow_id}/trigger-rule';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'execution.workflow_id' => 'execution_workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
