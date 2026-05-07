<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateType Catalog V2.
 *
 * Maps to the official incident.io endpoint post /v2/catalog_types.
 */
class IncidentIoCatalogV2CreateType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_create_type';
    protected const DESCRIPTION = 'CreateType Catalog V2

Official incident.io endpoint: POST /v2/catalog_types

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
    protected const PATH = '/v2/catalog_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
