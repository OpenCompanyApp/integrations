<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke function retrieveCloudPcLaunchDetail.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceManagement/virtualEndpoint/cloudPCs/{cloudPC-id}/retrieveCloudPcLaunchDetail().
 */
class MicrosoftIntuneDeviceManagementVirtualEndpointCloudPCsCloudPCRetrieveCloudPcLaunchDetail extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_virtual_endpoint_cloud_pcs_cloud_pc_retrieve_cloud_pc_launch_detail';
    protected const DESCRIPTION = 'Invoke function retrieveCloudPcLaunchDetail\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceManagement/virtualEndpoint/cloudPCs/{cloudPC-id}/retrieveCloudPcLaunchDetail().';
    protected const PARAMETERS = ['cloud_pc_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `cloudPC-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceManagement/virtualEndpoint/cloudPCs/{cloudPC-id}/retrieveCloudPcLaunchDetail()';
    protected const PATH_PARAMS = ['cloudPC-id' => 'cloud_pc_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
