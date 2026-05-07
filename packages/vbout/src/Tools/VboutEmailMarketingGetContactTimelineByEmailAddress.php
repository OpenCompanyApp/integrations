<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Contact Timeline By Email Address tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingGetContactTimelineByEmailAddress extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_get_contact_timeline_by_email_address';
}