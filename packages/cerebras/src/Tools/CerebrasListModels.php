<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras models.
 */
class CerebrasListModels extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_models';
    protected const DESCRIPTION = 'List Cerebras models.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/models';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
