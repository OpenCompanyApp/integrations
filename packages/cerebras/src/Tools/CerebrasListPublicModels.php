<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List public Cerebras models.
 */
class CerebrasListPublicModels extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_public_models';
    protected const DESCRIPTION = 'List public Cerebras models.';
    protected const METHOD = 'GET';
    protected const PATH = '/public/v1/models';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
