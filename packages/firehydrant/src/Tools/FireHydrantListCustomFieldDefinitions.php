<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List custom field definitions.
 *
 * Maps to the official FireHydrant endpoint get /v1/custom_fields/definitions.
 */
class FireHydrantListCustomFieldDefinitions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_custom_field_definitions';
    protected const DESCRIPTION = 'List custom field definitions

Official FireHydrant endpoint: GET /v1/custom_fields/definitions

List all custom field definitions';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/custom_fields/definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
