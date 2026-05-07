<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Register a new API based accounting connection.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/connection.
 */
class RampPostAccountingConnectionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_accounting_connection_resource';
    protected const DESCRIPTION = 'Register a new API based accounting connection

Official Ramp endpoint: POST /developer/v1/accounting/connection

A connection is required in order to use our accounting API functionality. If a Universal CSV connection already exists, it will be upgraded to an API based connection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
