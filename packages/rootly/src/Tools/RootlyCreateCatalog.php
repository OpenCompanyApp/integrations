<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a catalog.
 *
 * Maps to the official Rootly endpoint post /v1/catalogs.
 */
class RootlyCreateCatalog extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_catalog';
    protected const DESCRIPTION = 'Creates a catalog

Official Rootly endpoint: POST /v1/catalogs

Creates a new catalog from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/catalogs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
