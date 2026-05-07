<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Create worker deployment.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}.
 */
class TemporalCreateWorkerDeployment extends AbstractTemporalTool
{
    protected const NAME = 'temporal_create_worker_deployment';
    protected const DESCRIPTION = 'Create worker deployment

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}

Creates a new Worker Deployment.

 Experimental. This API might significantly change or be removed in a
 future release.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_name' => array (
  'type' => 'string',
  'description' => 'The name of the Worker Deployment to create. If a Worker Deployment with
 this name already exists, an error will be returned.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/worker-deployments/{deploymentName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deploymentName' => 'deployment_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
