<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Create a group.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/groups.
 */
class BitwardenGroupsPost extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_post';
    protected const DESCRIPTION = 'Create a group.

Official Bitwarden Public API endpoint: POST /public/groups

Creates a new group object.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
