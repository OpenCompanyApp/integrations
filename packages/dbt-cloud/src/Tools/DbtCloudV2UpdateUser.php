<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update User.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/users/{id}/.
 */
class DbtCloudV2UpdateUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_update_user';
    protected const DESCRIPTION = 'Update User

Official dbt Cloud v2 endpoint: POST /api/v2/users/{id}/';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/v2/users/{id}/';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
