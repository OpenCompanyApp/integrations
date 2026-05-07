<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an incident type.
 *
 * Maps to the official FireHydrant endpoint post /v1/incident_types.
 */
class FireHydrantCreateIncidentType extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_type';
    protected const DESCRIPTION = 'Create an incident type

Official FireHydrant endpoint: POST /v1/incident_types

Create a new incident type';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
