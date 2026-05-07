<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Goal Lists tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutGoalLists extends AbstractVboutOperationTool
{
    protected const OPERATION = 'goal_lists';
}