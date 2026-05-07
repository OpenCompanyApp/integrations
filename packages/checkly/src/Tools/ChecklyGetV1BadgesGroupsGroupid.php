<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get group status badge. You can enable the badges feature in account settings.
 *
 * Maps to the official Checkly endpoint GET /v1/badges/groups/{groupId}.
 */
class ChecklyGetV1BadgesGroupsGroupid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_badges_groups_groupid';
    protected const DESCRIPTION = 'Get group status badge. You can enable the badges feature in account settings

Official Checkly endpoint: GET /v1/badges/groups/{groupId}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'integer',
        'description' => 'groupId parameter.',
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
    protected const PATH = '/v1/badges/groups/{groupId}';
    protected const PATH_PARAMS = array (
      'groupId' => 'group_id',
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
