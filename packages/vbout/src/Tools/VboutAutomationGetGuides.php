<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Automation Get Guides tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutAutomationGetGuides extends AbstractVboutOperationTool
{
    protected const OPERATION = 'automation_get_guides';
}