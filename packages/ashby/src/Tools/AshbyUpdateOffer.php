<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby offer. */
class AshbyUpdateOffer extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_offer';
    protected const DESCRIPTION = 'Update an existing Ashby offer.';
    protected const ENDPOINT = '/offer.update';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw offer.update body.'],
    ];
}
