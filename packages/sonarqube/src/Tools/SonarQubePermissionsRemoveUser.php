<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove permission from a user. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. Requires one of the following permissions:- 'Administer System'; - 'Administer' rights on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/remove_user.
 */
class SonarQubePermissionsRemoveUser extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_remove_user';
    protected const DESCRIPTION = 'Remove permission from a user. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. Requires one of the following permissions:- \'Administer System\'; - \'Administer\' rights on the specified project;

Official SonarQube Web API endpoint: POST /api/permissions/remove_user.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'permission' => array (
        'type' => 'string',
        'description' => 'The permission you would like to revoke from the user.- Possible values for global permissions: admin, gateadmin, profileadmin, provisioning, scan, applicationcreator, portfoliocreator; - Possible values for project permissions admin, codeviewer, issueadmin, securityhotspotadmin, scan, user;',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project id',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/remove_user';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'permission' => 'permission',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
