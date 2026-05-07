<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Projects.
 *
 * Maps to the official Browserbase endpoint GET /v1/projects.
 */
class BrowserbaseProjectsList extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_projects_list';
    protected const DESCRIPTION = 'List Projects

Official Browserbase endpoint: GET /v1/projects.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
