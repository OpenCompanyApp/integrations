<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Get the status of a SBOM export job.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentId}/sbom/export/{taskToken}.
 */
class SemgrepSupplyChainServiceGetSbomExport extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_supply_chain_service_get_sbom_export';
    protected const DESCRIPTION = 'Get the status of a SBOM export job

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/sbom/export/{taskToken}';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'task_token' =>
  array (
    'type' => 'string',
    'description' => 'taskToken parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentId}/sbom/export/{taskToken}';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
  'taskToken' => 'task_token',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
