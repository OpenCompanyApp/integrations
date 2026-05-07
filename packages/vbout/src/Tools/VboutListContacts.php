<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * List Contacts tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutListContacts extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_get_contacts';
}