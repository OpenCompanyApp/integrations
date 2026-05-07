<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Automation Create Automation From Guide tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutAutomationCreateAutomationFromGuide extends AbstractVboutOperationTool
{
    protected const OPERATION = 'automation_create_automation_from_guide';
}