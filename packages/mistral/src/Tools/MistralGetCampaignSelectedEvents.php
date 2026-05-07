<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get selected events for a Mistral observability campaign.
 */
class MistralGetCampaignSelectedEvents extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_campaign_selected_events';
    protected const DESCRIPTION = 'Get selected events for a Mistral observability campaign.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/campaigns/{campaign_id}/selected-events';
    protected const PATH_PARAMS = ['campaign_id'];
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral campaign_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
