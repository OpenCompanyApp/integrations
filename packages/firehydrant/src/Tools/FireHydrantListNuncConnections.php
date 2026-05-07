<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List status pages.
 *
 * Maps to the official FireHydrant endpoint get /v1/nunc_connections.
 */
class FireHydrantListNuncConnections extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_nunc_connections';
    protected const DESCRIPTION = 'List status pages

Official FireHydrant endpoint: GET /v1/nunc_connections

Lists the information displayed as part of your FireHydrant hosted status pages.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/nunc_connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
