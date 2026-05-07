<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Account Links > Get an account invitation link by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/accounts/invitation_links/{invitation_link_id}.
 */
class AirwallexScaleGetAnAccountInvitationLinkById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_get_an_account_invitation_link_by_id';
    protected const DESCRIPTION = 'Scale > Account Links > Get an account invitation link by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/accounts/invitation_links/{invitation_link_id}.';
    protected const PARAMETERS = [
        'invitation_link_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `invitation_link_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/accounts/invitation_links/{invitation_link_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'invitation_link_id' => 'invitation_link_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
