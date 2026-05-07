<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update Postgres superuser password.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/postgres/{postgresId}/password.
 */
class ClickHouseCloudPostgresServiceSetPassword extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_set_password';
    protected const DESCRIPTION = 'Update Postgres superuser password

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/postgres/{postgresId}/password

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Sets a new password for a Postgres service\'s superuser account.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/postgres/{postgresId}/password';
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
