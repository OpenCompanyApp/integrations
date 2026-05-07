<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a contributing factor for a retrospective report.
 *
 * Maps to the official FireHydrant endpoint post /v1/post_mortems/reports/{report_id}/reasons.
 */
class FireHydrantCreatePostMortemReason extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_post_mortem_reason';
    protected const DESCRIPTION = 'Create a contributing factor for a retrospective report

Official FireHydrant endpoint: POST /v1/post_mortems/reports/{report_id}/reasons

Add a new contributing factor to an incident';
    protected const PARAMETERS = array (
  'report_id' =>
  array (
    'type' => 'string',
    'description' => 'report_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/reasons';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
