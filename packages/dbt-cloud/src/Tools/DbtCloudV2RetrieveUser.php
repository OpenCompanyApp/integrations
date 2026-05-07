<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve User.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/users/{id}/.
 */
class DbtCloudV2RetrieveUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_user';
    protected const DESCRIPTION = 'Retrieve User

Official dbt Cloud v2 endpoint: GET /api/v2/users/{id}/';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/users/{id}/';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
