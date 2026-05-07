<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Retrieve a list of API Requests that have been made..
 *
 * Maps to the official 1Password Connect endpoint GET /activity.
 */
class OnePasswordConnectGetApiActivity extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_api_activity';
    protected const DESCRIPTION = 'Retrieve a list of API Requests that have been made.

Official 1Password Connect endpoint: GET /activity.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'How many API Events should be retrieved in a single request.',
        'required' => false,
      ),
      'offset' => array (
        'type' => 'integer',
        'description' => 'How far into the collection of API Events should the response start',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/activity';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'offset' => 'offset',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
