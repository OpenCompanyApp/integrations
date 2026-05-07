<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a secret.
 *
 * Maps to the official Rootly endpoint post /v1/secrets.
 */
class RootlyCreateSecret extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_secret';
    protected const DESCRIPTION = 'Creates a secret

Official Rootly endpoint: POST /v1/secrets

Creates a new secret from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/secrets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
