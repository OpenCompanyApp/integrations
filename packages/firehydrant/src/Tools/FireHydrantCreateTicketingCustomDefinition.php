<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a ticketing custom field.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/custom_fields/definitions.
 */
class FireHydrantCreateTicketingCustomDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_ticketing_custom_definition';
    protected const DESCRIPTION = 'Create a ticketing custom field

Official FireHydrant endpoint: POST /v1/ticketing/custom_fields/definitions

Creates a ticketing custom field for the organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/custom_fields/definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
