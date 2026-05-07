<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * This web service has no effect since 6.4. It's no more possible to restore built-in quality profiles because they are automatically updated and read only. Returns HTTP code 410..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualityprofiles/restore_built_in.
 */
class SonarCloudQualityprofilesRestoreBuiltIn extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_restore_built_in';
    protected const DESCRIPTION = 'This web service has no effect since 6.4. It\'s no more possible to restore built-in quality profiles because they are automatically updated and read only. Returns HTTP code 410.

Official SonarCloud Web API endpoint: POST /api/qualityprofiles/restore_built_in.

Deprecated since SonarCloud 6.4; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualityprofiles/restore_built_in';
    protected const PARAM_MAP = array (
);
}
