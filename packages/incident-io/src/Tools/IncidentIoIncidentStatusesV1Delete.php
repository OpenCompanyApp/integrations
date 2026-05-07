<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Incident Statuses V1.
 *
 * Maps to the official incident.io endpoint delete /v1/incident_statuses/{id}.
 */
class IncidentIoIncidentStatusesV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_statuses_v1_delete';
    protected const DESCRIPTION = 'Delete Incident Statuses V1

Official incident.io endpoint: DELETE /v1/incident_statuses/{id}

Delete an incident status';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique ID of this incident status',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
