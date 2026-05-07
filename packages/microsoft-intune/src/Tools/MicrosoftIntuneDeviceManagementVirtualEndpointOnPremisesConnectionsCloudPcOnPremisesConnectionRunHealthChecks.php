<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action runHealthChecks.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceManagement/virtualEndpoint/onPremisesConnections/{cloudPcOnPremisesConnection-id}/runHealthChecks.
 */
class MicrosoftIntuneDeviceManagementVirtualEndpointOnPremisesConnectionsCloudPcOnPremisesConnectionRunHealthChecks extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_virtual_endpoint_on_premises_connections_cloud_pc_on_premises_connection_run_health_checks';
    protected const DESCRIPTION = 'Invoke action runHealthChecks\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceManagement/virtualEndpoint/onPremisesConnections/{cloudPcOnPremisesConnection-id}/runHealthChecks.';
    protected const PARAMETERS = ['cloud_pc_on_premises_connection_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `cloudPcOnPremisesConnection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceManagement/virtualEndpoint/onPremisesConnections/{cloudPcOnPremisesConnection-id}/runHealthChecks';
    protected const PATH_PARAMS = ['cloudPcOnPremisesConnection-id' => 'cloud_pc_on_premises_connection_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
