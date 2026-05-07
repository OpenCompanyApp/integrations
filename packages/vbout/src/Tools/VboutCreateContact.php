<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Create Contact tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutCreateContact extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_add_contact';
}