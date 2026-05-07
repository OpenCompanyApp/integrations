<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Web Hook lists tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutWebHookLists extends AbstractVboutOperationTool
{
    protected const OPERATION = 'web_hook_lists';
}