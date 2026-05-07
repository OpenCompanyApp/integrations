<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Refresh a service catalog.
 *
 * Maps to the official FireHydrant endpoint get /v1/catalogs/{catalog_id}/refresh.
 */
class FireHydrantRefreshCatalog extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_refresh_catalog';
    protected const DESCRIPTION = 'Refresh a service catalog

Official FireHydrant endpoint: GET /v1/catalogs/{catalog_id}/refresh

Schedules an async task to re-import catalog info and update catalog data accordingly.';
    protected const PARAMETERS = array (
  'catalog_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalogs/{catalog_id}/refresh';
    protected const PATH_PARAMS = array (
  'catalog_id' => 'catalog_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
