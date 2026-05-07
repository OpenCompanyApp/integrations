<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List dpo jobs.
 */
class FireworksAiListDpoJobs extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_dpo_jobs';
    protected const DESCRIPTION = 'List dpo jobs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/dpoJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
