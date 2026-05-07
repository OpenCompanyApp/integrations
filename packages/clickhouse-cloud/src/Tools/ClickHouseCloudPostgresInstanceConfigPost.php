<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Replace Postgres service configuration.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/postgres/{postgresId}/config.
 */
class ClickHouseCloudPostgresInstanceConfigPost extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_instance_config_post';
    protected const DESCRIPTION = 'Replace Postgres service configuration

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/postgres/{postgresId}/config

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Replace the existing Postgres service and pgBouncer configuration.';
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
    protected const PATH = '/v1/organizations/{organizationId}/postgres/{postgresId}/config';
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
