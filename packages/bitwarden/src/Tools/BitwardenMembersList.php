<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * List all members.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/members.
 */
class BitwardenMembersList extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_list';
    protected const DESCRIPTION = 'List all members.

Official Bitwarden Public API endpoint: GET /public/members

Returns a list of your organization\'s members. Member objects listed in this call include information about their associated collections.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
