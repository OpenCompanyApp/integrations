<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Create a quality profile. Requires to be logged in and the 'Administer Quality Profiles' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/create.
 */
class SonarCloudQualityprofilesCreate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_create';
    protected const DESCRIPTION = 'Create a quality profile. Requires to be logged in and the \'Administer Quality Profiles\' permission.

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/create.';
    protected const PARAMETERS = array (
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language',
        'required' => true,
        'enum' => array (
          'abap',
          'ansible',
          'apex',
          'azurepipelines',
          'azureresourcemanager',
          'c',
          'cloudformation',
          'cobol',
          'cpp',
          'cs',
          'css',
          'dart',
          'docker',
          'flex',
          'githubactions',
          'go',
          'groovy',
          'ipynb',
          'java',
          'jcl',
          'js',
          'json',
          'jsp',
          'kotlin',
          'kubernetes',
          'objc',
          'php',
          'pli',
          'plsql',
          'powershell',
          'py',
          'rpg',
          'ruby',
          'rust',
          'scala',
          'secrets',
          'shell',
          'swift',
          'terraform',
          'text',
          'ts',
          'tsql',
          'vb',
          'vbnet',
          'web',
          'xml',
          'yaml',
        ),
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Quality profile name',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/create';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'name' => 'name',
      'organization' => 'organization',
    );
}
