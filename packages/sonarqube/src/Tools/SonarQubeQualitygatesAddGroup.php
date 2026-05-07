<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Allow a group of users to edit a Quality Gate. Requires one of the following permissions: - 'Administer Quality Gates'; - Edit right on the specified quality gate;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/add_group.
 */
class SonarQubeQualitygatesAddGroup extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_add_group';
    protected const DESCRIPTION = 'Allow a group of users to edit a Quality Gate. Requires one of the following permissions: - \'Administer Quality Gates\'; - Edit right on the specified quality gate;

Official SonarQube Web API endpoint: POST /api/qualitygates/add_group.';
    protected const PARAMETERS = array (
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Quality Gate name',
        'required' => true,
      ),
      'group_name' => array (
        'type' => 'string',
        'description' => 'Group name or \'anyone\' (case insensitive)',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/add_group';
    protected const PARAM_MAP = array (
      'gateName' => 'gate_name',
      'groupName' => 'group_name',
    );
}
