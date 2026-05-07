<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Group Service Account.
 *
 * Maps to the official Fivetran endpoint get /v1/groups/{groupId}/service-account.
 */
class FivetranGroupServiceAccount extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_group_service_account';
    protected const DESCRIPTION = 'Retrieve Group Service Account

Official Fivetran endpoint: GET /v1/groups/{groupId}/service-account

Returns Fivetran service account associated with the group.';
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
    protected const PATH = '/v1/groups/{groupId}/service-account';
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
