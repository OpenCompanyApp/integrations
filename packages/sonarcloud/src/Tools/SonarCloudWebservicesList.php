<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List web services.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/webservices/list.
 */
class SonarCloudWebservicesList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webservices_list';
    protected const DESCRIPTION = 'List web services

Official SonarCloud Web API endpoint: GET /api/webservices/list.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/webservices/list';
    protected const PARAM_MAP = array (
);
}
