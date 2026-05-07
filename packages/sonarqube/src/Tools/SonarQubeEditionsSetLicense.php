<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set the license for enabling features of commercial editions. Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/editions/set_license.
 */
class SonarQubeEditionsSetLicense extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_editions_set_license';
    protected const DESCRIPTION = 'Set the license for enabling features of commercial editions. Require \'Administer System\' permission.

Official SonarQube Web API endpoint: POST /api/editions/set_license.

Deprecated since SonarQube 2025.6; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'license' => array (
        'type' => 'string',
        'description' => 'license parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/editions/set_license';
    protected const PARAM_MAP = array (
      'license' => 'license',
    );
}
