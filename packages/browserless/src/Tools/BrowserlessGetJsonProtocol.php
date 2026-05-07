<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /json/protocol.
 *
 * Maps to the official Browserless endpoint GET /json/protocol.
 */
class BrowserlessGetJsonProtocol extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_json_protocol';
    protected const DESCRIPTION = '/json/protocol

Official Browserless endpoint: GET /json/protocol.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/json/protocol';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
