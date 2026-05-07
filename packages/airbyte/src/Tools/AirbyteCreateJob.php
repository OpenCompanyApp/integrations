<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Trigger a sync or reset job of a connection.
 *
 * Maps to the official Airbyte endpoint post /jobs.
 */
class AirbyteCreateJob extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_job';
    protected const DESCRIPTION = 'Trigger a sync or reset job of a connection

Official Airbyte endpoint: POST /jobs';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/jobs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
