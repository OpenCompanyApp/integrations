<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * This web service is removed.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/user_properties/index.
 */
class SonarCloudUserPropertiesIndex extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_properties_index';
    protected const DESCRIPTION = 'This web service is removed

Official SonarCloud Web API endpoint: GET /api/user_properties/index.

Deprecated since SonarCloud 6.3; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/user_properties/index';
    protected const PARAM_MAP = array (
);
}
