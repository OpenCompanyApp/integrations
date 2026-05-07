<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List contributing factors for a retrospective report.
 *
 * Maps to the official FireHydrant endpoint get /v1/post_mortems/reports/{report_id}/reasons.
 */
class FireHydrantListPostMortemReasons extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_post_mortem_reasons';
    protected const DESCRIPTION = 'List contributing factors for a retrospective report

Official FireHydrant endpoint: GET /v1/post_mortems/reports/{report_id}/reasons

List all contributing factors to an incident';
    protected const PARAMETERS = array (
  'report_id' =>
  array (
    'type' => 'string',
    'description' => 'report_id parameter.',
    'required' => true,
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/reasons';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
