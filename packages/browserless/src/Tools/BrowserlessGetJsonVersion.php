<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /json/version.
 *
 * Maps to the official Browserless endpoint GET /json/version.
 */
class BrowserlessGetJsonVersion extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_json_version';
    protected const DESCRIPTION = '/json/version

Official Browserless endpoint: GET /json/version.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/json/version';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
