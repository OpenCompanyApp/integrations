<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reinvite a sub-entity member.
 *
 * Maps to the official Checkout.com endpoint PUT /accounts/entities/{entityId}/members/{userId}.
 */
class CheckoutComReinviteSubEntityMembers extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reinvite_sub_entity_members';
    protected const DESCRIPTION = 'Beta Resend an invitation to the user of a sub-entity. The user will receive another email to continue their Hosted Onboarding application. An invitation can only be resent to the user originally registered to the sub-entity. To enable the Hosted Onboarding feature, contact your Account Manager.

Official Checkout.com endpoint: PUT /accounts/entities/{entityId}/members/{userId}.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
        'user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the invited user.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/accounts/entities/{entityId}/members/{userId}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'userId' => 'user_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
