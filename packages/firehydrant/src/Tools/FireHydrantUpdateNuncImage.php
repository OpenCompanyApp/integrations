<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Upload an image for a status page.
 *
 * Maps to the official FireHydrant endpoint put /v1/nunc_connections/{nunc_connection_id}/images/{type}.
 */
class FireHydrantUpdateNuncImage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_nunc_image';
    protected const DESCRIPTION = 'Upload an image for a status page

Official FireHydrant endpoint: PUT /v1/nunc_connections/{nunc_connection_id}/images/{type}

Add or replace an image attached to a FireHydrant status page';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'put';
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
