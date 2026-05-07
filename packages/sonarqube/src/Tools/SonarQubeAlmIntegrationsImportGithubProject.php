<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a SonarQube project with the information from the provided GitHub repository. Autoconfigure pull request decoration mechanism. If Automatic Provisioning is enable for GitHub, it will also synchronize permissions from the repository. Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_integrations/import_github_project.
 */
class SonarQubeAlmIntegrationsImportGithubProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_import_github_project';
    protected const DESCRIPTION = 'Create a SonarQube project with the information from the provided GitHub repository. Autoconfigure pull request decoration mechanism. If Automatic Provisioning is enable for GitHub, it will also synchronize permissions from the repository. Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: POST /api/alm_integrations/import_github_project.

Deprecated since SonarQube 10.5; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform configuration key. This parameter is optional if you have only one GitHub integration.',
        'required' => false,
      ),
      'new_code_definition_type' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Type New code definitions of the following types are allowed:- PREVIOUS_VERSION; - NUMBER_OF_DAYS; - REFERENCE_BRANCH - will default to the main branch.;',
        'required' => false,
      ),
      'new_code_definition_value' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Value For each new code definition type, a different value is expected:- no value, when the new code definition type is PREVIOUS_VERSION and REFERENCE_BRANCH; - a number between 1 and 90, when the new code definition type is NUMBER_OF_DAYS;',
        'required' => false,
      ),
      'repository_key' => array (
        'type' => 'string',
        'description' => 'GitHub repository key (organization/repoSlug',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_integrations/import_github_project';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'newCodeDefinitionType' => 'new_code_definition_type',
      'newCodeDefinitionValue' => 'new_code_definition_value',
      'repositoryKey' => 'repository_key',
    );
}
