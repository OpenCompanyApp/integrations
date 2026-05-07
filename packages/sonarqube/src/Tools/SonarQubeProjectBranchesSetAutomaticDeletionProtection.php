<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Protect a specific branch from automatic deletion. Protection can't be disabled for the main branch. Requires 'Administer' permission on the specified project or application..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_branches/set_automatic_deletion_protection.
 */
class SonarQubeProjectBranchesSetAutomaticDeletionProtection extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_branches_set_automatic_deletion_protection';
    protected const DESCRIPTION = 'Protect a specific branch from automatic deletion. Protection can\'t be disabled for the main branch. Requires \'Administer\' permission on the specified project or application.

Official SonarQube Web API endpoint: POST /api/project_branches/set_automatic_deletion_protection.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'value' => array (
        'type' => 'string',
        'description' => 'Sets whether the branch should be protected from automatic deletion when it hasn\'t been analyzed for a set period of time.',
        'required' => true,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_branches/set_automatic_deletion_protection';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
      'value' => 'value',
    );
}
