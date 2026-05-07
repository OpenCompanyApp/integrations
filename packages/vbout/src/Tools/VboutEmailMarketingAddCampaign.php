<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Add Campaign tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingAddCampaign extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_add_campaign';
}