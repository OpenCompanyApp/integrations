<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe worker deployment version.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}.
 */
class TemporalDescribeWorkerDeploymentVersion extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_worker_deployment_version';
    protected const DESCRIPTION = 'Describe worker deployment version

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}

Describes a worker deployment version.
 Experimental. This API might significantly change or be removed in a future release.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'deployment_version_deployment_name' => array (
  'type' => 'string',
  'description' => 'Identifies the Worker Deployment this Version is part of.',
),
  'deployment_version_build_id' => array (
  'type' => 'string',
  'description' => 'A unique identifier for this Version within the Deployment it is a part of.
 Not necessarily unique within the namespace.
 The combination of `deployment_name` and `build_id` uniquely identifies this
 Version within the namespace, because Deployment names are unique within a namespace.',
),
  'version' => array (
  'type' => 'string',
  'description' => 'Deprecated. Use `deployment_version`.',
),
  'report_task_queue_stats' => array (
  'type' => 'boolean',
  'description' => 'Report stats for task queues which have been polled by this version.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'deployment_version.deployment_name' => 'deployment_version_deployment_name',
  'deployment_version.build_id' => 'deployment_version_build_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'deploymentVersion.buildId' => 'deployment_version_build_id',
  'deploymentVersion.deploymentName' => 'deployment_version_deployment_name',
  'reportTaskQueueStats' => 'report_task_queue_stats',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
