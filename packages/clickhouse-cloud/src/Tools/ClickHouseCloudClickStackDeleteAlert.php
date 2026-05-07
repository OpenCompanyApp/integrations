<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * ClickStack: Delete Alert.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts/{clickStackAlertId}.
 */
class ClickHouseCloudClickStackDeleteAlert extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_stack_delete_alert';
    protected const DESCRIPTION = 'ClickStack: Delete Alert

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts/{clickStackAlertId}

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  ClickStack: Deletes an alert';
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
  'click_stack_alert_id' =>
  array (
    'type' => 'string',
    'description' => 'ClickStack Alert ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickstack/alerts/{clickStackAlertId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'clickStackAlertId' => 'click_stack_alert_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
