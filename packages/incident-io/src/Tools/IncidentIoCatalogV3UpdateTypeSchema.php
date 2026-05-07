<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateTypeSchema Catalog V3.
 *
 * Maps to the official incident.io endpoint post /v3/catalog_types/{id}/actions/update_schema.
 */
class IncidentIoCatalogV3UpdateTypeSchema extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_update_type_schema';
    protected const DESCRIPTION = 'UpdateTypeSchema Catalog V3

Official incident.io endpoint: POST /v3/catalog_types/{id}/actions/update_schema

Update an existing catalog types schema, adding or removing attributes.

Updating the schema is handled separately from creating and updating types, so that you don\'t
have to worry about dependencies between types. For example, if type A has an attribute that
relies on type B, you would have to create type B first.

By allowing the creation of types without a schema, they can be created in any order, but it
means that you need to make a separate call to this endpoint to update the schema.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog type',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/catalog_types/{id}/actions/update_schema';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
