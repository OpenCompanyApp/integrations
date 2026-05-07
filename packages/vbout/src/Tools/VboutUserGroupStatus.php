<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * User Group Status tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutUserGroupStatus extends AbstractVboutOperationTool
{
    protected const OPERATION = 'user_group_status';
}