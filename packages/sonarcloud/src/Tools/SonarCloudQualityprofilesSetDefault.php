<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Select the default profile for a given language. Requires to be logged in and the 'Administer Quality Profiles' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/set_default.
 */
class SonarCloudQualityprofilesSetDefault extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_set_default';
    protected const DESCRIPTION = 'Select the default profile for a given language. Requires to be logged in and the \'Administer Quality Profiles\' permission.

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/set_default.';
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
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. Mandatory if \'key\' is not set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/set_default';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'qualityProfile' => 'quality_profile',
    );
}
