<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Help admins to understand how much each project affects the total number of lines of code. Returns the list of projects together with information about their usage, sorted by lines of code descending. Requires Administer System permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/projects/license_usage.
 */
class SonarQubeProjectsLicenseUsage extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_license_usage';
    protected const DESCRIPTION = 'Help admins to understand how much each project affects the total number of lines of code. Returns the list of projects together with information about their usage, sorted by lines of code descending. Requires Administer System permission.

Official SonarQube Web API endpoint: GET /api/projects/license_usage.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/projects/license_usage';
    protected const PARAM_MAP = array (
);
}
