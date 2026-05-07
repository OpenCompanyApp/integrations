<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Get replies from drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/items/{driveItem-id}/workbook/comments/{workbookComment-id}/replies/{workbookCommentReply-id}.
 */
class MicrosoftExcelDrivesItemsWorkbookCommentsGetReplies extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_items_workbook_comments_get_replies';
    protected const DESCRIPTION = 'Get replies from drives\n\nOfficial Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/items/{driveItem-id}/workbook/comments/{workbookComment-id}/replies/{workbookCommentReply-id}.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_comment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookComment-id`.'], 'workbook_comment_reply_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookCommentReply-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/comments/{workbookComment-id}/replies/{workbookCommentReply-id}';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookComment-id' => 'workbook_comment_id', 'workbookCommentReply-id' => 'workbook_comment_reply_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
