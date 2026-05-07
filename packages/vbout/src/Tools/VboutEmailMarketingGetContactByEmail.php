<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Contact By Email tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingGetContactByEmail extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_get_contact_by_email';
}