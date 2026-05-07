<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Sub-Status.
 *
 * Maps to the official Rootly endpoint put /v1/sub_statuses/{id}.
 */
class RootlyUpdateSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_sub_status';
    protected const DESCRIPTION = 'Update a Sub-Status

Official Rootly endpoint: PUT /v1/sub_statuses/{id}

Update a specific Sub-Status by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/sub_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
