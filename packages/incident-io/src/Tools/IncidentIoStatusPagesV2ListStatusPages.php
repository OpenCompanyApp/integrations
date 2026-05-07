<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListStatusPages Status Pages V2.
 *
 * Maps to the official incident.io endpoint get /v2/status_pages.
 */
class IncidentIoStatusPagesV2ListStatusPages extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_list_status_pages';
    protected const DESCRIPTION = 'ListStatusPages Status Pages V2

Official incident.io endpoint: GET /v2/status_pages

List all status pages for your organisation.

This endpoint requires a valid API key but no specific scopes. Use this to find status page IDs for use in other endpoints.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/status_pages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
