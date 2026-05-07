<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeploymentsStatus.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/deployments/{deploymentId}/status.
 */
class PulumiDeploymentsGetDeploymentsStatus extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployments_status';
    protected const DESCRIPTION = 'GetDeploymentsStatus

Official Pulumi Cloud endpoint: GET /api/deployments/{deploymentId}/status

Returns the current execution status of a Pulumi Deployments run. This endpoint is used by self-hosted deployment agents running in agent pools to check whether a deployment is still active. Authenticated using an agent pool secret rather than a user access token.';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deploymentId` from the official Pulumi Cloud API operation. The deployment identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/deployments/{deploymentId}/status';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
