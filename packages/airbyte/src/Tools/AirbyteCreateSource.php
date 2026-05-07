<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create a source.
 *
 * Maps to the official Airbyte endpoint post /sources.
 */
class AirbyteCreateSource extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_source';
    protected const DESCRIPTION = 'Create a source

Official Airbyte endpoint: POST /sources

Creates a source given a name, workspace id, and a json blob containing the configuration for the source.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
