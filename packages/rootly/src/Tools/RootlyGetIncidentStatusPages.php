<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident status page event.
 *
 * Maps to the official Rootly endpoint get /v1/status-page-events/{id}.
 */
class RootlyGetIncidentStatusPages extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_status_pages';
    protected const DESCRIPTION = 'Retrieves an incident status page event

Official Rootly endpoint: GET /v1/status-page-events/{id}

Retrieves a specific incident_status_page_event by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
