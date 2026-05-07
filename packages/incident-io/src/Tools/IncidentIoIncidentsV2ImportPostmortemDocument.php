<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ImportPostmortemDocument Incidents V2.
 *
 * Maps to the official incident.io endpoint post /v2/incidents/{id}/actions/import_postmortem_document.
 */
class IncidentIoIncidentsV2ImportPostmortemDocument extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v2_import_postmortem_document';
    protected const DESCRIPTION = 'ImportPostmortemDocument Incidents V2

Official incident.io endpoint: POST /v2/incidents/{id}/actions/import_postmortem_document

Import a postmortem document from markdown into an incident.

The document content should be provided as GitHub-Flavored Markdown. It will be
parsed and converted into the collaborative editor format, and a new postmortem
document will be created for the incident.

If no main postmortem document exists for the incident, the imported document
will become the main document.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The unique identifier of the incident',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/incidents/{id}/actions/import_postmortem_document';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
