<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Accounts.
 */
class FireworksAiListAccounts extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_accounts';
    protected const DESCRIPTION = 'List Accounts.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
