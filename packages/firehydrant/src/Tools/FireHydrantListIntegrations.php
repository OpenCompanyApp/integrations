<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List integrations.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations.
 */
class FireHydrantListIntegrations extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_integrations';
    protected const DESCRIPTION = 'List integrations

Official FireHydrant endpoint: GET /v1/integrations

Lists the available and configured integrations';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
