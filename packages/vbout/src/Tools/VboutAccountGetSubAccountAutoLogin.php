<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Account Subscriber Account Auto Login tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutAccountGetSubAccountAutoLogin extends AbstractVboutOperationTool
{
    protected const OPERATION = 'account_get_sub_account_auto_login';
}