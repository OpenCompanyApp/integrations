<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * This webservice is no more available : a default quality gate is mandatory..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/unset_default.
 */
class SonarCloudQualitygatesUnsetDefault extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_unset_default';
    protected const DESCRIPTION = 'This webservice is no more available : a default quality gate is mandatory.

Official SonarCloud Web API endpoint: POST /api/qualitygates/unset_default.

Deprecated since SonarCloud 7.0; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/unset_default';
    protected const PARAM_MAP = array (
);
}
