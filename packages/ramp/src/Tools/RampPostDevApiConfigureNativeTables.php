<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Extend Native Ramp table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/configure/native-tables.
 */
class RampPostDevApiConfigureNativeTables extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_configure_native_tables';
    protected const DESCRIPTION = 'Extend Native Ramp table

Official Ramp endpoint: POST /developer/v1/custom-records/configure/native-tables';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/configure/native-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
