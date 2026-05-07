<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby opening. */
class AshbyCreateOpening extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_opening';
    protected const DESCRIPTION = 'Create an opening for an Ashby job.';
    protected const ENDPOINT = '/opening.create';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw opening.create body.'],
    ];
}
