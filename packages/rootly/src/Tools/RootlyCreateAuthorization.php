<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an authorization.
 *
 * Maps to the official Rootly endpoint post /v1/authorizations.
 */
class RootlyCreateAuthorization extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_authorization';
    protected const DESCRIPTION = 'Creates an authorization

Official Rootly endpoint: POST /v1/authorizations

Creates a new authorization from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/authorizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
