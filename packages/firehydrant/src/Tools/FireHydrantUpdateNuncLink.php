<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a status page link.
 *
 * Maps to the official FireHydrant endpoint patch /v1/nunc_connections/{nunc_connection_id}/links/{link_id}.
 */
class FireHydrantUpdateNuncLink extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_nunc_link';
    protected const DESCRIPTION = 'Update a status page link

Official FireHydrant endpoint: PATCH /v1/nunc_connections/{nunc_connection_id}/links/{link_id}

Update a link to be displayed on a FireHydrant status page';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/links/{link_id}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
  'link_id' => 'link_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
