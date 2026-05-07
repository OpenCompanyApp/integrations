<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident status page event.
 *
 * Maps to the official Rootly endpoint delete /v1/status-page-events/{id}.
 */
class RootlyDeleteIncidentStatusPage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_status_page';
    protected const DESCRIPTION = 'Delete an incident status page event

Official Rootly endpoint: DELETE /v1/status-page-events/{id}

Delete a specific incident status page event by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/status-page-events/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
