<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /meta.
 *
 * Maps to the official Browserless endpoint GET /meta.
 */
class BrowserlessGetMeta extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_meta';
    protected const DESCRIPTION = '/meta

Official Browserless endpoint: GET /meta.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/meta';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
