<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Set worker deployment manager.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/worker-deployments/{deploymentName}/set-manager.
 */
class TemporalSetWorkerDeploymentManager2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_set_worker_deployment_manager_2';
    protected const DESCRIPTION = 'Set worker deployment manager

Official Temporal endpoint: POST /namespaces/{namespace}/worker-deployments/{deploymentName}/set-manager

Set/unset the ManagerIdentity of a Worker Deployment.
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/worker-deployments/{deploymentName}/set-manager';
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
