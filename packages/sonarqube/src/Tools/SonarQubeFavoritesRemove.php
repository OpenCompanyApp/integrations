<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a component (project, portfolio, application etc.) as favorite for the authenticated user. Requires authentication..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/favorites/remove.
 */
class SonarQubeFavoritesRemove extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_favorites_remove';
    protected const DESCRIPTION = 'Remove a component (project, portfolio, application etc.) as favorite for the authenticated user. Requires authentication.

Official SonarQube Web API endpoint: POST /api/favorites/remove.';
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
