<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Notification.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/notifications/.
 */
class DbtCloudV2CreateNotification extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_create_notification';
    protected const DESCRIPTION = 'Create Notification

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/notifications/

Create a new Job Notification configuration to trigger notifications for job successes, failures, or cancelations. Notifications can be sent to a dbt Cloud user, an external email address, or a Slack channel.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
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
    protected const PATH = '/api/v2/accounts/{account_id}/notifications/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
