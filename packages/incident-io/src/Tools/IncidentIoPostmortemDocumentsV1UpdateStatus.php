<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateStatus PostmortemDocuments V1.
 *
 * Maps to the official incident.io endpoint put /v1/postmortem_documents/{id}.
 */
class IncidentIoPostmortemDocumentsV1UpdateStatus extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_postmortem_documents_v1_update_status';
    protected const DESCRIPTION = 'UpdateStatus PostmortemDocuments V1

Official incident.io endpoint: PUT /v1/postmortem_documents/{id}

Update the status of a post-mortem document.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the post-mortem document',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/postmortem_documents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
