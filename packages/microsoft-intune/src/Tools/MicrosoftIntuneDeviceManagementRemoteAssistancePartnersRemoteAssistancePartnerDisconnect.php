<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action disconnect.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceManagement/remoteAssistancePartners/{remoteAssistancePartner-id}/disconnect.
 */
class MicrosoftIntuneDeviceManagementRemoteAssistancePartnersRemoteAssistancePartnerDisconnect extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_remote_assistance_partners_remote_assistance_partner_disconnect';
    protected const DESCRIPTION = 'Invoke action disconnect\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceManagement/remoteAssistancePartners/{remoteAssistancePartner-id}/disconnect.';
    protected const PARAMETERS = ['remote_assistance_partner_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `remoteAssistancePartner-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceManagement/remoteAssistancePartners/{remoteAssistancePartner-id}/disconnect';
    protected const PATH_PARAMS = ['remoteAssistancePartner-id' => 'remote_assistance_partner_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
