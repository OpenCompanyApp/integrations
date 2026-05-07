<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe worker deployment.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}.
 */
class TemporalDescribeWorkerDeployment extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_worker_deployment';
    protected const DESCRIPTION = 'Describe worker deployment

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}

Describes a Worker Deployment.
 Experimental. This API might significantly change or be removed in a future release.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_name' => array (
  'type' => 'string',
  'description' => 'deploymentName parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deploymentName' => 'deployment_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
