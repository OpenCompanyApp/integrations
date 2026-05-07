<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List root portfolios. Requires authentication. Only portfolios with the admin permission are returned..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/views/list.
 */
class SonarQubeViewsList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_list';
    protected const DESCRIPTION = 'List root portfolios. Requires authentication. Only portfolios with the admin permission are returned.

Official SonarQube Web API endpoint: GET /api/views/list.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/views/list';
    protected const PARAM_MAP = array (
);
}
