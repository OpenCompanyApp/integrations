<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Group.
 *
 * Maps to the official Fivetran endpoint patch /v1/groups/{groupId}.
 */
class FivetranModifyGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_group';
    protected const DESCRIPTION = 'Update a Group

Official Fivetran endpoint: PATCH /v1/groups/{groupId}

Updates information for an existing group within your Fivetran account.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
