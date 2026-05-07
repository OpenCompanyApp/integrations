<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListPaths Escalations V2.
 *
 * Maps to the official incident.io endpoint get /v2/escalation_paths.
 */
class IncidentIoEscalationsV2ListPaths extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_list_paths';
    protected const DESCRIPTION = 'ListPaths Escalations V2

Official incident.io endpoint: GET /v2/escalation_paths

List all escalation paths in your account.

An escalation path is a series of steps that describe how a page should be escalated,
represented as a graph, supporting conditional branches based on alert priority and
working intervals.';
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
    protected const PATH = '/v2/escalation_paths';
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
