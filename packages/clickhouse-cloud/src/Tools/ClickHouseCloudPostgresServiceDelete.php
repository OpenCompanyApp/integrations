<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete a PostgreSQL service.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/postgres/{postgresId}.
 */
class ClickHouseCloudPostgresServiceDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_delete';
    protected const DESCRIPTION = 'Delete a PostgreSQL service

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/postgres/{postgresId}

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Deletes a Postgres service that belongs to the organization';
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
    protected const METHOD = 'delete';
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
