<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incident Attachments V1.
 *
 * Maps to the official incident.io endpoint post /v1/incident_attachments.
 */
class IncidentIoIncidentAttachmentsV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_attachments_v1_create';
    protected const DESCRIPTION = 'Create Incident Attachments V1

Official incident.io endpoint: POST /v1/incident_attachments

Attaches an external resource to an incident';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_attachments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
