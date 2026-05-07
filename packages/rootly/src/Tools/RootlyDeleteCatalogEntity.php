<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Catalog Entity.
 *
 * Maps to the official Rootly endpoint delete /v1/catalog_entities/{id}.
 */
class RootlyDeleteCatalogEntity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_catalog_entity';
    protected const DESCRIPTION = 'Delete a Catalog Entity

Official Rootly endpoint: DELETE /v1/catalog_entities/{id}

Delete a specific Catalog Entity by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/catalog_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
