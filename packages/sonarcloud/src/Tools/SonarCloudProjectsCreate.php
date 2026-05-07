<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Create a project. Requires 'Create Projects' permission.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/create.
 */
class SonarCloudProjectsCreate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_create';
    protected const DESCRIPTION = 'Create a project. Requires \'Create Projects\' permission

Official SonarCloud Web API endpoint: POST /api/projects/create.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'SCM Branch of the project. The key of the project will become key:branch, for instance \'SonarQube:branch-5.0\'',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the project. If name is longer than 500, it is abbreviated.',
        'required' => true,
      ),
      'new_code_definition_type' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Type New code definitions of the following types are allowed:- previous_version; - days; - date; - version;',
        'required' => false,
      ),
      'new_code_definition_value' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Value For each new code definition type, a different value is expected:- value is \'previous_version\', when the new code definition type is previous_version; - value should be a date , when the new code definition type is date; - value should be version string, when the new code definition type is version; - value should be a number between 1 and 90, when the new code definition type is days;',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'The key of the organization',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Key of the project',
        'required' => true,
      ),
      'visibility' => array (
        'type' => 'string',
        'description' => 'Whether the created project should be visible to everyone, or only specific user/groups. If no visibility is specified, the default project visibility will be private for plans that allow private projects.',
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
      'branch' => 'branch',
      'name' => 'name',
      'newCodeDefinitionType' => 'new_code_definition_type',
      'newCodeDefinitionValue' => 'new_code_definition_value',
      'organization' => 'organization',
      'project' => 'project',
      'visibility' => 'visibility',
    );
}
