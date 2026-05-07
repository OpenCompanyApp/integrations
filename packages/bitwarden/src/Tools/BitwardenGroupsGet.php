<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a group.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/groups/{id}.
 */
class BitwardenGroupsGet extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_get';
    protected const DESCRIPTION = 'Retrieve a group.

Official Bitwarden Public API endpoint: GET /public/groups/{id}

Retrieves the details of an existing group. You need only supply the unique group identifier that was returned upon group creation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the group to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
