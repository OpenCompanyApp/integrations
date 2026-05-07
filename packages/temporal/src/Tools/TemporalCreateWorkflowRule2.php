<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Create workflow rule.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflow-rules.
 */
class TemporalCreateWorkflowRule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_create_workflow_rule_2';
    protected const DESCRIPTION = 'Create workflow rule

Official Temporal endpoint: POST /namespaces/{namespace}/workflow-rules

Create a new workflow rule. The rules are used to control the workflow execution.
 The rule will be applied to all running and new workflows in the namespace.
 If the rule with such ID already exist this call will fail
 Note: the rules are part of namespace configuration and will be stored in the namespace config.
 Namespace config is eventually consistent.';
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
    protected const PATH = '/namespaces/{namespace}/workflow-rules';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
