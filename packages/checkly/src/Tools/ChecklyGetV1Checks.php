<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all current checks in your account..
 *
 * Maps to the official Checkly endpoint GET /v1/checks.
 */
class ChecklyGetV1Checks extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checks';
    protected const DESCRIPTION = 'Lists all current checks in your account.

Official Checkly endpoint: GET /v1/checks.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
      'api_check_url_filter_pattern' => array (
        'type' => 'string',
        'description' => 'Filters the results by a string contained in the URL of an API check, for instance a domain like "www.myapp.com". Only returns API checks.',
        'required' => false,
      ),
      'tag' => array (
        'type' => 'array',
        'description' => 'Filters checks by tags. Returns checks that have at least one of the specified tags.',
        'required' => false,
      ),
      'check_type' => array (
        'type' => 'string',
        'description' => 'Filters checks by type. Returns checks that match the specified type.',
        'required' => false,
        'enum' => array (
          'AGENTIC',
          'API',
          'BROWSER',
          'HEARTBEAT',
          'ICMP',
          'MULTI_STEP',
          'TCP',
          'PLAYWRIGHT',
          'URL',
          'DNS',
        ),
      ),
      'search' => array (
        'type' => 'string',
        'description' => 'Filters checks by name using a case-insensitive partial match.',
        'required' => false,
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'Filters checks by current status.',
        'required' => false,
        'enum' => array (
          'passing',
          'failing',
          'degraded',
        ),
      ),
      'apply_group_settings' => array (
        'type' => 'boolean',
        'description' => 'Checks that belong to a group are returned with group settings applied.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/checks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
      'apiCheckUrlFilterPattern' => 'api_check_url_filter_pattern',
      'tag' => 'tag',
      'checkType' => 'check_type',
      'search' => 'search',
      'status' => 'status',
      'applyGroupSettings' => 'apply_group_settings',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
