<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Catalog Entity.
 *
 * Maps to the official Rootly endpoint put /v1/catalog_entities/{id}.
 */
class RootlyUpdateCatalogEntity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_catalog_entity';
    protected const DESCRIPTION = 'Update a Catalog Entity

Official Rootly endpoint: PUT /v1/catalog_entities/{id}

Update a specific Catalog Entity by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/catalog_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
