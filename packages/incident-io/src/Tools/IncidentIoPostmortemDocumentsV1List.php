<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List PostmortemDocuments V1.
 *
 * Maps to the official incident.io endpoint get /v1/postmortem_documents.
 */
class IncidentIoPostmortemDocumentsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_postmortem_documents_v1_list';
    protected const DESCRIPTION = 'List PostmortemDocuments V1

Official incident.io endpoint: GET /v1/postmortem_documents

List post-mortem documents for the organisation.

Results can be filtered by incident and sorted by creation date. This endpoint returns document
metadata only. If you want to fetch the content of the post-mortem, use the ShowContent endpoint.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'A post-mortem document\'s ID. This endpoint will return a list of post-mortem documents after this ID.',
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter to only return post-mortem documents for the given incident',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'description' => 'Controls the order that results are returned in',
    'enum' =>
    array (
      0 => 'created_at_newest_first',
      1 => 'created_at_oldest_first',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/postmortem_documents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'incident_id' => 'incident_id',
  'sort_by' => 'sort_by',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
