<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Notification.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/notifications/{id}/.
 */
class DbtCloudV2UpdateNotification extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_update_notification';
    protected const DESCRIPTION = 'Update Notification

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/notifications/{id}/

Update an existing Job Notification configuration.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/accounts/{account_id}/notifications/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
