<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Set worker deployment current version.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/worker-deployments/{deploymentName}/set-current-version.
 */
class TemporalSetWorkerDeploymentCurrentVersion2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_set_worker_deployment_current_version_2';
    protected const DESCRIPTION = 'Set worker deployment current version

Official Temporal endpoint: POST /namespaces/{namespace}/worker-deployments/{deploymentName}/set-current-version

Set/unset the Current Version of a Worker Deployment. Automatically unsets the Ramping
 Version if it is the Version being set as Current.
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
    protected const PATH = '/namespaces/{namespace}/worker-deployments/{deploymentName}/set-current-version';
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
