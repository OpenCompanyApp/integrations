<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update Postgres service state.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/postgres/{postgresId}/state.
 */
class ClickHouseCloudPostgresServicePatchState extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_patch_state';
    protected const DESCRIPTION = 'Update Postgres service state

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/postgres/{postgresId}/state

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Initiate a process for a Postgres service:
* restart: Initiates a service restart
* promote: Promotes a read replica to primary
* switchover: Switch a primary over to a standby';
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
    protected const PATH = '/v1/organizations/{organizationId}/postgres/{postgresId}/state';
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
