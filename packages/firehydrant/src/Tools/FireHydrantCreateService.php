<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a service.
 *
 * Maps to the official FireHydrant endpoint post /v1/services.
 */
class FireHydrantCreateService extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_service';
    protected const DESCRIPTION = 'Create a service

Official FireHydrant endpoint: POST /v1/services

Creates a service for the organization, you may also create or attach functionalities to the service on create.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
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
