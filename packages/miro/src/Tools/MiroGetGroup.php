<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a single Group resource. Note: Along with groups (teams), the users that are part of those groups (teams) are also retrieved. Only users that have member role in the organization are fetched..
 *
 * Maps to the official Miro endpoint GET /Groups/{id}.
 */
class MiroGetGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_get_group';
    protected const DESCRIPTION = 'Retrieves a single Group resource. Note: Along with groups (teams), the users that are part of those groups (teams) are also retrieved. Only users that have member role in the organization are fetched.

Official Miro endpoint: GET /Groups/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'A server-assigned, unique identifier for this Group (team).',
        'required' => true,
      ),
      'attributes' => array (
        'type' => 'string',
        'description' => 'A comma-separated list of attribute names to return in the response. Example attributes: id,displayName Note: It is also possible to retrieve attributes within complex attributes. For example: members.display',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/Groups/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'attributes' => 'attributes',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
