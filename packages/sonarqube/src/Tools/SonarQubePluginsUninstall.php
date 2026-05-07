<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Uninstalls the plugin specified by its key. Requires user to be authenticated with Administer System permissions..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/plugins/uninstall.
 */
class SonarQubePluginsUninstall extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_uninstall';
    protected const DESCRIPTION = 'Uninstalls the plugin specified by its key. Requires user to be authenticated with Administer System permissions.

Official SonarQube Web API endpoint: POST /api/plugins/uninstall.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'The key identifying the plugin to uninstall',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/plugins/uninstall';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
