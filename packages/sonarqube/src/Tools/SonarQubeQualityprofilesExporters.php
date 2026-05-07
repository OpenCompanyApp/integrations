<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Deprecated. No more custom profile exporters..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/exporters.
 */
class SonarQubeQualityprofilesExporters extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_exporters';
    protected const DESCRIPTION = 'Deprecated. No more custom profile exporters.

Official SonarQube Web API endpoint: GET /api/qualityprofiles/exporters.

Deprecated since SonarQube 25.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/exporters';
    protected const PARAM_MAP = array (
);
}
