<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Contacts By Phone Number tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingGetContactsByPhoneNumber extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_get_contacts_by_phone_number';
}