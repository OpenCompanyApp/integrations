<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /json/new.
 *
 * Maps to the official Browserless endpoint PUT /json/new.
 */
class BrowserlessPutJsonNew extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_put_json_new';
    protected const DESCRIPTION = '/json/new

Official Browserless endpoint: PUT /json/new.';
    protected const PARAMETERS = [];
    protected const METHOD = 'PUT';
    protected const PATH = '/json/new';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
