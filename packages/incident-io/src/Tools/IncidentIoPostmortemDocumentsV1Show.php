<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show PostmortemDocuments V1.
 *
 * Maps to the official incident.io endpoint get /v1/postmortem_documents/{id}.
 */
class IncidentIoPostmortemDocumentsV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_postmortem_documents_v1_show';
    protected const DESCRIPTION = 'Show PostmortemDocuments V1

Official incident.io endpoint: GET /v1/postmortem_documents/{id}

Get a single post-mortem document by ID.

This returns the document\'s metadata. To retrieve the content of the post-mortem, use the ShowContent endpoint.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the post-mortem document',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/postmortem_documents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
