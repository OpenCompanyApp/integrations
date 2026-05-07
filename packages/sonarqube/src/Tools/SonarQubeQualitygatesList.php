<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get a list of quality gates.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/list.
 */
class SonarQubeQualitygatesList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_list';
    protected const DESCRIPTION = 'Get a list of quality gates

Official SonarQube Web API endpoint: GET /api/qualitygates/list.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/list';
    protected const PARAM_MAP = array (
);
}
