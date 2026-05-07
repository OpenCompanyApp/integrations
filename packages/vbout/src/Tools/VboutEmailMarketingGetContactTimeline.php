<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Contact Timeline tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingGetContactTimeline extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_get_contact_timeline';
}