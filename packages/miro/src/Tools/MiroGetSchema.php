<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieve information about how users, groups, and enterprise-user attributes URIs that are formatted..
 *
 * Maps to the official Miro endpoint GET /Schemas/{uri}.
 */
class MiroGetSchema extends AbstractMiroTool
{
    protected const NAME = 'miro_get_schema';
    protected const DESCRIPTION = 'Retrieve information about how users, groups, and enterprise-user attributes URIs that are formatted.

Official Miro endpoint: GET /Schemas/{uri}.';
    protected const PARAMETERS = array (
      'uri' => array (
        'type' => 'string',
        'description' => 'Schema URI of a particular resource type.',
        'required' => true,
        'enum' => array (
          'urn:ietf:params:scim:schemas:core:2.0:User',
          'urn:ietf:params:scim:schemas:core:2.0:Group',
          'urn:ietf:params:scim:schemas:extension:enterprise:2.0:User',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/Schemas/{uri}';
    protected const PATH_PARAMS = array (
      'uri' => 'uri',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
