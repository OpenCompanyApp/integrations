<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Send user invites.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/invites/.
 */
class DbtCloudV3SendUserInvites extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_send_user_invites';
    protected const DESCRIPTION = 'Send user invites

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/invites/

Send email invites to users who you wish to add to this account';
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
    protected const PATH = '/api/v3/accounts/{account_id}/invites/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
