<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get deployment reachability.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}/reachability.
 */
class TemporalGetDeploymentReachability2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_deployment_reachability_2';
    protected const DESCRIPTION = 'Get deployment reachability

Official Temporal endpoint: GET /namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}/reachability

Returns the reachability level of a worker deployment to help users decide when it is time
 to decommission a deployment. Reachability level is calculated based on the deployment\'s
 `status` and existing workflows that depend on the given deployment for their execution.
 Calculating reachability is relatively expensive. Therefore, server might return a recently
 cached value. In such a case, the `last_update_time` will inform you about the actual
 reachability calculation time.
 Experimental. This API might significantly change or be removed in a future release.
 Deprecated. Replaced with `DrainageInfo` returned by `DescribeWorkerDeploymentVersion`.';
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
    protected const PATH = '/namespaces/{namespace}/deployments/{deployment.series_name}/{deployment.build_id}/reachability';
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
