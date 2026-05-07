<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set the projects selection mode of a portfolio on unassociated projects in hierarchy. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/set_remaining_projects_mode.
 */
class SonarQubeViewsSetRemainingProjectsMode extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_set_remaining_projects_mode';
    protected const DESCRIPTION = 'Set the projects selection mode of a portfolio on unassociated projects in hierarchy. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/set_remaining_projects_mode.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Selects a branch in all matched projects, instead of using their main branches',
        'required' => false,
      ),
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio or sub-portfolio to update',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/set_remaining_projects_mode';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'portfolio' => 'portfolio',
    );
}
