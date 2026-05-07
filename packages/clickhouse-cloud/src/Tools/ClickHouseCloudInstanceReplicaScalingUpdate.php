<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update service auto scaling settings.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/replicaScaling.
 */
class ClickHouseCloudInstanceReplicaScalingUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_replica_scaling_update';
    protected const DESCRIPTION = 'Update service auto scaling settings

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/replicaScaling

Updates minimum and maximum memory limits per replica and idle mode scaling behavior for the service. The memory settings are available only for "production" services and must be a multiple of 4 starting from 8GB. Please contact support to enable adjustment of numReplicas.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the service.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the service to update scaling parameters.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/replicaScaling';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
