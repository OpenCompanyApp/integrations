<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Delete worker deployment version.
 *
 * Maps to the official Temporal endpoint delete /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}.
 */
class TemporalDeleteWorkerDeploymentVersion extends AbstractTemporalTool
{
    protected const NAME = 'temporal_delete_worker_deployment_version';
    protected const DESCRIPTION = 'Delete worker deployment version

Official Temporal endpoint: DELETE /api/v1/namespaces/{namespace}/worker-deployment-versions/{deployment_version.deployment_name}/{deployment_version.build_id}

Used for manual deletion of Versions. User can delete a Version only when all the
 following conditions are met:
  - It is not the Current or Ramping Version of its Deployment.
  - It has no active pollers (none of the task queues in the Version have pollers)
  - It is not draining (see WorkerDeploymentVersionInfo.drainage_info). This condition
    can be skipped by passing `skip-drainage=true`.
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
  'skip_drainage' => array (
  'type' => 'boolean',
  'description' => 'Pass to force deletion even if the Version is draining. In this case the open pinned
 workflows will be stuck until manually moved to another version by UpdateWorkflowExecutionOptions.',
),
  'identity' => array (
  'type' => 'string',
  'description' => 'Optional. The identity of the client who initiated this request.',
),
);
    protected const METHOD = 'delete';
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
  'skipDrainage' => 'skip_drainage',
  'identity' => 'identity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
