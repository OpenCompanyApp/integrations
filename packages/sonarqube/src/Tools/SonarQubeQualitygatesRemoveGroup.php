<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove the ability from a group to edit a Quality Gate. Requires one of the following permissions: - 'Administer Quality Gates'; - Edit right on the specified quality gate;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/remove_group.
 */
class SonarQubeQualitygatesRemoveGroup extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_remove_group';
    protected const DESCRIPTION = 'Remove the ability from a group to edit a Quality Gate. Requires one of the following permissions: - \'Administer Quality Gates\'; - Edit right on the specified quality gate;

Official SonarQube Web API endpoint: POST /api/qualitygates/remove_group.';
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
    protected const PATH = '/api/qualitygates/remove_group';
    protected const PARAM_MAP = array (
      'gateName' => 'gate_name',
      'groupName' => 'group_name',
    );
}
