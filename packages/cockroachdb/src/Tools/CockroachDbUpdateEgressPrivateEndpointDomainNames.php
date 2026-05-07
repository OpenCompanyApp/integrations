<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Update egress private endpoint domain names. This endpoint is deprecated in favor of PATCH /api/v1/clusters....
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_UpdateEgressPrivateEndpointDomainNames.
 */
class CockroachDbUpdateEgressPrivateEndpointDomainNames extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_update_egress_private_endpoint_domain_names';
}