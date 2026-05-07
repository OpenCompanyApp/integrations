<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Sub-Status.
 *
 * Maps to the official Rootly endpoint get /v1/sub_statuses/{id}.
 */
class RootlyGetSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_sub_status';
    protected const DESCRIPTION = 'Retrieves a Sub-Status

Official Rootly endpoint: GET /v1/sub_statuses/{id}

Retrieves a specific Sub-Status by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/sub_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
