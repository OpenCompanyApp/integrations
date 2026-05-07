<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Validate worker deployment version compute config.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}/validate-compute-config.
 */
class TemporalValidateWorkerDeploymentVersionComputeConfig2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_validate_worker_deployment_version_compute_config_2';
    protected const DESCRIPTION = 'Validate worker deployment version compute config

Official Temporal endpoint: POST /namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}/validate-compute-config

Validates the compute config without attaching it to a Worker Deployment Version.
 Experimental. This API might significantly change or be removed in a future release.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_version_deployment_name' => array (
  'type' => 'string',
  'description' => 'deployment_version.deployment_name parameter.',
  'required' => true,
),
  'deployment_version_build_id' => array (
  'type' => 'string',
  'description' => 'deployment_version.build_id parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}/validate-compute-config';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deployment_version.deployment_name' => 'deployment_version_deployment_name',
  'deployment_version.build_id' => 'deployment_version_build_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
