<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Enable a license 7-days grace period if the Server ID is invalid. Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/editions/activate_grace_period.
 */
class SonarQubeEditionsActivateGracePeriod extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_editions_activate_grace_period';
    protected const DESCRIPTION = 'Enable a license 7-days grace period if the Server ID is invalid. Require \'Administer System\' permission.

Official SonarQube Web API endpoint: POST /api/editions/activate_grace_period.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/editions/activate_grace_period';
    protected const PARAM_MAP = array (
);
}
