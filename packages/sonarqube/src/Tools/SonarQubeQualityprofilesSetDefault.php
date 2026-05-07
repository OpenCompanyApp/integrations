<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Select the default profile for a given language. Requires to be logged in and the 'Administer Quality Profiles' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/set_default.
 */
class SonarQubeQualityprofilesSetDefault extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_set_default';
    protected const DESCRIPTION = 'Select the default profile for a given language. Requires to be logged in and the \'Administer Quality Profiles\' permission.

Official SonarQube Web API endpoint: POST /api/qualityprofiles/set_default.';
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
    protected const PATH = '/api/qualityprofiles/set_default';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'qualityProfile' => 'quality_profile',
    );
}
