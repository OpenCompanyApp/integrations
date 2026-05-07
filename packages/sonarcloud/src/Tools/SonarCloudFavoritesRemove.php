<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a component (project, directory, file etc.) as favorite for the authenticated user. Requires authentication..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/favorites/remove.
 */
class SonarCloudFavoritesRemove extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_favorites_remove';
    protected const DESCRIPTION = 'Remove a component (project, directory, file etc.) as favorite for the authenticated user. Requires authentication.

Official SonarCloud Web API endpoint: POST /api/favorites/remove.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/favorites/remove';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
