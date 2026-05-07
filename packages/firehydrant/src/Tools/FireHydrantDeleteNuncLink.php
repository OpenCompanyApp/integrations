<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a status page link.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc_connections/{nunc_connection_id}/links/{link_id}.
 */
class FireHydrantDeleteNuncLink extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_nunc_link';
    protected const DESCRIPTION = 'Delete a status page link

Official FireHydrant endpoint: DELETE /v1/nunc_connections/{nunc_connection_id}/links/{link_id}

Delete a link displayed on a FireHydrant status page';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'link_id' =>
  array (
    'type' => 'string',
    'description' => 'link_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/links/{link_id}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
  'link_id' => 'link_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
