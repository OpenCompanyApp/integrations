<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get ClickPipe settings.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/settings.
 */
class ClickHouseCloudClickPipeSettingsGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_settings_get';
    protected const DESCRIPTION = 'Get ClickPipe settings

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/settings

Returns the advanced settings for the specified ClickPipe.';
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
    'description' => 'ID of the ClickPipe to get settings for.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/settings';
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
