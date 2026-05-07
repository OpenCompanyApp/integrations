<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieve metadata about Users, Groups, and extension attributes that are currently supported..
 *
 * Maps to the official Miro endpoint GET /Schemas.
 */
class MiroListSchemas extends AbstractMiroTool
{
    protected const NAME = 'miro_list_schemas';
    protected const DESCRIPTION = 'Retrieve metadata about Users, Groups, and extension attributes that are currently supported.

Official Miro endpoint: GET /Schemas.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/Schemas';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
