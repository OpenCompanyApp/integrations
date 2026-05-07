<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a status page.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc_connections/{nunc_connection_id}.
 */
class FireHydrantDeleteNuncConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_nunc_connection';
    protected const DESCRIPTION = 'Delete a status page

Official FireHydrant endpoint: DELETE /v1/nunc_connections/{nunc_connection_id}

Delete a FireHydrant hosted status page, stopping updates of your incidents to it.';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
