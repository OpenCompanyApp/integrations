<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List policy rules.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentId}/policies/{policyId}.
 */
class SemgrepPoliciesServiceListPolicyRules extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_policies_service_list_policy_rules';
    protected const DESCRIPTION = 'List policy rules

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/policies/{policyId}';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'policy_id' =>
  array (
    'type' => 'string',
    'description' => 'policyId parameter.',
    'required' => true,
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'description' => 'cursor parameter.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentId}/policies/{policyId}';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
  'policyId' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
