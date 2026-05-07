<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Approve an Ashby offer or offer approval step. */
class AshbyApproveOffer extends AbstractAshbyTool
{
    protected const NAME = 'ashby_approve_offer';
    protected const DESCRIPTION = 'Approve an Ashby offer approval process or a specific approval step.';
    protected const ENDPOINT = '/offer.approve';
    protected const REQUIRED = ['offerVersionId'];
    protected const BODY_KEYS = ['offerVersionId', 'approvalStepId', 'userId'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'offerVersionId' => ['type' => 'string', 'required' => true, 'description' => 'Offer version UUID.'],
        'approvalStepId' => ['type' => 'string', 'description' => 'Approval step UUID.'],
        'userId' => ['type' => 'string', 'description' => 'Approving user UUID when approving a specific step.'],
    ];
}
