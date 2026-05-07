<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Delete a group.
 *
 * Maps to the official Bitwarden Public API endpoint delete /public/groups/{id}.
 */
class BitwardenGroupsDelete extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_delete';
    protected const DESCRIPTION = 'Delete a group.

Official Bitwarden Public API endpoint: DELETE /public/groups/{id}

Permanently deletes a group. This cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the group to be deleted.',
  ),
);
    protected const METHOD = 'DELETE';
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
