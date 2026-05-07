<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieve metadata for the available resource types (User and Group) that are supported..
 *
 * Maps to the official Miro endpoint GET /ResourceTypes/{resource}.
 */
class MiroGetResourceType extends AbstractMiroTool
{
    protected const NAME = 'miro_get_resource_type';
    protected const DESCRIPTION = 'Retrieve metadata for the available resource types (User and Group) that are supported.

Official Miro endpoint: GET /ResourceTypes/{resource}.';
    protected const PARAMETERS = array (
      'resource' => array (
        'type' => 'string',
        'description' => 'resource parameter.',
        'required' => true,
        'enum' => array (
          'User',
          'Group',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/ResourceTypes/{resource}';
    protected const PATH_PARAMS = array (
      'resource' => 'resource',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
