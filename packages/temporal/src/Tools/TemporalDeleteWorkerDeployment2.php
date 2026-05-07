<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Delete worker deployment.
 *
 * Maps to the official Temporal endpoint delete /namespaces/{namespace}/worker-deployments/{deploymentName}.
 */
class TemporalDeleteWorkerDeployment2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_delete_worker_deployment_2';
    protected const DESCRIPTION = 'Delete worker deployment

Official Temporal endpoint: DELETE /namespaces/{namespace}/worker-deployments/{deploymentName}

Deletes records of (an old) Deployment. A deployment can only be deleted if
 it has no Version in it.
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
  'identity' => array (
  'type' => 'string',
  'description' => 'Optional. The identity of the client who initiated this request.',
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/namespaces/{namespace}/worker-deployments/{deploymentName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deploymentName' => 'deployment_name',
);
    protected const QUERY_PARAMS = array (
  'identity' => 'identity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
