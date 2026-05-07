<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Edit Campaign tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingEditCampaign extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_edit_campaign';
}