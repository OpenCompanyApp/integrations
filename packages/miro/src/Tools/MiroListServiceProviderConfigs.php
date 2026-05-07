<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieve supported operations and SCIM API basic configuration..
 *
 * Maps to the official Miro endpoint GET /ServiceProviderConfig.
 */
class MiroListServiceProviderConfigs extends AbstractMiroTool
{
    protected const NAME = 'miro_list_service_provider_configs';
    protected const DESCRIPTION = 'Retrieve supported operations and SCIM API basic configuration.

Official Miro endpoint: GET /ServiceProviderConfig.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/ServiceProviderConfig';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
