<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create Slack integration mapping.
 *
 * Executes the official Box API operation post_integration_mappings_slack.
 */
class BoxPostIntegrationMappingsSlack extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_integration_mappings_slack';
}
