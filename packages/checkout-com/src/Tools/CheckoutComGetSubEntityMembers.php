<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get sub-entity Members.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{entityId}/members.
 */
class CheckoutComGetSubEntityMembers extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_sub_entity_members';
    protected const DESCRIPTION = 'Beta Retrieve information on all users of a sub-entity that has been invited through Hosted Onboarding. Only one user can be invited to onboard the sub-entity through Hosted Onboarding. To enable the Hosted Onboarding feature, contact your Account Manager.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/members.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{entityId}/members';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
