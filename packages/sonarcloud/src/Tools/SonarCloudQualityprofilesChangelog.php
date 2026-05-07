<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get the history of changes on a quality profile: rule activation/deactivation, change in parameters/severity. Events are ordered by date in descending order (most recent first)..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/changelog.
 */
class SonarCloudQualityprofilesChangelog extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_changelog';
    protected const DESCRIPTION = 'Get the history of changes on a quality profile: rule activation/deactivation, change in parameters/severity. Events are ordered by date in descending order (most recent first).

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/changelog.';
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
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'quality_profile' => array (
        'type' => 'string',
        'description' => 'Quality profile name. Mandatory if \'key\' is not set.',
        'required' => false,
      ),
      'since' => array (
        'type' => 'string',
        'description' => 'Start date for the changelog. Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'End date for the changelog. Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/changelog';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'language' => 'language',
      'organization' => 'organization',
      'p' => 'p',
      'ps' => 'ps',
      'qualityProfile' => 'quality_profile',
      'since' => 'since',
      'to' => 'to',
    );
}
