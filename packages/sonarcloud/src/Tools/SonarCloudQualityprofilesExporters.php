<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Deprecated. No more custom profile exporters..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/exporters.
 */
class SonarCloudQualityprofilesExporters extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_exporters';
    protected const DESCRIPTION = 'Deprecated. No more custom profile exporters.

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/exporters.

Deprecated since SonarCloud 18 March, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/exporters';
    protected const PARAM_MAP = array (
);
}
