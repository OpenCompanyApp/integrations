<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update identity provider information. It's only possible to migrate to an installed identity provider. Be careful that as soon as this information has been updated for a user, the user will only be able to authenticate on the new identity provider. It is not possible to migrate external user to local one. Requires Administer System permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/update_identity_provider.
 */
class SonarQubeUsersUpdateIdentityProvider extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_update_identity_provider';
    protected const DESCRIPTION = 'Update identity provider information. It\'s only possible to migrate to an installed identity provider. Be careful that as soon as this information has been updated for a user, the user will only be able to authenticate on the new identity provider. It is not possible to migrate external user to local one. Requires Administer System permission.

Official SonarQube Web API endpoint: POST /api/users/update_identity_provider.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'new_external_identity' => array (
        'type' => 'string',
        'description' => 'New external identity, usually the login used in the authentication system. If not provided previous identity will be used.',
        'required' => false,
      ),
      'new_external_provider' => array (
        'type' => 'string',
        'description' => 'New external provider. Only authentication system installed are available. Use \'LDAP\' identity provider for single server LDAP setup.Use \'LDAP_{serverKey}\' identity provider for multiple LDAP servers setup.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/update_identity_provider';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'newExternalIdentity' => 'new_external_identity',
      'newExternalProvider' => 'new_external_provider',
    );
}
