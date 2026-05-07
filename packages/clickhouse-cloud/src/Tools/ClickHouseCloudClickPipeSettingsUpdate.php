<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update ClickPipe settings.
 *
 * Maps to the official ClickHouse Cloud endpoint put /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/settings.
 */
class ClickHouseCloudClickPipeSettingsUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_settings_update';
    protected const DESCRIPTION = 'Update ClickPipe settings

Official ClickHouse Cloud endpoint: PUT /v1/organizations/{organizationId}/services/{serviceId}/clickpipes/{clickPipeId}/settings

Update the advanced settings for the specified ClickPipe. Send key-value pairs where values can be strings, numbers, or booleans.';
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
    'description' => 'ID of the ClickPipe to update settings for.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'put';
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
