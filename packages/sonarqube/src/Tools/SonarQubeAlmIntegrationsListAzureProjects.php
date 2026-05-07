<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List Azure projects Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_integrations/list_azure_projects.
 */
class SonarQubeAlmIntegrationsListAzureProjects extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_list_azure_projects';
    protected const DESCRIPTION = 'List Azure projects Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: GET /api/alm_integrations/list_azure_projects.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform setting key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_integrations/list_azure_projects';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
    );
}
