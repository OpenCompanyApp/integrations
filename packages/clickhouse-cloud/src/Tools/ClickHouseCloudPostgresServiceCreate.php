<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create new Postgres service.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/postgres.
 */
class ClickHouseCloudPostgresServiceCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_postgres_service_create';
    protected const DESCRIPTION = 'Create new Postgres service

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/postgres

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Creates a new Postgres service in the organization and returns it. The service is started asynchronously.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that will own the service.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
