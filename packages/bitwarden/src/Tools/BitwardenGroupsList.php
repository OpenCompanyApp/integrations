<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * List all groups.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/groups.
 */
class BitwardenGroupsList extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_list';
    protected const DESCRIPTION = 'List all groups.

Official Bitwarden Public API endpoint: GET /public/groups

Returns a list of your organization\'s groups. Group objects listed in this call include information about their associated collections.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
