<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * User Add tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutUserAdd extends AbstractVboutOperationTool
{
    protected const OPERATION = 'user_add';
}