<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * User Edit tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutUserEdit extends AbstractVboutOperationTool
{
    protected const OPERATION = 'user_edit';
}