<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes a contact group with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /contact-groups/{group_id}.
 */
class StatusCakeDeleteContactGroup extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_contact_group';
    protected const DESCRIPTION = 'Deletes a contact group with the given id.

Official StatusCake endpoint: DELETE /contact-groups/{group_id}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'string',
        'description' => 'Contact group ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
