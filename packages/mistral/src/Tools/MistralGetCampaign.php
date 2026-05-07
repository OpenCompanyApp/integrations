<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability campaign.
 */
class MistralGetCampaign extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_campaign';
    protected const DESCRIPTION = 'Get a Mistral observability campaign.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/campaigns/{campaign_id}';
    protected const PATH_PARAMS = ['campaign_id'];
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral campaign_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
