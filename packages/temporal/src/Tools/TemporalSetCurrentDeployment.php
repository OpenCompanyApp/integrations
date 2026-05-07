<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Set current deployment.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/current-deployment/{deployment.series_name}.
 */
class TemporalSetCurrentDeployment extends AbstractTemporalTool
{
    protected const NAME = 'temporal_set_current_deployment';
    protected const DESCRIPTION = 'Set current deployment

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/current-deployment/{deployment.series_name}

Sets a deployment as the current deployment for its deployment series. Can optionally update
 the metadata of the deployment as well.
 Experimental. This API might significantly change or be removed in a future release.
 Deprecated. Replaced by `SetWorkerDeploymentCurrentVersion`.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_series_name' => array (
  'type' => 'string',
  'description' => 'deployment.series_name parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/current-deployment/{deployment.series_name}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deployment.series_name' => 'deployment_series_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
