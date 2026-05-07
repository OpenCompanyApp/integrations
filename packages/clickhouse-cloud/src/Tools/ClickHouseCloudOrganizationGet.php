<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get organization details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}.
 */
class ClickHouseCloudOrganizationGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_get';
    protected const DESCRIPTION = 'Get organization details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}

Returns details of a single organization. In order to get the details, the auth key must belong to the organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
