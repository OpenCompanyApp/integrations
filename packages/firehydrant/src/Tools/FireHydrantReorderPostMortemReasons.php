<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Reorder a contributing factor for a retrospective report.
 *
 * Maps to the official FireHydrant endpoint put /v1/post_mortems/reports/{report_id}/reasons/order.
 */
class FireHydrantReorderPostMortemReasons extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_reorder_post_mortem_reasons';
    protected const DESCRIPTION = 'Reorder a contributing factor for a retrospective report

Official FireHydrant endpoint: PUT /v1/post_mortems/reports/{report_id}/reasons/order

Update the order of contributing factors in a retrospective report';
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
    protected const METHOD = 'put';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/reasons/order';
    protected const PATH_PARAMS = array (
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
