<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Retrieve a sorted, filtered, paginated list of all integrations. If no provider filter is specified, returns provider integrations from all clouds.
 */
class ConfluentListPimV2Integrations extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_pim_v2_integrations';
}
