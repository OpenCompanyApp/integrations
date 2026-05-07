<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update SCIM Group.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}.
 */
class DbtCloudV3UpdateScimGroup extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_scim_group';
    protected const DESCRIPTION = 'Update SCIM Group

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}

Update a group via SCIM using PUT';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'description' => 'group_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
