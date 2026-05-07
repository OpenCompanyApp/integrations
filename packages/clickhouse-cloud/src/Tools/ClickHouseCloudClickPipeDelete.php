<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete ClickPipe.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}.
 */
class ClickHouseCloudClickPipeDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_delete';
    protected const DESCRIPTION = 'Delete ClickPipe

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}

Delete the specified ClickPipe.';
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
    'description' => 'ID of the ClickPipe to delete.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}';
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
