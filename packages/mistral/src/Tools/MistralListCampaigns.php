<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral observability campaigns.
 */
class MistralListCampaigns extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_campaigns';
    protected const DESCRIPTION = 'List Mistral observability campaigns.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/campaigns';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
