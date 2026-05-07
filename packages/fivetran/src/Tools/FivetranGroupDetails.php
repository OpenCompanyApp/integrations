<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Group Details.
 *
 * Maps to the official Fivetran endpoint get /v1/groups/{groupId}.
 */
class FivetranGroupDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_group_details';
    protected const DESCRIPTION = 'Retrieve Group Details

Official Fivetran endpoint: GET /v1/groups/{groupId}

Returns a group object if a valid identifier was provided.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/groups/{groupId}';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
