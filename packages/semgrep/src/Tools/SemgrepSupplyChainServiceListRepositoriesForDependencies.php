<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List repositories with dependencies.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentId}/dependencies/repositories.
 */
class SemgrepSupplyChainServiceListRepositoriesForDependencies extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_supply_chain_service_list_repositories_for_dependencies';
    protected const DESCRIPTION = 'List repositories with dependencies

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/dependencies/repositories';
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
    protected const PATH = '/api/v1/deployments/{deploymentId}/dependencies/repositories';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
