<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a status page.
 *
 * Maps to the official FireHydrant endpoint put /v1/nunc_connections/{nunc_connection_id}.
 */
class FireHydrantUpdateNuncConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_nunc_connection';
    protected const DESCRIPTION = 'Update a status page

Official FireHydrant endpoint: PUT /v1/nunc_connections/{nunc_connection_id}

Update your company\'s information and other components in the specified FireHydrant hosted status page.';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
