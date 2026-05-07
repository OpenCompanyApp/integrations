<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a retrospective field.
 *
 * Maps to the official FireHydrant endpoint patch /v1/post_mortems/reports/{report_id}/fields/{field_id}.
 */
class FireHydrantUpdatePostMortemField extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_post_mortem_field';
    protected const DESCRIPTION = 'Update a retrospective field

Official FireHydrant endpoint: PATCH /v1/post_mortems/reports/{report_id}/fields/{field_id}

Update a field value on a post mortem report';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/post_mortems/reports/{report_id}/fields/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
  'report_id' => 'report_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
