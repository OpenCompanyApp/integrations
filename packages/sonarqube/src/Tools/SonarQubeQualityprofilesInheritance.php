<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Show a quality profile's ancestors and children..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/inheritance.
 */
class SonarQubeQualityprofilesInheritance extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_inheritance';
    protected const DESCRIPTION = 'Show a quality profile\'s ancestors and children.

Official SonarQube Web API endpoint: GET /api/qualityprofiles/inheritance.';
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
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/inheritance';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'qualityProfile' => 'quality_profile',
    );
}
