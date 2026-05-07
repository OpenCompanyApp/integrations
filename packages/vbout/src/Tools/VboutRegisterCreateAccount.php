<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Register Create Account tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutRegisterCreateAccount extends AbstractVboutOperationTool
{
    protected const OPERATION = 'register_create_account';
}