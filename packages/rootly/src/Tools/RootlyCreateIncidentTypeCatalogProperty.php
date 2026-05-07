<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Catalog Property.
 *
 * Maps to the official Rootly endpoint post /v1/incident_types/properties.
 */
class RootlyCreateIncidentTypeCatalogProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_type_catalog_property';
    protected const DESCRIPTION = 'Creates a Catalog Property

Official Rootly endpoint: POST /v1/incident_types/properties

Creates a new Catalog Property from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_types/properties';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
