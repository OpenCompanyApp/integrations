<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby offer. */
class AshbyCreateOffer extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_offer';
    protected const DESCRIPTION = 'Create an Ashby offer from an offer process and form.';
    protected const ENDPOINT = '/offer.create';
    protected const REQUIRED = ['offerProcessId', 'offerFormId', 'offerForm'];
    protected const BODY_KEYS = ['offerProcessId', 'offerFormId', 'offerForm'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'offerProcessId' => ['type' => 'string', 'required' => true, 'description' => 'Offer process UUID.'],
        'offerFormId' => ['type' => 'string', 'required' => true, 'description' => 'Offer form UUID.'],
        'offerForm' => ['type' => 'object', 'required' => true, 'description' => 'Offer form values.'],
    ];
}
