<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a quality profile and all its descendants. The default quality profile cannot be deleted. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/delete.
 */
class SonarQubeQualityprofilesDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_delete';
    protected const DESCRIPTION = 'Delete a quality profile and all its descendants. The default quality profile cannot be deleted. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarQube Web API endpoint: POST /api/qualityprofiles/delete.';
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
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/delete';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'qualityProfile' => 'quality_profile',
    );
}
