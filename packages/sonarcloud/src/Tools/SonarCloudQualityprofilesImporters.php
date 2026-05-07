<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Deprecated. No more custom profile importers..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/importers.
 */
class SonarCloudQualityprofilesImporters extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_importers';
    protected const DESCRIPTION = 'Deprecated. No more custom profile importers.

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/importers.

Deprecated since SonarCloud 18 March, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/importers';
    protected const PARAM_MAP = array (
);
}
