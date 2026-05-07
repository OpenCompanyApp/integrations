<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * ClickStack: List Sources.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickstack/sources.
 */
class ClickHouseCloudClickStackListSources extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_stack_list_sources';
    protected const DESCRIPTION = 'ClickStack: List Sources

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickstack/sources

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  ClickStack: Retrieves a list of all sources for the authenticated team';
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
    'description' => 'ID of the ClickStack service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickstack/sources';
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
