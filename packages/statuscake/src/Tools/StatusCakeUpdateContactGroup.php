<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Updates a contact group with the given parameters..
 *
 * Maps to the official StatusCake endpoint PUT /contact-groups/{group_id}.
 */
class StatusCakeUpdateContactGroup extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_update_contact_group';
    protected const DESCRIPTION = 'Updates a contact group with the given parameters.

Official StatusCake endpoint: PUT /contact-groups/{group_id}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'string',
        'description' => 'Contact group ID',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/contact-groups/{group_id}';
    protected const PATH_PARAMS = array (
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
