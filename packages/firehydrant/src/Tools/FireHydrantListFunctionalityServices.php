<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List services for a functionality.
 *
 * Maps to the official FireHydrant endpoint get /v1/functionalities/{functionality_id}/services.
 */
class FireHydrantListFunctionalityServices extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_functionality_services';
    protected const DESCRIPTION = 'List services for a functionality

Official FireHydrant endpoint: GET /v1/functionalities/{functionality_id}/services

List services for a functionality';
    protected const PARAMETERS = array (
  'functionality_id' =>
  array (
    'type' => 'string',
    'description' => 'functionality_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/functionalities/{functionality_id}/services';
    protected const PATH_PARAMS = array (
  'functionality_id' => 'functionality_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
