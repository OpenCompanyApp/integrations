<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieve information about which SCIM resources are supported. Currently, Miro supports Users and Groups as Resource Types..
 *
 * Maps to the official Miro endpoint GET /ResourceTypes.
 */
class MiroListResourceTypes extends AbstractMiroTool
{
    protected const NAME = 'miro_list_resource_types';
    protected const DESCRIPTION = 'Retrieve information about which SCIM resources are supported. Currently, Miro supports Users and Groups as Resource Types.

Official Miro endpoint: GET /ResourceTypes.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/ResourceTypes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
