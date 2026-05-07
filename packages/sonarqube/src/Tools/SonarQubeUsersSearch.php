<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get a list of users. By default, only active users are returned. The following fields are only returned when user has Administer System permission or for logged-in in user : - 'email'; - 'externalIdentity'; - 'externalProvider'; - 'groups'; - 'lastConnectionDate'; - 'sonarLintLastConnectionDate'; - 'tokensCount'; Field 'lastConnectionDate' is only updated every hour, so it may not be accurate, for instance when a user authenticates many times in less than one hour..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/users/search.
 */
class SonarQubeUsersSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_search';
    protected const DESCRIPTION = 'Get a list of users. By default, only active users are returned. The following fields are only returned when user has Administer System permission or for logged-in in user : - \'email\'; - \'externalIdentity\'; - \'externalProvider\'; - \'groups\'; - \'lastConnectionDate\'; - \'sonarLintLastConnectionDate\'; - \'tokensCount\'; Field \'lastConnectionDate\' is only updated every hour, so it may not be accurate, for instance when a user authenticates many times in less than one hour.

Official SonarQube Web API endpoint: GET /api/users/search.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'deactivated' => array (
        'type' => 'string',
        'description' => 'Return deactivated users instead of active users',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'external_identity' => array (
        'type' => 'string',
        'description' => 'Find a user by its external identity (ie. its login in the Identity Provider). This is case sensitive and only available with Administer System permission.',
        'required' => false,
      ),
      'last_connected_after' => array (
        'type' => 'string',
        'description' => 'Filter the users based on the last connection date field. Only users who interacted with this instance at or after the date will be returned. The format must be ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hhmm)',
        'required' => false,
      ),
      'last_connected_before' => array (
        'type' => 'string',
        'description' => 'Filter the users based on the last connection date field. Only users that never connected or who interacted with this instance at or before the date will be returned. The format must be ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hhmm)',
        'required' => false,
      ),
      'managed' => array (
        'type' => 'string',
        'description' => 'Return managed or non-managed users. Only available for managed instances, throws for non-managed instances.',
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
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Filter on login, name and email. This parameter performs a partial match (contains), it is case insensitive.',
        'required' => false,
      ),
      'sl_last_connected_after' => array (
        'type' => 'string',
        'description' => 'Filter the users based on the sonar lint last connection date field Only users who interacted with this instance using SonarLint at or after the date will be returned. The format must be ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hhmm)',
        'required' => false,
      ),
      'sl_last_connected_before' => array (
        'type' => 'string',
        'description' => 'Filter the users based on the sonar lint last connection date field. Only users that never connected or who interacted with this instance using SonarLint at or before the date will be returned. The format must be ISO 8601 datetime format (YYYY-MM-DDThh:mm:ss±hhmm)',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/users/search';
    protected const PARAM_MAP = array (
      'deactivated' => 'deactivated',
      'externalIdentity' => 'external_identity',
      'lastConnectedAfter' => 'last_connected_after',
      'lastConnectedBefore' => 'last_connected_before',
      'managed' => 'managed',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'slLastConnectedAfter' => 'sl_last_connected_after',
      'slLastConnectedBefore' => 'sl_last_connected_before',
    );
}
