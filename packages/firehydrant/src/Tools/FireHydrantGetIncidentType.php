<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an incident type.
 *
 * Maps to the official FireHydrant endpoint get /v1/incident_types/{id}.
 */
class FireHydrantGetIncidentType extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_type';
    protected const DESCRIPTION = 'Get an incident type

Official FireHydrant endpoint: GET /v1/incident_types/{id}

Retrieve a single incident type from its ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
