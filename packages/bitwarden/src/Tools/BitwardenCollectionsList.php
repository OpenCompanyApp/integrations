<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * List all collections.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/collections.
 */
class BitwardenCollectionsList extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_collections_list';
    protected const DESCRIPTION = 'List all collections.

Official Bitwarden Public API endpoint: GET /public/collections

Returns a list of your organization\'s collections. Collection objects listed in this call do not include information about their associated groups.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/collections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
