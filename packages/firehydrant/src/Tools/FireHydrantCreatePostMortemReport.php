<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a retrospective report.
 *
 * Maps to the official FireHydrant endpoint post /v1/post_mortems/reports.
 */
class FireHydrantCreatePostMortemReport extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_post_mortem_report';
    protected const DESCRIPTION = 'Create a retrospective report

Official FireHydrant endpoint: POST /v1/post_mortems/reports

Create a report';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/post_mortems/reports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
