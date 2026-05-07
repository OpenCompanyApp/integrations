<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Get an Ashby offer. */
class AshbyGetOffer extends AbstractAshbyTool
{
    protected const NAME = 'ashby_get_offer';
    protected const DESCRIPTION = 'Get an Ashby offer by offer ID.';
    protected const ENDPOINT = '/offer.info';
    protected const REQUIRED = ['offerId'];
    protected const BODY_KEYS = ['offerId'];
    protected const PARAMETERS = [
        'offerId' => ['type' => 'string', 'required' => true, 'description' => 'Offer UUID.'],
    ];
}
