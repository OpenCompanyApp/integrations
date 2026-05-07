<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Get Current User tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutGetCurrentUser extends AbstractVboutOperationTool
{
    protected const OPERATION = 'app_me';
}