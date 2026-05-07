<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Goal Edit tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutGoalEdit extends AbstractVboutOperationTool
{
    protected const OPERATION = 'goal_edit';
}