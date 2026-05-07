<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper opportunity loss reasons.
 */
class CopperListLossReasons extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_loss_reasons';

    protected string $toolDescription = 'List Copper opportunity loss reasons.';

    protected string $path = '/loss_reasons';
}
