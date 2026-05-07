<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set the projects selection mode of a portfolio on manual selection. In order to add project, please use api/view/add_project. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/set_manual_mode.
 */
class SonarQubeViewsSetManualMode extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_set_manual_mode';
    protected const DESCRIPTION = 'Set the projects selection mode of a portfolio on manual selection. In order to add project, please use api/view/add_project. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/set_manual_mode.';
    protected const PARAMETERS = array (
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio or sub-portfolio to update',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/set_manual_mode';
    protected const PARAM_MAP = array (
      'portfolio' => 'portfolio',
    );
}
