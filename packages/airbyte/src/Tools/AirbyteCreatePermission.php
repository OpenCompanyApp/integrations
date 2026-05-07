<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create a permission.
 *
 * Maps to the official Airbyte endpoint post /permissions.
 */
class AirbyteCreatePermission extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_permission';
    protected const DESCRIPTION = 'Create a permission

Official Airbyte endpoint: POST /permissions';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/permissions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
