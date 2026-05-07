<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateType Catalog V3.
 *
 * Maps to the official incident.io endpoint post /v3/catalog_types.
 */
class IncidentIoCatalogV3CreateType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_create_type';
    protected const DESCRIPTION = 'CreateType Catalog V3

Official incident.io endpoint: POST /v3/catalog_types

Create a catalog type. The schema must be updated using the UpdateTypeSchema endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/catalog_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
