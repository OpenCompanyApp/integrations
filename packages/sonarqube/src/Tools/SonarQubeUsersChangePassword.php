<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a user's password. Authenticated users can change their own password, provided that the account is not linked to an external authentication system. Administer System permission is required to change another user's password..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/change_password.
 */
class SonarQubeUsersChangePassword extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_change_password';
    protected const DESCRIPTION = 'Update a user\'s password. Authenticated users can change their own password, provided that the account is not linked to an external authentication system. Administer System permission is required to change another user\'s password.

Official SonarQube Web API endpoint: POST /api/users/change_password.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'password' => array (
        'type' => 'string',
        'description' => 'The password needs to fulfill the following requirements: at least 12 characters and contain at least one uppercase character, one lowercase character, one digit and one special character.',
        'required' => true,
      ),
      'previous_password' => array (
        'type' => 'string',
        'description' => 'Previous password. Required when changing one\'s own password.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/change_password';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'password' => 'password',
      'previousPassword' => 'previous_password',
    );
}
