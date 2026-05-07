<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Incident Attachments V1.
 *
 * Maps to the official incident.io endpoint delete /v1/incident_attachments/{id}.
 */
class IncidentIoIncidentAttachmentsV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_attachments_v1_delete';
    protected const DESCRIPTION = 'Delete Incident Attachments V1

Official incident.io endpoint: DELETE /v1/incident_attachments/{id}

Unattaches an external resource from an incident';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of this incident membership',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_attachments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
