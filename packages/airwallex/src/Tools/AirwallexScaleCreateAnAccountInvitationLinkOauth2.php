<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Account Links > Create an account invitation link - oauth2.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/accounts/invitation_links/create.
 */
class AirwallexScaleCreateAnAccountInvitationLinkOauth2 extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_create_an_account_invitation_link_oauth2';
    protected const DESCRIPTION = 'Scale > Account Links > Create an account invitation link - oauth2.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/invitation_links/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/accounts/invitation_links/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
