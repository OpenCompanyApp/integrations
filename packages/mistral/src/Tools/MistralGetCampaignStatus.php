<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get status for a Mistral observability campaign.
 */
class MistralGetCampaignStatus extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_campaign_status';
    protected const DESCRIPTION = 'Get status for a Mistral observability campaign.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/campaigns/{campaign_id}/status';
    protected const PATH_PARAMS = ['campaign_id'];
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral campaign_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
