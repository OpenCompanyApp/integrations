<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident event functionalitu.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_event_services/{id}.
 */
class RootlyDeleteIncidentEventService extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_event_service';
    protected const DESCRIPTION = 'Delete an incident event functionalitu

Official Rootly endpoint: DELETE /v1/incident_event_services/{id}

Delete a specific incident event service by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_event_services/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
