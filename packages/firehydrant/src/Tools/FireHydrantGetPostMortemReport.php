<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a retrospective report.
 *
 * Maps to the official FireHydrant endpoint get /v1/post_mortems/reports/{report_id}.
 */
class FireHydrantGetPostMortemReport extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_post_mortem_report';
    protected const DESCRIPTION = 'Get a retrospective report

Official FireHydrant endpoint: GET /v1/post_mortems/reports/{report_id}

Get a report';
    protected const PARAMETERS = array (
  'report_id' =>
  array (
    'type' => 'string',
    'description' => 'report_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/reports/{report_id}';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
