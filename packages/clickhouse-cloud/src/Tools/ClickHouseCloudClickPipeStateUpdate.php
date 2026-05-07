<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update ClickPipe state.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/state.
 */
class ClickHouseCloudClickPipeStateUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_state_update';
    protected const DESCRIPTION = 'Update ClickPipe state

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/state

Start, stop or resync ClickPipe. Stopping a ClickPipe will stop the ingestion process from any state. Starting is allowed for ClickPipes in the "Stopped" state or with a "Failed" state. Resyncing is only for Postgres and MySQL pipes and can be done from any state.';
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
    'description' => 'ID of the ClickPipe to update state.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/state';
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
