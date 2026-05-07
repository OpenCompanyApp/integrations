<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get condition set OAuth Scope: condition_sets:read.
 *
 * Executes the official beehiiv API operation conditionSets_show.
 */
class BeehiivConditionSetsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_condition_sets_show';
}
