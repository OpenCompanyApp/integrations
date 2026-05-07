<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a service.
 *
 * Maps to the official Rootly endpoint put /v1/services/{id}.
 */
class RootlyUpdateService extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_service';
    protected const DESCRIPTION = 'Update a service

Official Rootly endpoint: PUT /v1/services/{id}

Update a specific service by id';
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
    protected const PATH = '/v1/services/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
