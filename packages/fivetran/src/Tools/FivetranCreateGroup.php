<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Group.
 *
 * Maps to the official Fivetran endpoint post /v1/groups.
 */
class FivetranCreateGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_group';
    protected const DESCRIPTION = 'Create a Group

Official Fivetran endpoint: POST /v1/groups

Creates a new group in your Fivetran account. > IMPORTANT: Groups and destinations are mapped 1:1 to each other. We do this mapping using the group\'s `id` value that we automatically generate when you create a group, and the destination\'s `group_id` value that you specify when you create a destination. This means that you must create a group in your Fivetran account before you can create a destination in it.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
