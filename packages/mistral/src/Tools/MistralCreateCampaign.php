<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral observability campaign.
 */
class MistralCreateCampaign extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_campaign';
    protected const DESCRIPTION = 'Create a Mistral observability campaign.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/campaigns';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
