<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Cancels any operation pending on any plugin (install, update or uninstall) Requires user to be authenticated with Administer System permissions.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/plugins/cancel_all.
 */
class SonarQubePluginsCancelAll extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_cancel_all';
    protected const DESCRIPTION = 'Cancels any operation pending on any plugin (install, update or uninstall) Requires user to be authenticated with Administer System permissions

Official SonarQube Web API endpoint: POST /api/plugins/cancel_all.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/plugins/cancel_all';
    protected const PARAM_MAP = array (
);
}
