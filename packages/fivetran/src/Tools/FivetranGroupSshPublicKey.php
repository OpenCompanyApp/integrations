<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Group Public SSH Key.
 *
 * Maps to the official Fivetran endpoint get /v1/groups/{groupId}/public-key.
 */
class FivetranGroupSshPublicKey extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_group_ssh_public_key';
    protected const DESCRIPTION = 'Retrieve Group Public SSH Key

Official Fivetran endpoint: GET /v1/groups/{groupId}/public-key

Returns public key from SSH key pair associated with the group.';
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
    protected const PATH = '/v1/groups/{groupId}/public-key';
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
