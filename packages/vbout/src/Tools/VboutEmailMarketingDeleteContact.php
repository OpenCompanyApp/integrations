<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Delete Contact tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingDeleteContact extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_delete_contact';
}