<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Group.
 *
 * Maps to the official Fivetran endpoint delete /v1/groups/{groupId}.
 */
class FivetranDeleteGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_group';
    protected const DESCRIPTION = 'Delete a Group

Official Fivetran endpoint: DELETE /v1/groups/{groupId}

Deletes a group from your Fivetran account.';
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
    protected const METHOD = 'delete';
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
