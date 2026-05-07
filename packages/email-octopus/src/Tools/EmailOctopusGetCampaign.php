<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Get one EmailOctopus campaign. */
class EmailOctopusGetCampaign extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_get_campaign';
    protected const DESCRIPTION = 'Get one EmailOctopus campaign by ID.';
    protected const METHOD = 'getCampaign';
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID.']];
}
