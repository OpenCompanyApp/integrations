<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a status page.
 *
 * Maps to the official FireHydrant endpoint post /v1/nunc_connections.
 */
class FireHydrantCreateNuncConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_nunc_connection';
    protected const DESCRIPTION = 'Create a status page

Official FireHydrant endpoint: POST /v1/nunc_connections

Create a new FireHydrant hosted status page for customer facing statuses.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/nunc_connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
