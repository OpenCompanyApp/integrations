<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get check status badge. You can enable the badges feature in account settings.
 *
 * Maps to the official Checkly endpoint GET /v1/badges/checks/{checkId}.
 */
class ChecklyGetV1BadgesChecksCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_badges_checks_checkid';
    protected const DESCRIPTION = 'Get check status badge. You can enable the badges feature in account settings

Official Checkly endpoint: GET /v1/badges/checks/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'style' => array (
        'type' => 'string',
        'description' => 'style parameter.',
        'required' => false,
        'enum' => array (
          'flat',
          'plastic',
          'flat-square',
          'for-the-badge',
          'social',
        ),
      ),
      'theme' => array (
        'type' => 'string',
        'description' => 'theme parameter.',
        'required' => false,
        'enum' => array (
          'light',
          'dark',
          'default',
        ),
      ),
      'response_time' => array (
        'type' => 'boolean',
        'description' => 'responseTime parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/badges/checks/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'style' => 'style',
      'theme' => 'theme',
      'responseTime' => 'response_time',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
