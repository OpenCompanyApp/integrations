<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Bind a Azure DevOps instance to a project. If the project was already bound to a previous Azure DevOps instance, the binding will be updated to the new one.Requires the 'Administer' permission on the project.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/set_azure_binding.
 */
class SonarQubeAlmSettingsSetAzureBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_set_azure_binding';
    protected const DESCRIPTION = 'Bind a Azure DevOps instance to a project. If the project was already bound to a previous Azure DevOps instance, the binding will be updated to the new one.Requires the \'Administer\' permission on the project

Official SonarQube Web API endpoint: POST /api/alm_settings/set_azure_binding.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'Azure DevOps setting key',
        'required' => true,
      ),
      'inline_annotations_enabled' => array (
        'type' => 'string',
        'description' => 'Enable inline annotations during Pull Request decoration for this project',
        'required' => false,
      ),
      'monorepo' => array (
        'type' => 'string',
        'description' => 'Is this project part of a monorepo',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'SonarQube project key',
        'required' => true,
      ),
      'project_name' => array (
        'type' => 'string',
        'description' => 'Azure project name',
        'required' => true,
      ),
      'repository_name' => array (
        'type' => 'string',
        'description' => 'Azure repository name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/set_azure_binding';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'inlineAnnotationsEnabled' => 'inline_annotations_enabled',
      'monorepo' => 'monorepo',
      'project' => 'project',
      'projectName' => 'project_name',
      'repositoryName' => 'repository_name',
    );
}
