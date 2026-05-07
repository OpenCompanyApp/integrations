<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a contributing factor in a retrospective report.
 *
 * Maps to the official FireHydrant endpoint patch /v1/post_mortems/reports/{report_id}/reasons/{reason_id}.
 */
class FireHydrantUpdatePostMortemReason extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_post_mortem_reason';
    protected const DESCRIPTION = 'Update a contributing factor in a retrospective report

Official FireHydrant endpoint: PATCH /v1/post_mortems/reports/{report_id}/reasons/{reason_id}

Update a contributing factor';
    protected const PARAMETERS = array (
  'report_id' =>
  array (
    'type' => 'string',
    'description' => 'report_id parameter.',
    'required' => true,
  ),
  'reason_id' =>
  array (
    'type' => 'string',
    'description' => 'reason_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/reasons/{reason_id}';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
  'reason_id' => 'reason_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
