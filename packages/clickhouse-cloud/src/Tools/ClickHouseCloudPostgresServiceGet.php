<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get PostgreSQL service details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/postgres/{postgresId}.
 */
class ClickHouseCloudPostgresServiceGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_get';
    protected const DESCRIPTION = 'Get PostgreSQL service details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/postgres/{postgresId}

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Returns a Postgres service that belongs to the organization';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the Postgres service.',
    'required' => true,
  ),
  'postgres_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested Postgres service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/postgres/{postgresId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'postgresId' => 'postgres_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
