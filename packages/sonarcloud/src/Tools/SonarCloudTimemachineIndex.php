<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * The web service is removed and you're invited to use api/measures/search_history instead.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/timemachine/index.
 */
class SonarCloudTimemachineIndex extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_timemachine_index';
    protected const DESCRIPTION = 'The web service is removed and you\'re invited to use api/measures/search_history instead

Official SonarCloud Web API endpoint: GET /api/timemachine/index.

Deprecated since SonarCloud 6.3; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/timemachine/index';
    protected const PARAM_MAP = array (
);
}
