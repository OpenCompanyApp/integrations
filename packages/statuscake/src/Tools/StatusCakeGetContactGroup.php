<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a contact group with the given id..
 *
 * Maps to the official StatusCake endpoint GET /contact-groups/{group_id}.
 */
class StatusCakeGetContactGroup extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_contact_group';
    protected const DESCRIPTION = 'Returns a contact group with the given id.

Official StatusCake endpoint: GET /contact-groups/{group_id}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'string',
        'description' => 'Contact group ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/contact-groups/{group_id}';
    protected const PATH_PARAMS = array (
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
