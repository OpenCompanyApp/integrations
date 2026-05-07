<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an incident type.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incident_types/{id}.
 */
class FireHydrantUpdateIncidentType extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_type';
    protected const DESCRIPTION = 'Update an incident type

Official FireHydrant endpoint: PATCH /v1/incident_types/{id}

Update a single incident type from its ID';
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
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incident_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
