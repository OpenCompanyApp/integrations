<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Remove a status page from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/status_pages/{status_page_id}.
 */
class FireHydrantDeleteIncidentStatusPage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_status_page';
    protected const DESCRIPTION = 'Remove a status page from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/status_pages/{status_page_id}

Remove a status page incident attached to an incident';
    protected const PARAMETERS = array (
  'status_page_id' =>
  array (
    'type' => 'string',
    'description' => 'status_page_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/status_pages/{status_page_id}';
    protected const PATH_PARAMS = array (
  'status_page_id' => 'status_page_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
