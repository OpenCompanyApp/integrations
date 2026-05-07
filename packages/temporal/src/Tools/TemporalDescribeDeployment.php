<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe deployment.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}.
 */
class TemporalDescribeDeployment extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_deployment';
    protected const DESCRIPTION = 'Describe deployment

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}

Describes a worker deployment.
 Experimental. This API might significantly change or be removed in a future release.
 Deprecated. Replaced with `DescribeWorkerDeploymentVersion`.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_series_name' => array (
  'type' => 'string',
  'description' => 'Different versions of the same worker service/application are related together by having a
 shared series name.
 Out of all deployments of a series, one can be designated as the current deployment, which
 receives new workflow executions and new tasks of workflows with
 `VERSIONING_BEHAVIOR_AUTO_UPGRADE` versioning behavior.',
),
  'deployment_build_id' => array (
  'type' => 'string',
  'description' => 'Build ID changes with each version of the worker when the worker program code and/or config
 changes.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deployment.series_name' => 'deployment_series_name',
  'deployment.build_id' => 'deployment_build_id',
);
    protected const QUERY_PARAMS = array (
  'deployment.seriesName' => 'deployment_series_name',
  'deployment.buildId' => 'deployment_build_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
