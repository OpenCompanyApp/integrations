<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create Custom Table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/configure/custom-tables.
 */
class RampPostDevApiConfigureCustomTables extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_configure_custom_tables';
    protected const DESCRIPTION = 'Create Custom Table

Official Ramp endpoint: POST /developer/v1/custom-records/configure/custom-tables';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/configure/custom-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
