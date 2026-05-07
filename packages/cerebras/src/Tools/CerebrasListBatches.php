<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras batches.
 */
class CerebrasListBatches extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_batches';
    protected const DESCRIPTION = 'List Cerebras batches.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/batches';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
