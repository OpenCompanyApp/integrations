<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Ingest service catalog data.
 *
 * Maps to the official FireHydrant endpoint post /v1/catalogs/{catalog_id}/ingest.
 */
class FireHydrantIngestCatalogData extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_ingest_catalog_data';
    protected const DESCRIPTION = 'Ingest service catalog data

Official FireHydrant endpoint: POST /v1/catalogs/{catalog_id}/ingest

Accepts catalog data in the configured format and asyncronously processes the data to incorporate changes into service catalog.';
    protected const PARAMETERS = array (
  'catalog_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/catalogs/{catalog_id}/ingest';
    protected const PATH_PARAMS = array (
  'catalog_id' => 'catalog_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
