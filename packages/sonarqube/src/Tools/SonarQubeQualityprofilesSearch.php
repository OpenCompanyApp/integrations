<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search quality profiles.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/search.
 */
class SonarQubeQualityprofilesSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_search';
    protected const DESCRIPTION = 'Search quality profiles

Official SonarQube Web API endpoint: GET /api/qualityprofiles/search.';
    protected const PARAMETERS = array (
      'defaults' => array (
        'type' => 'string',
        'description' => 'If set to true, return only the quality profiles marked as default for each language',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'language' => array (
        'type' => 'string',
        'description' => 'Language key. If provided, only profiles for the given language are returned.',
        'required' => false,
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
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/search';
    protected const PARAM_MAP = array (
      'defaults' => 'defaults',
      'language' => 'language',
      'project' => 'project',
      'qualityProfile' => 'quality_profile',
    );
}
