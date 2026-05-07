<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Profile.
 *
 * Maps to the official dbt Cloud v3 endpoint patch /api/v3/accounts/{account_id}/projects/{project_id}/profiles/{id}/.
 */
class DbtCloudV3UpdateProfile extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_profile';
    protected const DESCRIPTION = 'Update Profile

Official dbt Cloud v3 endpoint: PATCH /api/v3/accounts/{account_id}/projects/{project_id}/profiles/{id}/

Update an existing profile.

Note: Profiles are in the process of being rolled out and may not be available for your account yet.

Profiles are the set of connection, credentials, and attributes used to connect to a data warehouse. They can be assigned to deployment environments to run jobs.';
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
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/profiles/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
