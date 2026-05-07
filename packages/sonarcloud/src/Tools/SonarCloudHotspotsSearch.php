<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for Security Hotpots..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/hotspots/search.
 */
class SonarCloudHotspotsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_hotspots_search';
    protected const DESCRIPTION = 'Search for Security Hotpots.

Official SonarCloud Web API endpoint: GET /api/hotspots/search.';
    protected const PARAMETERS = array (
      'file_uuids' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of file uuids. Returns only hotspots found in those files. If set, \'files\' must not be set.',
        'required' => false,
      ),
      'files' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of file paths. Returns only hotspots found in those files. If set, \'fileUuids\' must not be set.',
        'required' => false,
      ),
      'hotspots' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of Security Hotspot keys. This parameter is required unless projectKey is provided.',
        'required' => false,
      ),
      'only_mine' => array (
        'type' => 'string',
        'description' => 'If \'projectKey\' is provided, returns only Security Hotspots assigned to the current user',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Key of the project or application. This parameter is required unless hotspots is provided.',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0.',
        'required' => false,
      ),
      'resolution' => array (
        'type' => 'string',
        'description' => 'If \'projectKey\' is provided and if status is \'REVIEWED\', only Security Hotspots with the specified resolution are returned.',
        'required' => false,
        'enum' => array (
          'FIXED',
          'SAFE',
        ),
      ),
      'since_leak_period' => array (
        'type' => 'string',
        'description' => 'If \'%s\' is provided, only Security Hotspots created since the leak period are returned.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'If \'projectKey\' is provided, only Security Hotspots with the specified status are returned.',
        'required' => false,
        'enum' => array (
          'TO_REVIEW',
          'REVIEWED',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/hotspots/search';
    protected const PARAM_MAP = array (
      'fileUuids' => 'file_uuids',
      'files' => 'files',
      'hotspots' => 'hotspots',
      'onlyMine' => 'only_mine',
      'p' => 'p',
      'projectKey' => 'project_key',
      'ps' => 'ps',
      'resolution' => 'resolution',
      'sinceLeakPeriod' => 'since_leak_period',
      'status' => 'status',
    );
}
