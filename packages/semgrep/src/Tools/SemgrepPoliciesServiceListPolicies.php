<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List policies.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentId}/policies.
 */
class SemgrepPoliciesServiceListPolicies extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_policies_service_list_policies';
    protected const DESCRIPTION = 'List policies

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/policies';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentId}/policies';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
