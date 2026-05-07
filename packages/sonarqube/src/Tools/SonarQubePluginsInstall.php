<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Installs the latest version of a plugin specified by its key. Plugin information is retrieved from Update Center. Fails if used on commercial editions or plugin risk consent has not been accepted. Requires user to be authenticated with Administer System permissions.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/plugins/install.
 */
class SonarQubePluginsInstall extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_install';
    protected const DESCRIPTION = 'Installs the latest version of a plugin specified by its key. Plugin information is retrieved from Update Center. Fails if used on commercial editions or plugin risk consent has not been accepted. Requires user to be authenticated with Administer System permissions

Official SonarQube Web API endpoint: POST /api/plugins/install.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'The key identifying the plugin to install',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/plugins/install';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
