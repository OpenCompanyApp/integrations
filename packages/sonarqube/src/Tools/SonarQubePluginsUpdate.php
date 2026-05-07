<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Updates a plugin specified by its key to the latest version compatible with the SonarQube instance. Plugin information is retrieved from Update Center. Requires user to be authenticated with Administer System permissions.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/plugins/update.
 */
class SonarQubePluginsUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_update';
    protected const DESCRIPTION = 'Updates a plugin specified by its key to the latest version compatible with the SonarQube instance. Plugin information is retrieved from Update Center. Requires user to be authenticated with Administer System permissions

Official SonarQube Web API endpoint: POST /api/plugins/update.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'The key identifying the plugin to update',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/plugins/update';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
