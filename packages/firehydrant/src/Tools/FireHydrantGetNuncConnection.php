<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a status page.
 *
 * Maps to the official FireHydrant endpoint get /v1/nunc_connections/{nunc_connection_id}.
 */
class FireHydrantGetNuncConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_nunc_connection';
    protected const DESCRIPTION = 'Get a status page

Official FireHydrant endpoint: GET /v1/nunc_connections/{nunc_connection_id}

Retrieve the information displayed as part of your FireHydrant hosted status page.';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
