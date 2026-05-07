<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Creates a contact group with the given parameters..
 *
 * Maps to the official StatusCake endpoint POST /contact-groups.
 */
class StatusCakeCreateContactGroup extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_create_contact_group';
    protected const DESCRIPTION = 'Creates a contact group with the given parameters.

Official StatusCake endpoint: POST /contact-groups.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/contact-groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
