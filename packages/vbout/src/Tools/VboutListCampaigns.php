<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * List Campaigns tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutListCampaigns extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_campaigns';
}