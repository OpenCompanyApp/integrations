<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Change a quality profile's parent. Requires one of the following permissions: - 'Administer Quality Profiles'; - Edit right on the specified quality profile;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/change_parent.
 */
class SonarQubeQualityprofilesChangeParent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_change_parent';
    protected const DESCRIPTION = 'Change a quality profile\'s parent. Requires one of the following permissions: - \'Administer Quality Profiles\'; - Edit right on the specified quality profile;

Official SonarQube Web API endpoint: POST /api/qualityprofiles/change_parent.';
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
      'parent_quality_profile' => array (
        'type' => 'string',
        'description' => 'New parent profile name. If no profile is provided, the inheritance link with current parent profile (if any) is broken, which deactivates all rules which come from the parent and are not overridden.',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/change_parent';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'parentQualityProfile' => 'parent_quality_profile',
      'qualityProfile' => 'quality_profile',
    );
}
