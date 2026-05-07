<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a project's association with a quality profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile; - Administer right on the specified project;.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/remove_project.
 */
class SonarCloudQualityprofilesRemoveProject extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_remove_project';
    protected const DESCRIPTION = 'Remove a project\'s association with a quality profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile; - Administer right on the specified project;

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/remove_project.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality profile key. Mandatory unless \'qualityProfile\' and \'language\' are specified.',
        'required' => false,
      ),
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language. Mandatory if \'key\' is not set.',
        'required' => false,
        'enum' => array (
          'kubernetes',
          'css',
          'scala',
          'jsp',
          'py',
          'js',
          'plsql',
          'apex',
          'docker',
          'ansible',
          'rust',
          'dart',
          'jcl',
          'java',
          'web',
          'xml',
          'flex',
          'powershell',
          'json',
          'ipynb',
          'text',
          'vbnet',
          'azurepipelines',
          'cloudformation',
          'swift',
          'yaml',
          'cpp',
          'c',
          'kotlin',
          'rpg',
          'go',
          'vb',
          'tsql',
          'pli',
          'secrets',
          'ruby',
          'cs',
          'groovy',
          'cobol',
          'shell',
          'php',
          'terraform',
          'azureresourcemanager',
          'abap',
          'objc',
          'ts',
          'githubactions',
        ),
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'project_uuid' => array (
        'type' => 'string',
        'description' => 'Project ID. Either this parameter, or \'project\' must be set.',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. Mandatory if \'key\' is not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/remove_project';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'project' => 'project',
      'projectUuid' => 'project_uuid',
      'qualityProfile' => 'quality_profile',
    );
}
