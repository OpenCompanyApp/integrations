<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List supported importers..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/importers.
 */
class SonarQubeQualityprofilesImporters extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_importers';
    protected const DESCRIPTION = 'List supported importers.

Official SonarQube Web API endpoint: GET /api/qualityprofiles/importers.

Deprecated since SonarQube 25.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/importers';
    protected const PARAM_MAP = array (
);
}
