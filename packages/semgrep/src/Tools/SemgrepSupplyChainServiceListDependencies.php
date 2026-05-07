<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List dependencies.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentId}/dependencies.
 */
class SemgrepSupplyChainServiceListDependencies extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_supply_chain_service_list_dependencies';
    protected const DESCRIPTION = 'List dependencies

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/dependencies';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/deployments/{deploymentId}/dependencies';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
