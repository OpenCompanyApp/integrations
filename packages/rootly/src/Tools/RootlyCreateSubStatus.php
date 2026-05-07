<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Sub-Status.
 *
 * Maps to the official Rootly endpoint post /v1/sub_statuses.
 */
class RootlyCreateSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_sub_status';
    protected const DESCRIPTION = 'Creates a Sub-Status

Official Rootly endpoint: POST /v1/sub_statuses

Creates a new Sub-Status from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/sub_statuses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
