<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe workflow rule.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/workflow-rules/{ruleId}.
 */
class TemporalDescribeWorkflowRule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_workflow_rule_2';
    protected const DESCRIPTION = 'Describe workflow rule

Official Temporal endpoint: GET /namespaces/{namespace}/workflow-rules/{ruleId}

DescribeWorkflowRule return the rule specification for existing rule id.
 If there is no rule with such id - NOT FOUND error will be returned.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'rule_id' => array (
  'type' => 'string',
  'description' => 'User-specified ID of the rule to read. Unique within the namespace.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/workflow-rules/{ruleId}';
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
