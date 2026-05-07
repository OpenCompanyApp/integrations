<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create a destination.
 *
 * Maps to the official Airbyte endpoint post /destinations.
 */
class AirbyteCreateDestination extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_destination';
    protected const DESCRIPTION = 'Create a destination

Official Airbyte endpoint: POST /destinations

Creates a destination given a name, workspace id, and a json blob containing the configuration for the source.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/destinations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
