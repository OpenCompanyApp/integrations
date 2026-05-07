<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Delete workflow rule.
 *
 * Maps to the official Temporal endpoint delete /api/v1/namespaces/{namespace}/workflow-rules/{ruleId}.
 */
class TemporalDeleteWorkflowRule extends AbstractTemporalTool
{
    protected const NAME = 'temporal_delete_workflow_rule';
    protected const DESCRIPTION = 'Delete workflow rule

Official Temporal endpoint: DELETE /api/v1/namespaces/{namespace}/workflow-rules/{ruleId}

Delete rule by rule id';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'rule_id' => array (
  'type' => 'string',
  'description' => 'ID of the rule to delete. Unique within the namespace.',
  'required' => true,
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v1/namespaces/{namespace}/workflow-rules/{ruleId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'ruleId' => 'rule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
