<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident type.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_types/{id}.
 */
class RootlyDeleteIncidentType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_type';
    protected const DESCRIPTION = 'Delete an incident type

Official Rootly endpoint: DELETE /v1/incident_types/{id}

Delete a specific incident_type by id';
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
