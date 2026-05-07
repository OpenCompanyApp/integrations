<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update ClickPipe scaling.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/scaling.
 */
class ClickHouseCloudClickPipeScalingUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_scaling_update';
    protected const DESCRIPTION = 'Update ClickPipe scaling

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/scaling

Change scaling settings for the specified ClickPipe. This endpoint supports Kafka, Kinesis, and object storage pipes (S3, GCS, Azure Blob).

**Note:** For database ClickPipes (PostgreSQL, MySQL, MongoDB, BigQuery), use the [Update CDC ClickPipes scaling](#tag/ClickPipes/operation/clickPipeCdcScalingUpdate) endpoint instead.';
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
    'description' => 'ID of the service that owns the ClickPipe.',
    'required' => true,
  ),
  'click_pipe_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the ClickPipe to update scaling settings.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/scaling';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'clickPipeId' => 'click_pipe_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
