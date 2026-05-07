<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a project. If your project is hosted on a DevOps Platform, please use the import endpoint under api/alm_integrations, so it creates and properly configures the project.Requires 'Create Projects' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/projects/create.
 */
class SonarQubeProjectsCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_create';
    protected const DESCRIPTION = 'Create a project. If your project is hosted on a DevOps Platform, please use the import endpoint under api/alm_integrations, so it creates and properly configures the project.Requires \'Create Projects\' permission.

Official SonarQube Web API endpoint: POST /api/projects/create.';
    protected const PARAMETERS = array (
      'main_branch' => array (
        'type' => 'string',
        'description' => 'Key of the main branch of the project. If not provided, the default main branch key will be used.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the project. If name is longer than 500, it is abbreviated.',
        'required' => true,
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
      'project' => array (
        'type' => 'string',
        'description' => 'Key of the project',
        'required' => true,
      ),
      'visibility' => array (
        'type' => 'string',
        'description' => 'Whether the created project should be visible to everyone, or only specific user/groups. If no visibility is specified, the default project visibility will be used.',
        'required' => false,
        'enum' => array (
          'private',
          'public',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/create';
    protected const PARAM_MAP = array (
      'mainBranch' => 'main_branch',
      'name' => 'name',
      'newCodeDefinitionType' => 'new_code_definition_type',
      'newCodeDefinitionValue' => 'new_code_definition_value',
      'project' => 'project',
      'visibility' => 'visibility',
    );
}
