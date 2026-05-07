<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Provide a brief for the current user (if any)..
 *
 * Maps to the official Cloudsmith endpoint get /user/self/.
 */
class CloudsmithUserSelf extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_user_self';
    protected const DESCRIPTION = 'Provide a brief for the current user (if any).

Official Cloudsmith endpoint: GET /user/self/

Provide a brief for the current user (if any).';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/user/self/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
