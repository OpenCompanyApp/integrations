<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a quality profile. Requires to be logged in and the 'Administer Quality Profiles' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualityprofiles/create.
 */
class SonarQubeQualityprofilesCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_create';
    protected const DESCRIPTION = 'Create a quality profile. Requires to be logged in and the \'Administer Quality Profiles\' permission.

Official SonarQube Web API endpoint: POST /api/qualityprofiles/create.';
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
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/create';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'name' => 'name',
    );
}
