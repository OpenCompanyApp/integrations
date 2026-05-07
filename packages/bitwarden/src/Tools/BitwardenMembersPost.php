<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Create a member.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/members.
 */
class BitwardenMembersPost extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_post';
    protected const DESCRIPTION = 'Create a member.

Official Bitwarden Public API endpoint: POST /public/members

Creates a new member object by inviting a user to the organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
