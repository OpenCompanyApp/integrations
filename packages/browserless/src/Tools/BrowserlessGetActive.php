<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /active.
 *
 * Maps to the official Browserless endpoint GET /active.
 */
class BrowserlessGetActive extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_active';
    protected const DESCRIPTION = '/active

Official Browserless endpoint: GET /active.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/active';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
