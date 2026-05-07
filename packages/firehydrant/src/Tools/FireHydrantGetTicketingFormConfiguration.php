<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get the ticketing form configuration.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/form_configurations.
 */
class FireHydrantGetTicketingFormConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ticketing_form_configuration';
    protected const DESCRIPTION = 'Get the ticketing form configuration

Official FireHydrant endpoint: GET /v1/ticketing/form_configurations

Get the ticketing form configuration';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/form_configurations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
