<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * User Groups tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutUserGroups extends AbstractVboutOperationTool
{
    protected const OPERATION = 'user_groups';
}