<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Update policy.
 *
 * Maps to the official Semgrep Web API endpoint put /api/v1/deployments/{deploymentId}/policies/{policyId}.
 */
class SemgrepPoliciesServiceUpdatePolicy extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_policies_service_update_policy';
    protected const DESCRIPTION = 'Update policy

Official Semgrep Web API endpoint: PUT /api/v1/deployments/{deploymentId}/policies/{policyId}';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/v1/deployments/{deploymentId}/policies/{policyId}';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
  'policyId' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
