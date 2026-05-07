<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Export a quality profile..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/export.
 */
class SonarQubeQualityprofilesExport extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_export';
    protected const DESCRIPTION = 'Export a quality profile.

Official SonarQube Web API endpoint: GET /api/qualityprofiles/export.

Deprecated since SonarQube 25.4; kept for API parity with servers that still expose it.';
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
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name to export. If left empty, the default profile for the language is exported.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/export';
    protected const PARAM_MAP = array (
      'language' => 'language',
      'qualityProfile' => 'quality_profile',
    );
}
