<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a service.
 *
 * Maps to the official Rootly endpoint post /v1/services.
 */
class RootlyCreateService extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_service';
    protected const DESCRIPTION = 'Creates a service

Official Rootly endpoint: POST /v1/services

Creates a new service from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/services';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
