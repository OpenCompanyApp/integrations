<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List condition sets OAuth Scope: condition_sets:read.
 *
 * Executes the official beehiiv API operation conditionSets_index.
 */
class BeehiivConditionSetsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_condition_sets_index';
}
