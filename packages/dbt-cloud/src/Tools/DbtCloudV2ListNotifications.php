<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Notifications.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/notifications/.
 */
class DbtCloudV2ListNotifications extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_notifications';
    protected const DESCRIPTION = 'List Notifications

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/notifications/

List notification configurations';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'external_email' =>
  array (
    'type' => 'string',
    'description' => 'external_email parameter.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'offset parameter.',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Field to order results by. Prefix with \'-\' for descending order.',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
  ),
  'slack_channel_id' =>
  array (
    'type' => 'string',
    'description' => 'slack_channel_id parameter.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'description' => 'Filters by soft deletion state.
            <ul>
                <li>
                    <strong>"active"</strong> / <strong>1</strong>: Only active resources
                </li>
                <li>
                    <strong>"deleted"</strong> / <strong>2</strong>: Only deleted resources
                </li>
                <li>
                    <strong>"all"</strong>: All resources
                </li>
            </ul>',
  ),
  'type' =>
  array (
    'type' => 'integer',
    'description' => 'type parameter.',
    'enum' =>
    array (
      0 => 1,
      1 => 2,
      2 => 3,
      3 => 4,
      4 => 5,
    ),
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/notifications/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'external_email' => 'external_email',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'slack_channel_id' => 'slack_channel_id',
  'state' => 'state',
  'type' => 'type',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
