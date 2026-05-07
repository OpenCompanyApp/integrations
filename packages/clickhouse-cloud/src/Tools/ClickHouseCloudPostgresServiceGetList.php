<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List of organization Postgres services.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/postgres.
 */
class ClickHouseCloudPostgresServiceGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_get_list';
    protected const DESCRIPTION = 'List of organization Postgres services

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/postgres

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Returns a list of all Postgres services in the organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the services.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/postgres';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
