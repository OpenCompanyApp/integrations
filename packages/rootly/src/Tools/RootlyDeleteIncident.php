<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident.
 *
 * Maps to the official Rootly endpoint delete /v1/incidents/{id}.
 */
class RootlyDeleteIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident';
    protected const DESCRIPTION = 'Delete an incident

Official Rootly endpoint: DELETE /v1/incidents/{id}

Delete a specific incident by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
