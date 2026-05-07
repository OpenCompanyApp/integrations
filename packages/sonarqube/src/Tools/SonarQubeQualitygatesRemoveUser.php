<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove the ability from an user to edit a Quality Gate. Requires one of the following permissions: - 'Administer Quality Gates'; - Edit right on the specified quality gate;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/remove_user.
 */
class SonarQubeQualitygatesRemoveUser extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_remove_user';
    protected const DESCRIPTION = 'Remove the ability from an user to edit a Quality Gate. Requires one of the following permissions: - \'Administer Quality Gates\'; - Edit right on the specified quality gate;

Official SonarQube Web API endpoint: POST /api/qualitygates/remove_user.';
    protected const PARAMETERS = array (
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Quality Gate name',
        'required' => true,
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/remove_user';
    protected const PARAM_MAP = array (
      'gateName' => 'gate_name',
      'login' => 'login',
    );
}
