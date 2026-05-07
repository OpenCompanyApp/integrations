<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Deprecated. Use GET /api/qualityprofiles/backup instead.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/export.
 */
class SonarCloudQualityprofilesExport extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_export';
    protected const DESCRIPTION = 'Deprecated. Use GET /api/qualityprofiles/backup instead

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/export.

Deprecated since SonarCloud 18 March, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality profile key',
        'required' => false,
      ),
      'language' => array (
        'type' => 'string',
        'description' => 'Quality profile language',
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
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
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'qualityProfile' => 'quality_profile',
    );
}
