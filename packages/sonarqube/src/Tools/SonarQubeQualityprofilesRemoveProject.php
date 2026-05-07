<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a project's association with a quality profile. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile; - Administer right on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/remove_project.
 */
class SonarQubeQualityprofilesRemoveProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_remove_project';
    protected const DESCRIPTION = 'Remove a project\'s association with a quality profile. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile; - Administer right on the specified project;

Official SonarQube Web API endpoint: POST /api/qualityprofiles/remove_project.';
    protected const PARAMETERS = array (
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language.',
        'required' => true,
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
          'dart',
          'rust',
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
          'go',
          'kotlin',
          'rpg',
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
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/remove_project';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'project' => 'project',
      'qualityProfile' => 'quality_profile',
    );
}
