<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Unpublish a status page.
 *
 * Maps to the official FireHydrant endpoint post /v1/nunc_connections/{nunc_connection_id}/unpublish.
 */
class FireHydrantUnpublishNuncConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_unpublish_nunc_connection';
    protected const DESCRIPTION = 'Unpublish a status page

Official FireHydrant endpoint: POST /v1/nunc_connections/{nunc_connection_id}/unpublish

Unpublish a FireHydrant hosted status page';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/unpublish';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
