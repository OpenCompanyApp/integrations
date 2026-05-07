<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List retrospective reports.
 *
 * Maps to the official FireHydrant endpoint get /v1/post_mortems/reports.
 */
class FireHydrantListPostMortemReports extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_post_mortem_reports';
    protected const DESCRIPTION = 'List retrospective reports

Official FireHydrant endpoint: GET /v1/post_mortems/reports

List all reports';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter the reports by an incident ID',
  ),
  'updated_since' =>
  array (
    'type' => 'string',
    'description' => 'Filter for reports updated after the given ISO8601 timestamp',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/reports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'incident_id' => 'incident_id',
  'updated_since' => 'updated_since',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
