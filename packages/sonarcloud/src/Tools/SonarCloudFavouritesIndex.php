<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * The web service is removed and you're invited to use api/favorites instead.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/favourites/index.
 */
class SonarCloudFavouritesIndex extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_favourites_index';
    protected const DESCRIPTION = 'The web service is removed and you\'re invited to use api/favorites instead

Official SonarCloud Web API endpoint: GET /api/favourites/index.

Deprecated since SonarCloud 6.3; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/favourites/index';
    protected const PARAM_MAP = array (
);
}
