<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral observability campaign.
 */
class MistralDeleteCampaign extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_campaign';
    protected const DESCRIPTION = 'Delete a Mistral observability campaign.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/observability/campaigns/{campaign_id}';
    protected const PATH_PARAMS = ['campaign_id'];
    protected const PARAMETERS = ['campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral campaign_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
