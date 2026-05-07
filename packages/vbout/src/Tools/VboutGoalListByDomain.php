<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Goal List By Domain tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutGoalListByDomain extends AbstractVboutOperationTool
{
    protected const OPERATION = 'goal_list_by_domain';
}