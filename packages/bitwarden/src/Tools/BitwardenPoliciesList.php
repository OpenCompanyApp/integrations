<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * List all policies.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/policies.
 */
class BitwardenPoliciesList extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_policies_list';
    protected const DESCRIPTION = 'List all policies.

Official Bitwarden Public API endpoint: GET /public/policies

Returns a list of your organization\'s policies.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/policies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
