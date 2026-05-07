<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Restore a Postgres service.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/postgres/{postgresId}/restoredService.
 */
class ClickHouseCloudPostgresInstanceRestore extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_instance_restore';
    protected const DESCRIPTION = 'Restore a Postgres service

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/postgres/{postgresId}/restoredService

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Restore a Postgres database from continuous backup, optionally at a specific point in time.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/organizations/{organizationId}/postgres/{postgresId}/restoredService';
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
