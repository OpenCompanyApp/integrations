<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * ClickStack: Create Alert.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts.
 */
class ClickHouseCloudClickStackCreateAlert extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_stack_create_alert';
    protected const DESCRIPTION = 'ClickStack: Create Alert

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  ClickStack: Creates a new alert';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts';
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
