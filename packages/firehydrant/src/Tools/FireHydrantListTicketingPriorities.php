<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List ticketing priorities.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/priorities.
 */
class FireHydrantListTicketingPriorities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_ticketing_priorities';
    protected const DESCRIPTION = 'List ticketing priorities

Official FireHydrant endpoint: GET /v1/ticketing/priorities

List all ticketing priorities available to the organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/priorities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
