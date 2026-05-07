<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an On-Call Role.
 *
 * Maps to the official Rootly endpoint post /v1/on_call_roles.
 */
class RootlyCreateOnCallRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_on_call_role';
    protected const DESCRIPTION = 'Creates an On-Call Role

Official Rootly endpoint: POST /v1/on_call_roles

Creates a new On-Call Role from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/on_call_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
