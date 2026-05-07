<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List ticketing custom fields.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/custom_fields/definitions.
 */
class FireHydrantListTicketingCustomDefinitions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_ticketing_custom_definitions';
    protected const DESCRIPTION = 'List ticketing custom fields

Official FireHydrant endpoint: GET /v1/ticketing/custom_fields/definitions

List all ticketing custom fields available to the organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/custom_fields/definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
