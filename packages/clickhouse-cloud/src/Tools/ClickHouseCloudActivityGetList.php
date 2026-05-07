<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List of organization activities.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/activities.
 */
class ClickHouseCloudActivityGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_activity_get_list';
    protected const DESCRIPTION = 'List of organization activities

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/activities

Returns a list of all organization activities.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'description' => 'A starting date for a search',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'description' => 'An ending date for a search',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/activities';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
  'from_date' => 'from_date',
  'to_date' => 'to_date',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
