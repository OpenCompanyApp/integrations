<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Create worker deployment version.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}.
 */
class TemporalCreateWorkerDeploymentVersion extends AbstractTemporalTool
{
    protected const NAME = 'temporal_create_worker_deployment_version';
    protected const DESCRIPTION = 'Create worker deployment version

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}

Creates a new Worker Deployment Version.

 Experimental. This API might significantly change or be removed in a
 future release.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deployment_version.deployment_name' => 'deployment_version_deployment_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
