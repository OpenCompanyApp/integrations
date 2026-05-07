<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a contributing factor from a retrospective report.
 *
 * Maps to the official FireHydrant endpoint delete /v1/post_mortems/reports/{report_id}/reasons/{reason_id}.
 */
class FireHydrantDeletePostMortemReason extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_post_mortem_reason';
    protected const DESCRIPTION = 'Delete a contributing factor from a retrospective report

Official FireHydrant endpoint: DELETE /v1/post_mortems/reports/{report_id}/reasons/{reason_id}

Delete a contributing factor';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/reasons/{reason_id}';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
  'reason_id' => 'reason_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
