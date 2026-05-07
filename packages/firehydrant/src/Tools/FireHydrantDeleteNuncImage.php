<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an image from a status page.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc_connections/{nunc_connection_id}/images/{type}.
 */
class FireHydrantDeleteNuncImage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_nunc_image';
    protected const DESCRIPTION = 'Delete an image from a status page

Official FireHydrant endpoint: DELETE /v1/nunc_connections/{nunc_connection_id}/images/{type}

Delete an image attached to a FireHydrant status page';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'type' =>
  array (
    'type' => 'string',
    'description' => 'type parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/images/{type}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
  'type' => 'type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
