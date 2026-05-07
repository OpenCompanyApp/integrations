<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive an incident type.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incident_types/{id}.
 */
class FireHydrantDeleteIncidentType extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_type';
    protected const DESCRIPTION = 'Archive an incident type

Official FireHydrant endpoint: DELETE /v1/incident_types/{id}

Archives an incident type which will hide it from lists and metrics';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
