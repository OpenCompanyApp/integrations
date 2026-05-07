<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Datasets.
 */
class FireworksAiListDatasets extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_datasets';
    protected const DESCRIPTION = 'List Datasets.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/datasets';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
